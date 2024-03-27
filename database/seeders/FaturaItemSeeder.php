<?php

namespace Database\Seeders;

use App\Models\FaturaItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaturaItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FaturaItem::factory(10)->create();
    }
}
