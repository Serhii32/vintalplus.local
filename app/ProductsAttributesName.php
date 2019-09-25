<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsAttributesName extends Model
{
    public function products()
    {
    	return $this->belongsToMany('App\Product', 'product_products_attributes_name', 'products_attributes_name_id', 'product_id')->withPivot('priority')->withTimestamps();
    }

    public function values()
    {
    	return $this->belongsToMany('App\ProductsAttributesValue', 'products_attributes_name_products_attributes_value', 'products_attributes_name_id', 'products_attributes_value_id')->withTimestamps();
    }
}
