<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Tier;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiers = Tier::pluck('id', 'name');

        $products = [
            ['PRD-001', 'Artisanal Country Sourdough Loaf',         'Artisanal Bread', 'Tier A', 55000],
            ['PRD-002', 'Valrhona Dark Chocolate Babka',            'Viennoiserie',    'Tier A', 68000],
            ['PRD-003', 'Truffle & Smoked Beef Croissant',          'Savory Pastry',   'Tier A', 48000],
            ['PRD-004', 'Signature Basque Burnt Cheesecake Slice',  'Cakes & Tarts',   'Tier A', 52000],
            ['PRD-005', 'French Butter Croissant',                  'Viennoiserie',    'Tier B', 28000],
            ['PRD-006', 'Pain au Chocolat',                         'Viennoiserie',    'Tier B', 32000],
            ['PRD-007', 'Japanese Milk Bread Shokupan',             'Loaves & Toast',  'Tier B', 35000],
            ['PRD-008', 'Smoked Chicken & Cheese Danish',           'Savory Pastry',   'Tier B', 30000],
            ['PRD-009', 'Pistachio Cardamom Escargot',              'Viennoiserie',    'Tier A', 42000],
            ['PRD-010', 'Classic Cinnamon Morning Roll',            'Sweet Buns',      'Tier B', 22000],
            ['PRD-011', 'Roti Kopi Klasik (Coffee Bun)',            'Sweet Buns',      'Tier C', 12000],
            ['PRD-012', 'Roti Cokelat Keju (Chocolate Cheese Bun)', 'Sweet Buns',      'Tier C', 11000],
            ['PRD-013', 'Roti Abon Ayam Gurih (Chicken Floss Bun)', 'Savory Buns',     'Tier C', 14000],
            ['PRD-014', 'Donat Kampung Gula Halus',                 'Donuts',          'Tier C', 8000],
            ['PRD-015', 'Banana Molen Danish',                      'Sweet Pastry',    'Tier C', 10000],
        ];

        foreach ($products as [$id, $name, $category, $tier, $price]) {
            Product::updateOrCreate(['product_id' => $id], [
                'product_name'          => $name,
                'category'              => $category,
                'tier_id'               => $tiers[$tier],
                'recommended_price_IDR' => $price,
            ]);
        }
    }
}
