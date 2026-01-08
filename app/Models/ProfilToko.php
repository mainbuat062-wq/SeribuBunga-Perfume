<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilToko extends Model
{
    use HasFactory;

    protected $table = 'profil_tokos';
    
protected $fillable = [
    'nama_toko',
    'logo',
    'tagline',
    'alamat',
    'deskripsi',
    'no_hp',
    'email',
    'link_toko_shopee',
    'promo_image',
    'promo_text',
    'promo_until',
];

}