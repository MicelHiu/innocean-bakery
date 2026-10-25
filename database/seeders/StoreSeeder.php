<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\Tier;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiers = Tier::pluck('id', 'name');

        $stores = [
            ['STR-JKT-001', 'Innocean Bakery Senopati',      'Jl. Senopati No. 45, Kebayoran Baru',  'Jakarta Selatan', 'DKI Jakarta',      'Tier A'],
            ['STR-JKT-002', 'Innocean Bakery Kelapa Gading', 'Jl. Boulevard Raya Blok LA-4',         'Jakarta Utara',   'DKI Jakarta',      'Tier B'],
            ['STR-BDG-001', 'Innocean Bakery Riau Heritage', 'Jl. LLRE Martadinata No. 88',          'Bandung',         'Jawa Barat',       'Tier A'],
            ['STR-BKS-001', 'Innocean Bakery Summarecon',    'Jl. Bulevar Ahmad Yani Blok M',        'Bekasi',          'Jawa Barat',       'Tier C'],
            ['STR-SBY-001', 'Innocean Bakery Darmo',         'Jl. Raya Darmo No. 112, Wonokromo',    'Surabaya',        'Jawa Timur',       'Tier A'],
            ['STR-MLG-001', 'Innocean Bakery Ijen',          'Jl. Besar Ijen No. 24, Klojen',        'Malang',          'Jawa Timur',       'Tier B'],
            ['STR-DPS-001', 'Innocean Bakery Seminyak',      'Jl. Kayu Aya No. 18X, Seminyak',       'Badung',          'Bali',             'Tier A'],
            ['STR-UBU-001', 'Innocean Bakery Ubud Hub',      'Jl. Raya Ubud No. 35, Ubud',           'Gianyar',         'Bali',             'Tier B'],
            ['STR-MDN-001', 'Innocean Bakery Merdeka',       'Jl. Balai Kota No. 7, Kesawan',        'Medan',           'Sumatera Utara',   'Tier B'],
            ['STR-MKS-001', 'Innocean Bakery Losari',        'Jl. Penghibur No. 52, Ujung Pandang',  'Makassar',        'Sulawesi Selatan', 'Tier C'],
        ];

        foreach ($stores as [$id, $name, $address, $city, $province, $tier]) {
            Store::updateOrCreate(['store_id' => $id], [
                'store_name' => $name,
                'address'    => $address,
                'city'       => $city,
                'province'   => $province,
                'tier_id'    => $tiers[$tier],
            ]);
        }
    }
}