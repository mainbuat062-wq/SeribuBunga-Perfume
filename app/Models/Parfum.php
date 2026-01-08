<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parfum extends Model
{
    use HasFactory;

    protected $table = 'parfums';
    
    protected $fillable = [
    'nama_produk',
    'kategori',
    'deskripsi_produk',
    'harga_produk',
    'gambar',
    'link_shopee',
    'status_produk',
    'label',
];

}