<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\DataViewer;

class Product extends Model
{
  use DataViewer;

  public static $columns = [
    'id', 'name', 'description',
    'slug', 'image', 'category_id',
    'subcategory_id', 'user_id',
    'created_at', 'updated_at'
  ];

  public function category() {
    return $this->belongsTo('App\Category');
  }

  public function tags() {
    return $this->belongsToMany('App\Tag');
  }

  public function SubCategory() {
    return $this->belongsTo('App\SubCategory', 'category_id');
  }

  public function comments() {
    return $this->hasMany('App\Comment');
  }

  public function users() {
    return $this->belongsTo('App\User');
  }
}
