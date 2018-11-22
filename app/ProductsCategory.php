<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsCategory extends Model
{
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function childs() 
    {
        return $this->hasMany('App\ProductsCategory','parent_id','id') ;
    }
}
