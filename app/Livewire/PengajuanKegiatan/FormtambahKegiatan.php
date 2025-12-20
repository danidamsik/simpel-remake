<?php

namespace App\Livewire\PengajuanKegiatan;

use App\Models\Activity;
use App\Models\Expense;
use App\Models\Lpj;
use App\Models\Organization;
use App\Models\Period;
use App\Models\Proposal;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Renderless;

class FormtambahKegiatan extends Component
{
    use WithFileUploads;

    // Organization
    public $searchOrganization = '';
    public $selectedOrganizationId = null;
    public $walletInfo = null;

    // Proposal
    public $proposalFile;
    public $fundsApproved = '';
    public $dateReceived;

    // Activity
    public $activityName = '';
    public $startDate;
    public $endDate;
    public $location = '';
    public $description = '';
    public $personResponsible = '';
    public $numberPr = '';

    // Expense
    public $proofFile;
    public $taxType = 'PPh22';

    // Period
    public $activePeriod = null;

    protected function rules()
    {
        return [
            // Proposal
            'proposalFile' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'fundsApproved' => 'required|numeric|min:1',
            'dateReceived' => 'required|date',

            // Activity
            'activityName' => 'required|string|max:255',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'personResponsible' => 'required|string|max:255',
            'numberPr' => 'required|string|max:20',

            // Expense
            'proofFile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'taxType' => 'required|in:PPh22,PPh23,Ppn',
        ];
    }

    protected function messages()
    {
        return [
            // Proposal
            'proposalFile.required' => 'File proposal wajib diunggah.',
            'proposalFile.file' => 'File proposal harus berupa file.',
            'proposalFile.mimes' => 'File proposal harus berformat PDF, DOC, atau DOCX.',
            'proposalFile.max' => 'Ukuran file proposal maksimal 10MB.',

            'fundsApproved.required' => 'Dana yang disetujui wajib diisi.',
            'fundsApproved.numeric' => 'Dana yang disetujui harus berupa angka.',
            'fundsApproved.min' => 'Dana yang disetujui minimal Rp 1.',

            'dateReceived.required' => 'Tanggal diterima wajib diisi.',
            'dateReceived.date' => 'Format tanggal diterima tidak valid.',

            // Activity
            'activityName.required' => 'Nama kegiatan wajib diisi.',
            'activityName.string' => 'Nama kegiatan harus berupa teks.',
            'activityName.max' => 'Nama kegiatan maksimal 255 karakter.',

            'startDate.required' => 'Tanggal mulai wajib diisi.',
            'startDate.date' => 'Format tanggal mulai tidak valid.',

            'endDate.required' => 'Tanggal selesai wajib diisi.',
            'endDate.date' => 'Format tanggal selesai tidak valid.',
            'endDate.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.',

            'location.required' => 'Lokasi kegiatan wajib diisi.',
            'location.string' => 'Lokasi harus berupa teks.',
            'location.max' => 'Lokasi maksimal 255 karakter.',

            'personResponsible.required' => 'Nama penanggung jawab wajib diisi.',
            'personResponsible.string' => 'Nama penanggung jawab harus berupa teks.',
            'personResponsible.max' => 'Nama penanggung jawab maksimal 255 karakter.',

            'numberPr.required' => 'Nomor WhatsApp wajib diisi.',
            'numberPr.string' => 'Nomor WhatsApp harus berupa teks.',
            'numberPr.max' => 'Nomor WhatsApp maksimal 20 karakter.',

            // Expense
            'proofFile.file' => 'Bukti pengeluaran harus berupa file.',
            'proofFile.mimes' => 'Bukti pengeluaran harus berformat PDF, JPG, JPEG, atau PNG.',
            'proofFile.max' => 'Ukuran bukti pengeluaran maksimal 5MB.',

            'taxType.required' => 'Jenis pajak wajib dipilih.',
            'taxType.in' => 'Jenis pajak tidak valid.',
        ];
    }

