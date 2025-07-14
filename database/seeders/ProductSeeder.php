<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'nama' => 'Pulpen Standard AE7',
                'kategori' => 'alat_tulis',
                'isi_per_pack' => 12,
                'satuan_pack' => 'pak',
                'harga_beli' => 18000,
                'harga_jual' => 25000,
            ],
            [
                'nama' => 'Buku Tulis Sidu 38 Lembar',
                'kategori' => 'buku',
                'isi_per_pack' => 10,
                'satuan_pack' => 'pak',
                'harga_beli' => 23000,
                'harga_jual' => 30000,
            ],
            [
                'nama' => 'Pensil 2B Faber Castell',
                'kategori' => 'alat_tulis',
                'isi_per_pack' => 12,
                'satuan_pack' => 'pak',
                'harga_beli' => 15000,
                'harga_jual' => 22000,
            ],
            [
                'nama' => 'Penghapus Joyko ER-300',
                'kategori' => 'alat_tulis',
                'isi_per_pack' => 30,
                'satuan_pack' => 'pak',
                'harga_beli' => 20000,
                'harga_jual' => 30000,
            ],
            [
                'nama' => 'Tipe-X Joyko CT-500',
                'kategori' => 'alat_tulis',
                'isi_per_pack' => 12,
                'satuan_pack' => 'pak',
                'harga_beli' => 25000,
                'harga_jual' => 35000,
            ],
            [
                'nama' => 'Roti Tawar Sari Roti',
                'kategori' => 'makanan_berat',
                'isi_per_pack' => 10,
                'satuan_pack' => 'pak',
                'harga_beli' => 17000,
                'harga_jual' => 25000,
            ],
            [
                'nama' => 'Minuman Teh Kotak 250ml',
                'kategori' => 'minuman',
                'isi_per_pack' => 24,
                'satuan_pack' => 'dus',
                'harga_beli' => 95000,
                'harga_jual' => 120000,
            ],
            [
                'nama' => 'Indomie Goreng',
                'kategori' => 'makanan_berat',
                'isi_per_pack' => 40,
                'satuan_pack' => 'dus',
                'harga_beli' => 88000,
                'harga_jual' => 112000,
            ],
            [
                'nama' => 'Air Mineral Aqua 600ml',
                'kategori' => 'minuman',
                'isi_per_pack' => 24,
                'satuan_pack' => 'dus',
                'harga_beli' => 42000,
                'harga_jual' => 60000,
            ],
            [
                'nama' => 'Snack Taro Net 15g',
                'kategori' => 'makanan_ringan',
                'isi_per_pack' => 20,
                'satuan_pack' => 'bal',
                'harga_beli' => 18000,
                'harga_jual' => 28000,
            ],
            [
                'nama' => 'Seragam Putih Abu Lengan Pendek',
                'kategori' => 'seragam',
                'isi_per_pack' => 1,
                'satuan_pack' => 'bungkus',
                'harga_beli' => 70000,
                'harga_jual' => 85000,
            ],
            [
                'nama' => 'Penggaris Plastik 30cm',
                'kategori' => 'alat_tulis',
                'isi_per_pack' => 12,
                'satuan_pack' => 'pak',
                'harga_beli' => 18000,
                'harga_jual' => 24000,
            ],
            [
                'nama' => 'Pembersih Lantai Wipol 800ml',
                'kategori' => 'kebersihan',
                'isi_per_pack' => 12,
                'satuan_pack' => 'dus',
                'harga_beli' => 72000,
                'harga_jual' => 96000,
            ],
            [
                'nama' => 'Sikat Gigi Formula',
                'kategori' => 'kebersihan',
                'isi_per_pack' => 12,
                'satuan_pack' => 'pak',
                'harga_beli' => 18000,
                'harga_jual' => 24000,
            ],
            [
                'nama' => 'Snack Cheetos 15g',
                'kategori' => 'makanan_ringan',
                'isi_per_pack' => 20,
                'satuan_pack' => 'bal',
                'harga_beli' => 20000,
                'harga_jual' => 30000,
            ],
            [
                'nama' => 'Stabilo Boss Warna Campur',
                'kategori' => 'alat_tulis',
                'isi_per_pack' => 6,
                'satuan_pack' => 'pak',
                'harga_beli' => 30000,
                'harga_jual' => 40000,
            ],
            [
                'nama' => 'Tali Pinggang Sekolah',
                'kategori' => 'aksesoris',
                'isi_per_pack' => 10,
                'satuan_pack' => 'pak',
                'harga_beli' => 40000,
                'harga_jual' => 60000,
            ],
            [
                'nama' => 'Topi OSIS',
                'kategori' => 'aksesoris',
                'isi_per_pack' => 5,
                'satuan_pack' => 'pak',
                'harga_beli' => 50000,
                'harga_jual' => 70000,
            ],
            [
                'nama' => 'Susu UHT Indomilk Coklat 190ml',
                'kategori' => 'minuman',
                'isi_per_pack' => 24,
                'satuan_pack' => 'dus',
                'harga_beli' => 95000,
                'harga_jual' => 120000,
            ],
            [
                'nama' => 'Roti Sandwich Roma',
                'kategori' => 'makanan_ringan',
                'isi_per_pack' => 10,
                'satuan_pack' => 'pak',
                'harga_beli' => 18000,
                'harga_jual' => 25000,
            ],
        ];
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
