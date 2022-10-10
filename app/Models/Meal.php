<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model implements TranslatableContract
{
    use Translatable, SoftDeletes, HasFactory;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['status'];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
    public function category()
    {
        return $this->hasOne(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
