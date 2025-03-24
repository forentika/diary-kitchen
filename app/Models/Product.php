<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    public $incrementing = false;

    protected $fillable = [
        'id_produk',
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'kategori',
        'foto',
        ];

        protected $casts = [
            'kategori' => 'string', // Pastikan enum diperlakukan sebagai string
            'harga' => 'decimal:2',
        ];

public static function generateNextId()
{
    // Mendapatkan ID terakhir dari database
    $latestId = self::orderBy('id_product', 'desc')->first();

    // Mengambil nomor dari ID terakhir
    $lastNumber = $latestId ? intval(substr($latestId->id_product, 1)) : 0;

    // Menambahkan 1 untuk mendapatkan nomor berikutnya
    $nextNumber = $lastNumber + 1;

    // Mengonversi nomor berikutnya ke format yang diinginkan (NXX)
    $nextId = 'A' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);

    return $nextId;
}


}
