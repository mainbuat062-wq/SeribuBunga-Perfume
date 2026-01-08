<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profil_tokos', function (Blueprint $table) {

            // Ubah panjang kolom yang sudah ada
            $table->string('nama_toko', 100)->change();
            $table->string('email', 100)->nullable()->change();
            $table->string('no_hp', 20)->nullable()->change();

            // Tambah kolom baru
            $table->string('logo', 255)->nullable()->after('nama_toko');
            $table->string('tagline', 150)->nullable()->after('logo');
            $table->text('link_toko_shopee')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('profil_tokos', function (Blueprint $table) {
            // rollback perubahan
            $table->string('nama_toko', 255)->change();
            $table->string('email', 255)->nullable()->change();
            $table->string('no_hp', 255)->nullable()->change();

            $table->dropColumn([
                'logo',
                'tagline',
                'link_toko_shopee'
            ]);
        });
    }
};
