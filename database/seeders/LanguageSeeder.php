<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = ['en', 'fr', 'de'];
        if (!Language::exists()) {
            foreach ($languages as $language) {
                Language::create([
                    'lang' => $language
                ]);
            }
        }
    }
}
