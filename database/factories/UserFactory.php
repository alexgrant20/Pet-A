<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
   /**
    * The current password being used by the factory.
    */
   protected static ?string $password;

   /**
    * Define the model's default state.
    *
    * @return array<string, mixed>
    */
   public function definition(): array
   {
      return [
         'name' => fake()->name(),
         'email' => fake()->unique()->safeEmail(),
         'password' => static::$password ??= Hash::make('password'),
         'address' => fake()->address(),
         'birth_date' => fake()->date(),
         'gender' => fake()->randomElement(['m', 'f']),
         'profile_type' => 'App\Models\PetOwner',
         'profile_id' => 1,
      ];
   }
}
