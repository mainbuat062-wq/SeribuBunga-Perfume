<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfilToko;

class ProfilTokoSeeder extends Seeder
{
    public function run(): void
    {
        if (ProfilToko::count() === 0) {
            ProfilToko::create([
                'nama_toko' => 'SeribuBunga Parfume',
                'tagline' => 'Aroma yang Bercerita di Setiap Semprotannya',
                'deskripsi' => 'Toko parfum premium dengan koleksi terbaik.',
                'alamat' => 'Jakarta, Indonesia',
                'email' => 'admin@seribubunga.com',
                'no_hp' => '081234567890',
                'link_toko_shopee' => 'https://shopee.co.id',
            ]);
        }
    }
}
