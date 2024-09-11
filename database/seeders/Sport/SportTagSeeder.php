<?php

namespace Database\Seeders\Sport;

use App\Models\Sport\SportTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SportTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SportTag::factory(100)->create();
    }
}
