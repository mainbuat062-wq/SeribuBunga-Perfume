<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Parfum;
use App\Models\ProfilToko;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   
public function index()
{
    $profilToko = ProfilToko::first();
    
    if (!$profilToko) {
        $profilToko = new ProfilToko();
        $profilToko->alamat = '-';
    }

    // === HIGHLIGHT: 1 produk terbaru per label ===
    $highlight = collect([]);

    $labels = ['best_seller', 'new', 'promo', 'limited'];

    foreach ($labels as $label) {

        $produk = Parfum::where('label', $label)
            ->latest()
            ->first();

        if ($produk) {
            $highlight->push($produk);
        }
    }

    // === KATALOG: semua produk ===
    $parfums = Parfum::latest()->take(8)->get();

    return view('user.home', compact(
        'profilToko',
        'highlight',
        'parfums'
    ));
}

}
