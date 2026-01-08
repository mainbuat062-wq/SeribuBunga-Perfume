<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_tokos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko');
            $table->text('alamat');
            $table->text('deskripsi')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_tokos');
    }
};
