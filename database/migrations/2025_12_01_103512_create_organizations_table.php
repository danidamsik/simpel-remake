<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('lembaga', [
                'Fakultas Sains & Teknologi',
                'Fakultas Tarbiyah dan Ilmu Keguruan',
                'Fakultas Syariah',
                'Fakultas Ushuluddin adab dan dakwah',
                'Fakultas Ekonomi & Bisnis Islam',
                'Fakultas dakwah dan Komunikasi islam',
                'Universitas'
            ]);
            $table->string('number_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('logo_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};