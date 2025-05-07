<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category'
    ];

    public function subCategories(){
        return $this->hasMany('App\Models\Categories\SubCategory');
    }

    public function posts(){
        return $this->belongsToMany('App\Models\Posts\Post', 'post_main_categories', 'main_category_id', 'post_id');
    }

}
