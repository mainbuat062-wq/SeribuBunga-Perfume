<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('profil_tokos', function (Blueprint $table) {
        $table->string('promo_image')->nullable()->after('link_toko_shopee');
        $table->string('promo_text')->nullable()->after('promo_image');
        $table->timestamp('promo_until')->nullable()->after('promo_text');
    });
}

public function down()
{
    Schema::table('profil_tokos', function (Blueprint $table) {
        $table->dropColumn(['promo_image', 'promo_text', 'promo_until']);
    });
}

};
