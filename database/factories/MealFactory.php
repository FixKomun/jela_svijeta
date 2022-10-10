<?php

namespace Database\Factories;

use Faker;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

require_once './vendor/autoload.php';

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        // WITH ENGLISH ONLY; USING LANGUAGE TABLE (DYNAMIC)//      
        /*
        $fakerEN = Faker\Factory::create('en_US');
        $languages = Language::get("lang");
        foreach ($languages as $language) {

            $mealTranslated[$language->lang] = [

                'title' => strtoupper($language->lang) . ' title - ' . $fakerEN->word(),
                'description' => strtoupper($language->lang) . ' description - ' . $fakerEN->realTextBetween(10, 20)

            ];
        }
         return $mealTranslated;
        */

        //WITH OTHER LANGUAGES USING FAKERPHP; WITHOUT LANGUAGE TABLE (STATIC) //

        $fakerEN = Faker\Factory::create('en_US');
        $fakerFR = Faker\Factory::create('fr_FR');
        $fakerDE = Faker\Factory::create('de_DE');

        $meal = [
            'en' => [
                'title' => 'EN title - ' . strtok($fakerEN->realTextBetween(10, 30), " "),
                'description' => 'EN description - ' . $fakerEN->realTextBetween(10, 30)
            ],
            'fr' => [
                'title' => 'FR title - ' . strtok($fakerFR->realTextBetween(10, 30), " "),
                'description' => 'FR description - ' . $fakerFR->realTextBetween(10, 30)
            ],
            'de' => [
                'title' => 'DE title - ' . strtok($fakerDE->realTextBetween(10, 30), " "),
                'description' => 'DE description - ' . $fakerDE->realTextBetween(10, 30)
            ],

        ];
        return $meal;
    }
}
