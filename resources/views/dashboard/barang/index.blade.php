@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-xl font-semibold mb-4">Daftar Barang</h2>

    <div class="flex justify-between mb-4">
        <a href="{{ route('barang.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">Tambah Barang Baru</a>
        <form action="{{ route('barang.index') }}" method="GET">
            <input type="text" name="search" placeholder="Cari Barang..." class="border rounded px-2 py-1">
            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md">Cari</button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border">No</th>
                    <th class="py-2 px-4 border">Gambar</th>
                    <th class="py-2 px-4 border">Nama Barang</th>
                    <th class="py-2 px-4 border">Harga</th>
                    <th class="py-2 px-4 border">Stok</th>
                    <th class="py-2 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $barang)
                <tr>
                    <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4 border">
                        <img src="{{ Storage::url('photo/' . $barang->photo) }}" alt="{{ $barang->name }}" class="w-16 h-16 object-cover">
                    </td>
                    <td class="py-2 px-4 border">{{ $barang->name }}</td>
                    <td class="py-2 px-4 border">Rp{{ number_format($barang->price, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border">{{ $barang->stock }}</td>
                    <td class="py-2 px-4 border flex space-x-2">
                        <a href="{{ route('barang.edit', $barang->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                        <button onclick="confirmDelete({{ $barang->id }})" class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Tidak ada data barang.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 class="text-lg font-bold">Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus barang ini?</p>
        <div class="mt-4 flex justify-end space-x-2">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        let deleteForm = document.getElementById('deleteForm');
        deleteForm.setAttribute('action', `/barang/${id}`);
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection
