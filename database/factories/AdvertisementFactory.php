<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake('en_US')->jobTitle(),
            'description' => fake('en_US')->realText(500),
            'wages' => 10.0,
            'location' => fake('en_US')->postcode . " ". fake()->city . " ".fake()->country,
            'workTime' => '8hrs',
            'company_id' => CompanyFactory::factoryForModel(Company::class)
        ];
    }
}
