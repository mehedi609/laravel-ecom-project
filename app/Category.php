<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  public function setNameAttribute($value)
  {
    $this->attributes['name'] = $value;
    $this->attributes['url'] = str_slug($value);
  }

  public function products()
  {
    return $this->hasMany('App\Product');
  }

}
