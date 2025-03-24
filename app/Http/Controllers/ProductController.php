<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Menampilkan semua produk.
     */
    public function index()
    {
        $products = Product::latest()->paginate(8); 
        return view('dashboard.barang.index', compact('products'));
    }

    /**
     * Menampilkan form tambah produk.
     */
    public function create()
    {
        $categories = ['mocci', 'kimbab']; // ENUM kategori
        return view('dashboard.barang.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string|in:mocci,kimbab',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barang.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Generate ID produk baru
        $id_produk = Product::generateNextId();

        // Simpan data produk
        $product = new Product([
            'id_produk' => $id_produk,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
        ]);

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $filename = $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('barang/'), $filename);
            $product->foto = $filename;
        }

        $product->save();

        return redirect()->route('barang.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail produk berdasarkan ID.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.barang.show', compact('product'));
    }

    /**
     * Menampilkan form edit produk.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = ['mocci', 'kimbab']; // ENUM kategori
        return view('dashboard.barang.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui data produk.
     */
    public function update(Request $request, Product $product)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string|in:mocci,kimbab',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barang.edit', $product->id_produk)
                ->withErrors($validator)
                ->withInput();
        }

        // Update data produk
        $product->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
        ]);

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            $filename = $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('barang/'), $filename);
            $product->foto = $filename;
        }

        $product->save();

        return redirect()->route('barang.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Menghapus produk dari database.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
