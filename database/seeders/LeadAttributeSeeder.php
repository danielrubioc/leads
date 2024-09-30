<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lead;
use App\Models\LeadAttribute;
use Faker\Factory as Faker;


class LeadAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Instancia de Faker
        $faker = Faker::create();

        // Asignar atributos a cada lead
        $leads = Lead::all();

        foreach ($leads as $lead) {
            LeadAttribute::create([
                'lead_id' => $lead->id,
                'key' => 'phone_number',
                'value' => $faker->phoneNumber,
            ]);

            LeadAttribute::create([
                'lead_id' => $lead->id,
                'key' => 'interest',
                'value' => $faker->randomElement(['House', 'Apartment', 'Commercial']),
            ]);
        }
    }
}
