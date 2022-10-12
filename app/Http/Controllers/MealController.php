<?php


namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Meal;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\MealRequest;
use App\Models\CategoryTranslation;
use App\Http\Resources\MealCollection;
use Illuminate\Database\Eloquent\Builder;

class MealController extends Controller
{
    public function index(MealRequest $request)
    {
        $validated = $request->validated();
        $meals = Meal::all();

        // LANGUAGE REQUEST //
        if (request('lang') == 'fr') {
            app()->setLocale('fr');
        } else if (request('lang') == 'de') {
            app()->setLocale('de');
        } else {
            app()->setLocale('en');
        }

        // CATEGORY ID //
        if (request('category')) {

            $category = $request->get('category');
            foreach ($meals as $meal) {
                $meals = $meals->filter(function ($meal) use ($category) {
                    if ($meal->category !== null && $meal->category->id == $category) {
                        return $meal;
                    }
                    if ($category === "NULL" && $meal->category === null) {
                        return $meal;
                    }
                    if ($category === "!NULL" && $meal->category !== null) {
                        return $meal;
                    }
                })->values();
            }
        }

        // TAG ID SINGLE //
        /*
        if (request('tag')) {
            $tag = $request->get('tag');

            $meals = $meals->filter(function ($meal) use ($tag) {
                return $meal->tags->contains('id', $tag);
            })->values();
        }
        */

        //TAG ID LIST
        if (request('tags')) {
            $q_tags = explode(",", request('tags'));
            foreach ($q_tags as $q_tag) {
                $meals = Meal::whereHas('tags', function (Builder $query) use ($q_tag) {
                    $query->where('id', 'like', $q_tag);
                })->get();
            }
        }

        // WITH REQUEST - category,ingredients,tags //
        if (request()->has('with')) {
            $requestArray = explode(",", request('with'));
            //dd($requestArray);
            $compareArray = ['ingredients', 'tags', 'category'];
            $withArray = array_intersect($requestArray, $compareArray);
            sort($withArray);

            $meals = Meal::with($withArray)->get();


            if (request('category')) {
                $category = $request->get('category');
                foreach ($meals as $meal) {
                    $meals = $meals->filter(function ($meal) use ($category) {
                        if ($meal->category !== null && $meal->category->id == $category) {
                            return $meal;
                        }
                        if ($category === "NULL" && $meal->category === null) {
                            return $meal;
                        }
                        if ($category === "!NULL" && $meal->category !== null) {
                            return $meal;
                        }
                    })->values();
                }
            }

            if (request('tags')) {
                $q_tags = explode(",", request('tags'));
                foreach ($q_tags as $q_tag) {
                    $meals = Meal::whereHas('tags', function (Builder $query) use ($q_tag) {
                        $query->where('id', 'like', $q_tag);
                    })->get();
                }
            }

            if (request('per_page')) {
                $meals = Meal::paginate($validated['per_page']);
                $meals->appends($request->all());
            }
            return view("meals", ['meals' => $meals, 'withArray' => $withArray]);
        }

        // PER PAGE REQUEST //
        if (request('per_page')) {
            $meals = Meal::paginate($validated['per_page']);
            $meals->appends($request->all());
        }

        //DIFF_TIME REQUEST //
        if (request('diff_time')) {
            //Meal::first()->delete();

            $diff_time = request('diff_time');
            $softDeletedMeals = Meal::withTrashed()->where('deleted_at', '!=', null)->get();
            foreach ($softDeletedMeals as $softDeletedMeal) {

                $softDeletedMeal->status = "deleted";
                $softDeletedMeal->save();
            }

            if ($diff_time > 0) {

                $meals = Meal::withTrashed()->where('created_at', '>', $diff_time)->orWhere('updated_at', '>', $diff_time)->orWhere('deleted_at', '>', $diff_time)->get();
            }
        }

        return view("meals", ['meals' => $meals]);
    }
}
