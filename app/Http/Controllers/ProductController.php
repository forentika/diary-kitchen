<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar semua barang.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('dashboard.barang.index', compact('products'));
    }

    /**
     * Menampilkan form untuk menambahkan barang baru.
     */
    public function create()
    {
        return view('dashboard.barang.create');
    }

    /**
     * Menyimpan barang baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|in:mocci,kimbab',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barang.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan data barang
        $product = new Product();
        $product->nama = $request->nama;
        $product->deskripsi = $request->deskripsi;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->kategori = $request->kategori;

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('products', $filename, 'public');
            Log::info('Storing photo: ' . $path);
            Log::info('File exists: ' . (Storage::disk('public')->exists($path) ? 'Yes' : 'No'));
            Log::info('Full path: ' . Storage::disk('public')->path($path));
            $product->foto = $path;
        }

        $product->save();

        return redirect()->route('barang.index')
            ->with('success', 'Data barang berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail barang berdasarkan ID.
     */
    public function show(Product $barang)
    {
        return view('dashboard.barang.show', compact('barang'));
    }

    /**
     * Menampilkan form edit barang.
     */
    public function edit(Product $barang)
    {
        return view('dashboard.barang.edit', compact('barang'));
    }

    /**
     * Memperbarui data barang.
     */
    public function update(Request $request, Product $barang)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|in:mocci,kimbab',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barang.edit', $barang->id)
                ->withErrors($validator)
                ->withInput();
        }

        // Perbarui data barang
        $barang->nama = $request->nama;
        $barang->deskripsi = $request->deskripsi;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->kategori = $request->kategori;

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            
            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('products', $filename, 'public');
            $barang->foto = $path;
        }

        $barang->save();

        return redirect()->route('barang.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    /**
     * Menghapus barang dari database.
     */
    public function destroy($id)
    {
        $barang = Product::findOrFail($id);
        
        if ($barang->foto) {
            Storage::disk('public')->delete($barang->foto);
        }
        
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Data barang berhasil dihapus.');
    }
}
