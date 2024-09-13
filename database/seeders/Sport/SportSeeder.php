<?php

namespace Database\Seeders\Sport;

use App\Models\Sport\Sport;
use App\Models\Sport\SportTag;
use App\Models\Sport\SportCategory;
use App\Models\User;
use Database\Factories\Sport\SportTagFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SportSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* // Create 5 Sport entries, for each creates 5 Tags and populate also the pivot table sport_entry_tag
        $sports = Sport::factory()->count(5)->create();

        $tag = SportTag::factory()
            ->count(5)
            ->hasAttached($sports)
            ->create(); */

        // Create Sport entries with randoms tags ALREADY in the DB and populate the Pivot Table sport_entry_tag
        $sports = Sport::factory()->count(3)->create();
        $tags = SportTag::get()->random(4);
        foreach ($sports as $sport) {
            foreach ($tags as $tag) {
                DB::table('sport_entry_tag')->insert([
                    'sport_entry_id' => $sport->id,
                    'sport_tag_id' => $tag->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
