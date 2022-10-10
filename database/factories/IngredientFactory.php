<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;
use Illuminate\Support\Str;

require_once './vendor/autoload.php';

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fakerEN = Faker\Factory::create('en_US');
        $fakerFR = Faker\Factory::create('fr_FR');
        $fakerDE = Faker\Factory::create('de_DE');
        $slug = $fakerEN->unique()->word();
        $ingredient = [
            'slug' => Str::slug($slug) . '*' . rand(1111, 9999),
            'en' => [
                'title' => 'EN Ingredient - ' . strtok($fakerEN->realTextBetween(10, 20), " ")
            ],
            'fr' => [
                'title' => 'FR Ingredient - ' . strtok($fakerFR->realTextBetween(10, 20), " ")
            ],
            'de' => [
                'title' => 'DE Ingredient - ' . strtok($fakerDE->realTextBetween(10, 20), " ")
            ],
        ];

        return $ingredient;
    }
}
