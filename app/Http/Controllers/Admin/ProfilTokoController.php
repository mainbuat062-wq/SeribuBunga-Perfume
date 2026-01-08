<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilToko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilTokoController extends Controller
{
    public function index()
{
    // Cek apakah sudah ada profil
    $profilToko = ProfilToko::first();

    // Jika belum ada → buat otomatis
    if (!$profilToko) {
        $profilToko = ProfilToko::create([
            'nama_toko' => 'Nama Toko',
            'logo' => null,
            'tagline' => null,
            'deskripsi' => null,
            'alamat' => null,
            'no_hp' => null,
            'email' => null,
            'link_toko_shopee' => null,
        ]);
    }

    return view('admin.profil-toko.index', compact('profilToko'));
}

    public function edit($id)
    {
        $profilToko = ProfilToko::findOrFail($id);
        return view('admin.profil-toko.edit', compact('profilToko'));
    }

public function update(Request $request, $id)
{
    $profilToko = ProfilToko::findOrFail($id);

    $validated = $request->validate([
        'nama_toko'        => 'required|string|max:100',
        'logo'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'tagline'          => 'nullable|string|max:150',
        'deskripsi'        => 'nullable|string',
        'alamat'           => 'nullable|string',
        'no_hp'            => 'nullable|string|max:20',
        'email'            => 'nullable|email|max:100',
        'link_toko_shopee' => 'nullable|string',

        // FIELD PROMO
        'promo_image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'promo_text'       => 'nullable|string|max:150',
        'promo_until'      => 'nullable|date',
    ]);

    // 1. Ambil data kecuali file gambar agar tidak menimpa path di DB secara prematur
    $data = $request->except(['logo', 'promo_image']);

    // 2. === HANDLE GAMBAR PROMO ===
    if ($request->hasFile('promo_image')) {
        // Hapus gambar lama jika ada di storage
        if ($profilToko->promo_image && Storage::disk('public')->exists($profilToko->promo_image)) {
            Storage::disk('public')->delete($profilToko->promo_image);
        }

        // Simpan gambar baru dan masukkan path-nya ke array $data
        $data['promo_image'] = $request->file('promo_image')->store('promo', 'public');
    }

    // 3. === HANDLE LOGO ===
    if ($request->hasFile('logo')) {
        // Hapus logo lama jika ada di storage
        if ($profilToko->logo && Storage::disk('public')->exists($profilToko->logo)) {
            Storage::disk('public')->delete($profilToko->logo);
        }

        // Simpan logo baru dan masukkan path-nya ke array $data
        $data['logo'] = $request->file('logo')->store('logo_toko', 'public');
    }

    // 4. Update semua data (text dan path gambar baru) dalam satu kali perintah
    $profilToko->update($data);

    return redirect()->route('admin.profil-toko.index')
        ->with('success', 'Profil toko berhasil diperbarui!');
}

}
