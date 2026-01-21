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
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Renderless;

class FormtambahKegiatan extends Component
{
    use WithFileUploads;

    // Edit Mode
    public $activityId = null;
    public $isEditMode = false;
    public $organizationInfo = null;
    public $existingProposalFile = null;
    public $existingProofFile = null;
    public $oldFundsApproved = 0;
    public $expenseId = null;

    // Organization
    public $searchOrganization, $selectedOrganizationId = null, $walletInfo = null;

    // Proposal
    public $proposalFile, $fundsApproved, $dateReceived;

    // Activity
    public $activityName, $startDate, $endDate, $location, $description, $personResponsible, $numberPr;

    // Expense
    public $proofFile, $taxType = 'PPh22';

    // Period
    public $activePeriod = null;

    protected function rules()
    {
        $rules = [
            'fundsApproved' => 'required|numeric|min:1',
            'dateReceived' => 'required|date',

            'activityName' => 'required|string|max:255',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'personResponsible' => 'required|string|max:255',
            'numberPr' => 'required|string|max:20',

            'proofFile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'taxType' => 'required|in:PPh22,PPh23,Ppn',
        ];

        // Proposal file required hanya untuk mode tambah
        if (!$this->isEditMode) {
            $rules['proposalFile'] = 'required|file|mimes:pdf,doc,docx|max:10240';
        } else {
            $rules['proposalFile'] = 'nullable|file|mimes:pdf,doc,docx|max:10240';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'proposalFile.required' => 'File proposal wajib diunggah.',
            'proposalFile.file' => 'File proposal harus berupa file.',
            'proposalFile.mimes' => 'File proposal harus berformat PDF, DOC, atau DOCX.',
            'proposalFile.max' => 'Ukuran file proposal maksimal 10MB.',

            'fundsApproved.required' => 'Dana yang disetujui wajib diisi.',
            'fundsApproved.numeric' => 'Dana yang disetujui harus berupa angka.',
            'fundsApproved.min' => 'Dana yang disetujui minimal Rp 1.',

            'dateReceived.required' => 'Tanggal diterima wajib diisi.',
            'dateReceived.date' => 'Format tanggal diterima tidak valid.',

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

            'proofFile.file' => 'Bukti pengeluaran harus berupa file.',
            'proofFile.mimes' => 'Bukti pengeluaran harus berformat PDF, JPG, JPEG, atau PNG.',
            'proofFile.max' => 'Ukuran bukti pengeluaran maksimal 5MB.',

            'taxType.required' => 'Jenis pajak wajib dipilih.',
            'taxType.in' => 'Jenis pajak tidak valid.',
        ];
    }

    public function mount($id = null)
    {
        $this->activePeriod = Period::where('status', true)->first();
        $this->dateReceived = now()->format('Y-m-d');

        if ($id) {
            $this->loadActivityForEdit($id);
        }
    }

