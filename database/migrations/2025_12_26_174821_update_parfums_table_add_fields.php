<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('parfums', function (Blueprint $table) {

            $table->string('kategori')
                  ->after('nama_produk')
                  ->comment('pria, wanita, unisex');

            $table->text('deskripsi_produk')
                  ->nullable()
                  ->change(); // jika awalnya TEXT tapi nullable

            $table->string('gambar')
                  ->nullable()
                  ->change();

            $table->string('link_shopee')
                  ->nullable()
                  ->after('gambar');

            $table->enum('label', ['best_seller','new','limited','promo'])
                  ->nullable()
                  ->after('status_produk');
        });
    }

    public function down()
    {
        Schema::table('parfums', function (Blueprint $table) {
            $table->dropColumn(['kategori','link_shopee','label']);
        });
    }
};

