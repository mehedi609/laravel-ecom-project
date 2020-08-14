<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public function setNameAttribute($value)
  {
    $this->attributes['name'] = $value;
    $this->attributes['slug'] = str_slug($value);
  }
  
   public function category()
   {
       return $this->belongsTo('App\Category');
   }
   
}