    protected function loadActivityForEdit($id)
    {
        $activity = Activity::with(['organization', 'proposal', 'expenses'])->find($id);

        if (!$activity) {
            session()->flash('error', 'Kegiatan tidak ditemukan.');
            return $this->redirect('/pengajuan-kegiatan', navigate: true);
        }

        $this->isEditMode = true;
        $this->activityId = $activity->id;

        // Organization Info (readonly)
        $this->selectedOrganizationId = $activity->organization_id;
        $this->organizationInfo = $activity->organization;
        $this->searchOrganization = $activity->organization->name;

        // Load wallet info
        if ($this->activePeriod) {
            $this->walletInfo = Wallet::join('organization_users', 'organization_users.wallet_id', '=', 'wallets.id')
                ->where('organization_users.organization_id', $activity->organization_id)
                ->where('wallets.period_id', $this->activePeriod->id)
                ->select('wallets.*')
                ->first();
        }

        // Proposal data
        $this->existingProposalFile = $activity->proposal->proposal_file;
        $this->fundsApproved = $activity->proposal->funds_approved;
        $this->oldFundsApproved = $activity->proposal->funds_approved;
        $this->dateReceived = $activity->proposal->date_received->format('Y-m-d');

        // Activity data
        $this->activityName = $activity->name;
        $this->startDate = $activity->start_date->format('Y-m-d');
        $this->endDate = $activity->end_date->format('Y-m-d');
        $this->location = $activity->location;
        $this->description = $activity->description;
        $this->personResponsible = $activity->person_responsible;
        $this->numberPr = $activity->number_pr;

        // Expense data (ambil expense pertama)
        $expense = $activity->expenses->first();
        if ($expense) {
            $this->expenseId = $expense->id;
            $this->existingProofFile = $expense->proof_file;
            $this->taxType = $expense->tax_type;
        }
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

            $this->walletInfo = Wallet::join('organization_users', 'organization_users.wallet_id', '=', 'wallets.id')
                ->where('organization_users.organization_id', $id)
                ->where('wallets.period_id', $this->activePeriod->id)
                ->select('wallets.*')
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

    public function getAvailableBalance()
    {
        if (!$this->walletInfo) {
            return 0;
        }

        // Pada mode edit, saldo tersedia = saldo saat ini + dana yang sudah disetujui sebelumnya
        if ($this->isEditMode) {
            return $this->walletInfo->balance + $this->oldFundsApproved;
        }

        return $this->walletInfo->balance;
    }

    public function save()
    {
        if ($this->isEditMode) {
            return $this->update();
        }

        $this->validate();

        if (!$this->selectedOrganizationId) {
            $this->addError('searchOrganization', 'Pilih organisasi terlebih dahulu.');
            return;
        }

        if (!$this->activePeriod) {
            $this->addError('general', 'Tidak ada periode aktif.');
            return;
        }

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
            $proposalPath = $this->proposalFile->store('proposals', 'public');

            $proposal = Proposal::create([
                'organization_id' => $this->selectedOrganizationId,
                'proposal_file' => $proposalPath,
                'funds_approved' => $this->fundsApproved,
                'date_received' => $this->dateReceived,
            ]);

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

            Lpj::create([
                'activity_id' => $activity->id,
                'organization_id' => $this->selectedOrganizationId,
                'date_received' => null,
                'status' => 'Belum Disetor',
                'file' => null,
            ]);

            $this->walletInfo->decrement('balance', $this->fundsApproved);

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

    public function update()
    {
        $this->validate();

        if (!$this->walletInfo) {
            $this->addError('fundsApproved', 'Organisasi belum memiliki wallet untuk periode ini.');
            return;
        }

        // Validasi terhadap saldo saat ini
        if ($this->fundsApproved > $this->walletInfo->balance) {
            $this->addError('fundsApproved', 'Dana yang diajukan melebihi saldo tersedia (Rp ' . number_format($this->walletInfo->balance, 0, ',', '.') . ').');
            return;
        }

        DB::beginTransaction();

        try {
            $activity = Activity::with(['proposal', 'expenses'])->find($this->activityId);

            // Update Proposal
            $proposalPath = $this->existingProposalFile;
            if ($this->proposalFile) {
                // Hapus file lama
                if ($this->existingProposalFile && Storage::disk('public')->exists($this->existingProposalFile)) {
                    Storage::disk('public')->delete($this->existingProposalFile);
                }
                $proposalPath = $this->proposalFile->store('proposals', 'public');
            }

            $activity->proposal->update([
                'proposal_file' => $proposalPath,
                'funds_approved' => $this->fundsApproved,
                'date_received' => $this->dateReceived,
            ]);

            // Update Activity
            $activity->update([
                'name' => $this->activityName,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
                'location' => $this->location,
                'description' => $this->description,
                'person_responsible' => $this->personResponsible,
                'number_pr' => $this->numberPr,
            ]);

            // Update Wallet Balance
            // Formula: saldo_baru = saldo_saat_ini + dana_lama - dana_baru
            $balanceDifference = $this->oldFundsApproved - $this->fundsApproved;
            $this->walletInfo->increment('balance', $balanceDifference);

            // Update Expense
            if ($this->expenseId) {
                $expense = Expense::find($this->expenseId);

                $proofPath = $this->existingProofFile;
                if ($this->proofFile) {
                    // Hapus file lama
                    if ($this->existingProofFile && Storage::disk('public')->exists($this->existingProofFile)) {
                        Storage::disk('public')->delete($this->existingProofFile);
                    }
                    $proofPath = $this->proofFile->store('expenses', 'public');
                }

                $expense->update([
                    'amount' => $this->fundsApproved,
                    'description' => $this->activityName,
                    'expense_date' => $this->dateReceived,
                    'tax_persentase' => $this->getTaxPercentage(),
                    'tax_type' => $this->taxType,
                    'proof_file' => $proofPath,
                ]);
            }

            DB::commit();

            session()->flash('success', 'Pengajuan kegiatan berhasil diperbarui!');
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
