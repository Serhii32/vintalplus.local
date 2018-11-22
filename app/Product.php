<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo('App\ProductsCategory');
    }

    public function attributesNames()
    {
    	return $this->belongsToMany('App\ProductsAttributesName', 'product_products_attributes_name', 'product_id', 'products_attributes_name_id')->withTimestamps();
    }

    public function attributesValues()
    {
    	return $this->belongsToMany('App\ProductsAttributesValue', 'product_products_attributes_value', 'product_id', 'products_attributes_value_id')->withTimestamps();
    }
}
