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
                'Fakultas Tarbiyah',
                'Fakultas Syariah',
                'Fakultas Ushuluddin',
                'Fakultas Ekonomi & Bisnis Islam',
            ]);
            $table->string('number_phone');
            $table->string('email');
            $table->string('logo_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};