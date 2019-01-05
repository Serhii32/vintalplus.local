<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductsAttributesName;
use App\ProductsAttributesValue;
use App\Http\Requests\StoreAttributeRequest;
use Illuminate\Support\Facades\Input;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AttributesController extends Controller
{
    public function index()
    {
        $attributesNames = ProductsAttributesName::all();
        $attributesValues = ProductsAttributesValue::doesntHave('names')->get();
        $pageTitle = 'Характеристики товаров';
        return view('admin.attributes.attributes-index', compact(['attributesNames', 'attributesValues', 'pageTitle']));
    }

    public function create()
    {
        if(Input::get('name') == 1){
        	$pageTitle = 'Добавить название характеристики';
        	$identificator = 'name';
        	$attributeTitleValue = 'Название';
        	return view('admin.attributes.attributes-create', compact(['attribute', 'pageTitle', 'identificator', 'attributeTitleValue']));
    	} elseif (Input::get('value') == 1) {
        	$pageTitle = 'Добавить значение характеристики';
        	$identificator = 'value';
        	$attributeTitleValue = 'Значение';
        	return view('admin.attributes.attributes-create', compact(['attribute', 'pageTitle', 'identificator', 'attributeTitleValue']));
    	} else {
    		return redirect()->back();
    	}
    }

    public function store(StoreAttributeRequest $request)
    {
        if(Input::get('name') == 1){
	        $attribute = new ProductsAttributesName;
	        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
	        {
	        	$attribute->{'name'.strtoupper($code)} = $request->{'name'.strtoupper($code)};
	    	}
	        $attribute->save();
	        return redirect()->route('admin.attributes.index')->with(['message' => 'Название характеристики успешно добавлено']);
	    } elseif (Input::get('value') == 1) {
	    	$attribute = new ProductsAttributesValue;
	        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
	        {
	        	$attribute->{'value'.strtoupper($code)} = $request->{'value'.strtoupper($code)};
	    	}
	        $attribute->save();
	        return redirect()->route('admin.attributes.index')->with(['message' => 'Значение характеристики успешно добавлено']);
	    } else {
	    	return redirect()->back();
	    }
    }

    public function edit(int $id)
    {
    	if(Input::get('name') == 1){
    		$attribute = ProductsAttributesName::findOrFail($id);
        	$pageTitle = $attribute->nameRU;
        	$identificator = 'name';
        	$attributeTitleValue = 'Название';
        	return view('admin.attributes.attributes-edit', compact(['attribute', 'pageTitle', 'identificator', 'attributeTitleValue']));
    	} elseif (Input::get('value') == 1) {
    		$attribute = ProductsAttributesValue::findOrFail($id);
        	$pageTitle = $attribute->valueRU;
        	$identificator = 'value';
        	$attributeTitleValue = 'Значение';
        	return view('admin.attributes.attributes-edit', compact(['attribute', 'pageTitle', 'identificator', 'attributeTitleValue']));
    	} else {
    		return redirect()->back();
    	}
        
    }

    public function update(StoreAttributeRequest $request, int $id)
    {
    	if(Input::get('name') == 1){
	        $attribute = ProductsAttributesName::findOrFail($id);
	        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
	        {
	        	$attribute->{'name'.strtoupper($code)} = $request->{'name'.strtoupper($code)};
	    	}
	        $attribute->save();
	        return redirect()->route('admin.attributes.index')->with(['message' => 'Название характеристики успешно обновлено']);
	    } elseif (Input::get('value') == 1) {
	    	$attribute = ProductsAttributesValue::findOrFail($id);
	        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
	        {
	        	$attribute->{'value'.strtoupper($code)} = $request->{'value'.strtoupper($code)};
	    	}
	        $attribute->save();
	        return redirect()->route('admin.attributes.index')->with(['message' => 'Значение характеристики успешно обновлено']);
	    } else {
	    	return redirect()->back();
	    }
    }

    public function destroy(int $id)
    {
    	if(Input::get('name') == 1){
	        $attribute = ProductsAttributesName::findOrFail($id);
	        $attribute->values()->detach();
	    } elseif (Input::get('value') == 1) {
	    	$attribute = ProductsAttributesValue::findOrFail($id);
	        $attribute->names()->detach();
	    } else {
	    	return redirect()->back();
	    }
        $attribute->products()->detach();
        $attribute->delete();
        return redirect()->route('admin.attributes.index')->with(['message' => 'Характеристика успешно удалена']);
    }
}