    public function mount()
    {
        $this->activePeriod = Period::where('status', true)->first();
        $this->dateReceived = now()->format('Y-m-d');
    }

    #[Renderless]
    public function searchOrganizations($query)
    {
        if (strlen($query) < 2) {
            return [];
        }

        return Organization::where('name', 'like', '%' . $query . '%')
            ->select('id', 'name', 'lembaga')
            ->limit(10)
            ->get()
            ->toArray();
    }

    public function selectOrganization($id)
    {
        $this->selectedOrganizationId = $id;
        $organization = Organization::find($id);

        if ($organization && $this->activePeriod) {
            $this->searchOrganization = $organization->name;

            $this->walletInfo = Wallet::where('organization_id', $id)
                ->where('period_id', $this->activePeriod->id)
                ->first();
        }
    }

    public function getTaxPercentage()
    {
        return match ($this->taxType) {
            'PPh22' => 1.5,
            'PPh23' => 2,
            'Ppn' => 12,
            default => 0,
        };
    }

    public function save()
    {
        $this->validate();

        // Validate organization selected
        if (!$this->selectedOrganizationId) {
            $this->addError('searchOrganization', 'Pilih organisasi terlebih dahulu.');
            return;
        }

        // Validate active period
        if (!$this->activePeriod) {
            $this->addError('general', 'Tidak ada periode aktif.');
            return;
        }

        // Validate wallet balance
        if (!$this->walletInfo) {
            $this->addError('fundsApproved', 'Organisasi belum memiliki wallet untuk periode ini.');
            return;
        }

        if ($this->fundsApproved > $this->walletInfo->balance) {
            $this->addError('fundsApproved', 'Dana yang diajukan melebihi saldo wallet (Rp ' . number_format($this->walletInfo->balance, 0, ',', '.') . ').');
            return;
        }

        DB::beginTransaction();

        try {
            // Store proposal file
            $proposalPath = $this->proposalFile->store('proposals', 'public');

            // 1. Create Proposal
            $proposal = Proposal::create([
                'organization_id' => $this->selectedOrganizationId,
                'proposal_file' => $proposalPath,
                'funds_approved' => $this->fundsApproved,
                'date_received' => $this->dateReceived,
            ]);

            // 2. Create Activity
            $activity = Activity::create([
                'name' => $this->activityName,
                'organization_id' => $this->selectedOrganizationId,
                'proposal_id' => $proposal->id,
                'period_id' => $this->activePeriod->id,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
                'location' => $this->location,
                'description' => $this->description,
                'person_responsible' => $this->personResponsible,
                'number_pr' => $this->numberPr,
            ]);

            // 3. Create LPJ (with null values as specified)
            Lpj::create([
                'activity_id' => $activity->id,
                'organization_id' => $this->selectedOrganizationId,
                'date_received' => null,
                'status' => 'Belum Disetor',
                'file' => null,
            ]);

            // 4. Update Wallet Balance
            $this->walletInfo->decrement('balance', $this->fundsApproved);

            // 5. Create Expense
            $proofPath = null;
            if ($this->proofFile) {
                $proofPath = $this->proofFile->store('expenses', 'public');
            }

            Expense::create([
                'organization_id' => $this->selectedOrganizationId,
                'activity_id' => $activity->id,
                'amount' => $this->fundsApproved,
                'description' => $this->activityName,
                'expense_date' => $this->dateReceived,
                'tax_persentase' => $this->getTaxPercentage(),
                'tax_type' => $this->taxType,
                'proof_file' => $proofPath,
            ]);

            DB::commit();

            session()->flash('success', 'Pengajuan kegiatan berhasil disimpan!');
            return $this->redirect('/pengajuan-kegiatan', navigate: true);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('general', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pengajuan-kegiatan.formtambah-kegiatan')->layout('components.layouts.admin');
    }
}
