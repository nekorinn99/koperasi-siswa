<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $vendors =[
            [
            'nama_vendor' => 'CV Sumber Rejeki',
            'alamat' => 'Jl. Merdeka No. 12, Bandung',
            'no_telp' => '081234567890',
        ],
        [
            'nama_vendor' => 'PT Maju Jaya',
            'alamat' => 'Jl. Gatot Subroto No. 88, Jakarta',
            'no_telp' => '085612341234',
        ],
        [
            'nama_vendor' => 'UD Berkah Abadi',
            'alamat' => 'Jl. Siliwangi No. 22, Yogyakarta',
            'no_telp' => '087812345678',
        ],
        [
            'nama_vendor' => 'Toko Amanah',
            'alamat' => 'Jl. Raya Bogor No. 77, Bogor',
            'no_telp' => '089991112222',
        ],
    ];

        foreach ($vendors as $vendor) {
            Vendor::create($vendor);
        }

    }
   
}
