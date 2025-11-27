<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('artikels')->get();
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')
            ->with('success', '🎉 Kategori berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $kategori->id_kategori . ',id_kategori',
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')
            ->with('success', '🎉 Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
    {
        // Check if kategori has articles
        if ($kategori->artikels_count > 0) {
            return redirect()->route('kategori.index')
                ->with('error', '❌ Tidak dapat menghapus kategori yang masih memiliki artikel!');
        }

        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', '🎉 Kategori berhasil dihapus!');
    }
}