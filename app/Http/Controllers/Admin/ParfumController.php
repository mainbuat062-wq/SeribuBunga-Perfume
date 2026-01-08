<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parfum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParfumController extends Controller
{
public function index(Request $request)
{
    $query = Parfum::query();

    // Filter berdasarkan label jika ada
    if ($request->has('label') && $request->label != '') {
        $query->where('label', $request->label);
    }

    $parfums = $query->latest()->paginate(12);

    return view('admin.parfum.index', compact('parfums'));
}


    public function create()
    {
        return view('admin.parfum.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk'       => 'required|string|max:255',
            'kategori'          => 'required|string|max:255',
            'deskripsi_produk'  => 'nullable|string',
            'harga_produk'      => 'required|numeric|min:0',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link_shopee'       => 'nullable|url|max:255',
            'status_produk'     => 'required|in:aktif,nonaktif',
            'label'             => 'nullable|in:best_seller,new,limited,promo',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('parfum', 'public');
        }

        Parfum::create($validated);

        return redirect()
            ->route('admin.parfum.index')
            ->with('success', 'Produk parfum berhasil ditambahkan!');
    }

    public function show($id)
    {
        $parfum = Parfum::findOrFail($id);
        return view('admin.parfum.show', compact('parfum'));
    }

    public function edit($id)
    {
        $parfum = Parfum::findOrFail($id);
        return view('admin.parfum.edit', compact('parfum'));
    }

    public function update(Request $request, $id)
    {
        $parfum = Parfum::findOrFail($id);

        $validated = $request->validate([
            'nama_produk'       => 'required|string|max:255',
            'kategori'          => 'required|string|max:255',
            'deskripsi_produk'  => 'nullable|string',
            'harga_produk'      => 'required|numeric|min:0',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link_shopee'       => 'nullable|url|max:255',
            'status_produk'     => 'required|in:aktif,nonaktif',
            'label'             => 'nullable|in:best_seller,new,limited,promo',
        ]);

        if ($request->hasFile('gambar')) {
            if ($parfum->gambar) {
                Storage::disk('public')->delete($parfum->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('parfum', 'public');
        }

        $parfum->update($validated);

        return redirect()
            ->route('admin.parfum.index')
            ->with('success', 'Produk parfum berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $parfum = Parfum::findOrFail($id);

        if ($parfum->gambar) {
            Storage::disk('public')->delete($parfum->gambar);
        }

        $parfum->delete();

        return redirect()
            ->route('admin.parfum.index')
            ->with('success', 'Produk parfum berhasil dihapus!');
    }
}
