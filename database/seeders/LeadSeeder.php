<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lead;
use App\Models\Profile;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asigna leads a perfiles ya existentes
        $profiles = Profile::all();

        foreach ($profiles as $profile) {
            Lead::factory()->count(3)->create(['profile_id' => $profile->id]);
        }
    }
}
