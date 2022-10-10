<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use Translatable, HasFactory;
    public $translatedAttributes = ['title'];
    protected $fillable = ['slug'];

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
