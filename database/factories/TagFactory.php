<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;
use Illuminate\Support\Str;

require_once './vendor/autoload.php';
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
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
        $tag = [
            'slug' => Str::slug($slug) . '*' . rand(1111, 9999),
            'en' => [
                'title' => 'EN Tag - ' . strtok($fakerEN->realTextBetween(10, 20), " ")
            ],
            'fr' => [
                'title' => 'FR Tag - ' . strtok($fakerFR->realTextBetween(10, 20), " ")
            ],
            'de' => [
                'title' => 'DE Tag - ' . strtok($fakerDE->realTextBetween(10, 20), " ")
            ],
        ];

        return $tag;
    }
}
