<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categories';

  public function products() {
    return $this->hasMany('App\Product');
  }

  public function SubCategory() {
    return $this->hasMany('App\SubCategory', 'category_id', 'id');
  }
}
