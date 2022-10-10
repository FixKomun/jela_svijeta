<?php

namespace Database\Factories;

use Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

require_once './vendor/autoload.php';
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
        $category = [
            'slug' => Str::slug($slug) . '*' . rand(1111, 9999),
            'en' => [
                'title' => 'EN Category - ' . strtok($fakerEN->realTextBetween(10, 30), " ")
            ],
            'fr' => [
                'title' => 'FR Category - ' . strtok($fakerFR->realTextBetween(10, 30), " ")
            ],
            'de' => [
                'title' => 'DE Category - ' . strtok($fakerDE->realTextBetween(10, 30), " ")
            ],
        ];

        return $category;
    }
}
