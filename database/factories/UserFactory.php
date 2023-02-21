<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (User $user) {
            return $user->assignRole('user');
        });
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $password = Hash::make("jobBoard");
        return [
            'name' => fake('en_US')->name(),
            'email' => fake('en_US')->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => $password, // password
            'phone' => fake('en_US')->phoneNumber(),
            'remember_token' => Str::random(),
        ];
    }
    /**
     * @param array|\Spatie\Permission\Contracts\Role|string  ...$roles
     * @return UserFactory
     */
    private function assignRole(...$roles): UserFactory
    {
        return $this->afterCreating(fn (User $user) => $user->syncRoles($roles));
    }
    /**
     * Indicate that the user is an admin.
     *
     * @return Factory
     */
    public function admin(): UserFactory
    {
        return $this->assignRole('admin');
    }
    /**
     * create a real admin
     *
     * @param  mixed $name
     * @param  mixed $email
     * @param  mixed $pwd
     * @param  mixed $phone
     * @return UserFactory
     */
    public function createOneadmin(string $name, string $email, string $pwd, string $phone)
    {
        return $this->make([
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make($pwd),
            'phone' => $phone,
            'remember_token' => Str::random(),
        ])
        ->assignRole('admin')->save();
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
