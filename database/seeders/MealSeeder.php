<?php

namespace Database\Seeders;

ini_set('memory_limit', '2048M');

use Faker;
use App\Models\Tag;
use App\Models\Meal;
use App\Models\Category;
use App\Models\Language;
use App\Models\Ingredient;
use App\Models\MealTranslation;
use Illuminate\Database\Seeder;

require_once './vendor/autoload.php';
class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = Ingredient::factory(10)->create();
        $tags = Tag::factory(10)->create();

        Meal::factory(5)->create()->each(function ($meal) use ($ingredients, $tags) {
            Category::factory(rand(0, 1))->create([
                'meal_id' => $meal->id
            ]);
            $meal->ingredients()->attach($ingredients->random(rand(1, 4)));
            $meal->tags()->attach($tags->random(rand(1, 3)));
        });
    }
}
