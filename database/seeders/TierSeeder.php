<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tier;

class TierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Tier A', 'Tier B', 'Tier C'] as $name) {
            Tier::firstOrCreate(['name' => $name]);
        }
    }
}
