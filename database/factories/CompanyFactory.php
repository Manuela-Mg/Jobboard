<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Company;
use App\Models\Advertisement;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake('en_US')->company(),
            'email' => fake('en_US')->unique()->companyEmail(),
            'intro' => fake('en_US')->realText(500),
            'address' => fake('en_US')->address(),
            'phone' => fake('en_US')->phoneNumber(),
            'webSite' => fake('en_US')->url(),
            'user_id' => UserFactory::factoryForModel(User::class)
        ];
    }
}
