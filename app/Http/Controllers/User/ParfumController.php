<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Parfum;
use Illuminate\Http\Request;

class ParfumController extends Controller
{
    public function index(Request $request)
    {
        $parfums = Parfum::where('status_produk', 'aktif')
            ->latest()
            ->get();


        return view('user.katalog', compact('parfums'));
    }

    public function show($id)
    {
        $parfum = Parfum::where('status_produk', 'aktif')
            ->findOrFail($id);

        // Produk terkait (acak & tidak termasuk produk saat ini)
        $related = Parfum::where('status_produk', 'aktif')
            ->where('id', '!=', $parfum->id)
            ->latest()
            ->take(4)
            ->get();

        return view('user.detail-parfum', compact('parfum', 'related'));
    }
}
