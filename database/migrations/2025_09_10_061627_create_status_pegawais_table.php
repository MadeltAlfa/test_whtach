<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status_pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_pegawai_id')->constrained('jenis_pegawais');
            $table->string('status_pegawai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status_pegawais');
    }
};
