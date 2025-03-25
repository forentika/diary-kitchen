@extends('layouts.app')

@section('title', 'Edit Data Barang')
@section('page_title', 'Edit Data Barang')
@section('page_subtitle', 'Memperbarui informasi barang')

@section('content')
<div class="px-4 py-5">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div class="flex items-center mb-4 md:mb-0">
            <a href="{{ route('barang.index') }}" class="mr-3 text-gray-500 hover:text-gray-700 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-edit text-green-600 mr-3"></i>
                Edit Data Barang
            </h1>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('barang.show', $barang->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-eye mr-2"></i>
                Lihat Detail
            </a>
            <a href="{{ route('barang.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-list mr-2"></i>
                Daftar Barang
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
            <h2 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-clipboard-list mr-2"></i>
                Edit Data Barang: {{ $barang->name }}
            </h2>
            <p class="text-green-100 text-sm mt-1">Perbarui data barang dengan informasi terbaru</p>
        </div>
        <div class="p-6">
            <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Foto Barang Section -->
                    <div class="lg:col-span-1 order-2 lg:order-1 bg-gray-50 rounded-xl p-6 flex flex-col items-center justify-center border border-gray-200">
                        <div class="w-32 h-32 rounded-full bg-white border-2 border-green-200 flex items-center justify-center overflow-hidden mb-3 shadow-md relative group">
                            @if($barang->foto)
                                <img src="{{ asset('storage/' . $barang->foto) }}" 
                                     alt="Foto Barang {{ $barang->nama }}" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 flex items-center justify-center transition-all rounded-full">
                                    <i class="fas fa-camera text-white opacity-0 group-hover:opacity-100 transition-opacity text-2xl"></i>
                                </div>
                            @else
                                <i class="fas fa-user-md text-gray-300 text-5xl group-hover:opacity-50 transition-opacity"></i>
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 flex items-center justify-center transition-all rounded-full">
                                    <i class="fas fa-camera text-white opacity-0 group-hover:opacity-100 transition-opacity text-2xl"></i>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-md font-medium text-gray-700 mb-4 text-center">Foto Barang</h3>
                        
                        <div class="w-full">
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2 text-center">
                                Ganti Foto
                            </label>
                            <input type="file" id="foto" name="foto" 
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer @error('foto_profil') border-red-500 @enderror" 
                                accept="image/*">
                            <p class="mt-2 text-xs text-gray-500 text-center">Format: JPG, PNG, GIF (maks. 2MB)</p>
                            @error('foto')
                                <p class="mt-1 text-sm text-red-600 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Main Form -->
                    <div class="lg:col-span-2 order-1 lg:order-2">
                        <h3 class="text-lg font-medium text-gray-800 mb-5 pb-2 border-b border-gray-200 flex items-center">
                            <i class="fas fa-info-circle text-green-600 mr-2"></i>
                            Informasi Barang
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Barang -->
                            <div class="md:col-span-2">
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Barang <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-box text-gray-400"></i>
                                    </div>
                                    <input type="text" id="nama" name="nama" value="{{ old('nama', $barang->nama) }}" 
                                        class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" 
                                        placeholder="Masukkan nama barang" required>
                                </div>
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="md:col-span-2">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">
                                    Deskripsi <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                        <i class="fas fa-align-left text-gray-400"></i>
                                    </div>
                                    <textarea id="deskripsi" name="deskripsi" rows="3" 
                                        class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" 
                                        placeholder="Masukkan deskripsi barang" required>{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                                </div>
                                @error('deskripsi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tags text-gray-400"></i>
                                    </div>
                                    <select id="kategori" name="kategori" 
                                        class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                                        <option value="">Pilih Kategori</option>
                                        <option value="mocci" {{ old('kategori', $barang->kategori) == 'mocci' ? 'selected' : '' }}>Mocci</option>
                                        <option value="kimbab" {{ old('kategori', $barang->kategori) == 'kimbab' ? 'selected' : '' }}>Kimbab</option>
                                    </select>
                                </div>
                                @error('kategori')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Harga -->
                            <div>
                                <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">
                                    Harga
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tag text-gray-400"></i>
                                    </div>
                                    <input type="number" id="harga" name="harga" value="{{ old('harga', $barang->harga) }}" 
                                        class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" 
                                        placeholder="Masukkan harga">
                                </div>
                                @error('harga')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stok -->
                            <div>
                                <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">
                                    Stok <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-cubes text-gray-400"></i>
                                    </div>
                                    <input type="number" id="stok" name="stok" value="{{ old('stok', $barang->stok) }}" 
                                        class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" 
                                        placeholder="Masukkan jumlah stok" required>
                                </div>
                                @error('stok')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end items-center space-x-3 mt-8 pt-5 border-t border-gray-200">
                    <a href="{{ route('barang.index') }}" class="inline-flex items-center px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
