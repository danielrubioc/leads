<?php

namespace Database\Factories;

use App\Models\LeadAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeadAttribute>
 */
class LeadAttributeFactory extends Factory
{
    protected $model = LeadAttribute::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => $this->faker->word,
            'value' => $this->faker->text,
        ];
    }
}
