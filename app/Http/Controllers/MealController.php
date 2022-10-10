<?php


namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Meal;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\MealRequest;
use App\Models\CategoryTranslation;
use App\Http\Resources\MealCollection;

class MealController extends Controller
{
    public function index(MealRequest $request)
    {
        $validated = $request->validated();
        $meals = Meal::with(['ingredients', 'tags', 'category'])->get();

        //LANGUAGE REQUEST
        if (request('lang') == 'fr') {
            app()->setLocale('fr');
        } else if (request('lang') == 'de') {
            app()->setLocale('de');
        } else {
            app()->setLocale('en');
        }

        //PER PAGE REQUEST
        if (request('per_page')) {
            $meals = Meal::paginate($validated['per_page']);
            $meals->appends($request->all());
        }
        //CATEGORY ID

        //TAG ID



        //WITH REQUEST - category,ingredients,tags
        if (request()->has('with')) {
            $requestArray = explode(",", request('with'));
            //dd($requestArray);
            $compareArray = ['ingredients', 'tags', 'category'];
            $withArray = array_intersect($requestArray, $compareArray);
            sort($withArray);

            if (request('per_page')) {
                $meals = Meal::paginate($validated['per_page']);
                $meals->appends($request->all());
            }

            //OVO NAPRAVI SA MAPPINGOM,
            /*
            if (request('tags')) {
                foreach ($meals as $meal) {
                    dd($meal->tags);
                }
            }
            */
            return view("meals", ['meals' => $meals, 'withArray' => $withArray]);
        }


        //DIFF_TIME REQUEST

        return view("meals", ['meals' => $meals]);
    }
}
