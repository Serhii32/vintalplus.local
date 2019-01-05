<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductsCategory;
use App\ProductsAttributesName;
use App\ProductsAttributesValue;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class ProductsController extends Controller
{
    private $attributesNamesArray;
    private $attributesValuesArray;

	public function __construct()
	{
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
        {
           ${'attributesNamesArray'.strtoupper($code)} = [];
           ${'attributesValuesArray'.strtoupper($code)} = [];
        }

        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
        {
            $attributesNames = ProductsAttributesName::all();
            $attributesNamesOnlyNamesCollection = $attributesNames->map(function ($attributesName) use ($code) {
                return $attributesName->only(['name'.strtoupper($code)]);
            });

            for($i=0; $i < count($attributesNamesOnlyNamesCollection); $i++) {
                ${'attributesNamesArray'.strtoupper($code)}[$i] = $attributesNamesOnlyNamesCollection[$i]['name'.strtoupper($code)];
            }
            $attributesValues = ProductsAttributesValue::all();
            $attributesValuesOnlyValuesCollection = $attributesValues->map(function ($attributesValue) use ($code) {
                return $attributesValue->only(['value'.strtoupper($code)]);
            });
            for($i=0; $i < count($attributesValuesOnlyValuesCollection); $i++) {
                ${'attributesValuesArray'.strtoupper($code)}[$i] = $attributesValuesOnlyValuesCollection[$i]['value'.strtoupper($code)];
            }
            $this->attributesNamesArray[strtoupper($code)] = ${'attributesNamesArray'.strtoupper($code)};
            $this->attributesValuesArray[strtoupper($code)] = ${'attributesValuesArray'.strtoupper($code)};
        }
	}

    public function index()
    { 
        $products = Product::paginate(12);
        $pageTitle = 'Список товаров';
        return view('admin.products.products-index', compact(['products', 'pageTitle']));
    }

    public function create()
    {
        $categories = ProductsCategory::pluck('titleRU','id')->all();
        $pageTitle = 'Добавить товар';
        return view('admin.products.products-create', compact(['categories', 'pageTitle']), ['attributesNamesArray' => $this->attributesNamesArray, 'attributesValuesArray' => $this->attributesValuesArray]);
    }
    
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
        {
        	$product->{'title'.strtoupper($code)} = $request->{'title'.strtoupper($code)};
        	$product->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
        	$product->{'short_description'.strtoupper($code)} = $request->{'short_description'.strtoupper($code)};
        	$product->{'titleSEO'.strtoupper($code)} = $request->{'titleSEO'.strtoupper($code)};
	        $product->{'descriptionSEO'.strtoupper($code)} = $request->{'descriptionSEO'.strtoupper($code)};
    	    $product->{'keywordsSEO'.strtoupper($code)} = $request->{'keywordsSEO'.strtoupper($code)};
        }
        $product->price = $request->price;
        $product->priority = $request->priority ?: 0;
        $product->category_id = $request->category;
        $product->youtube = $request->youtube;
        $product->save();
        $last_insereted_id = $product->id;
        if ($request->main_photo != null) {
            $product->main_photo = $request->main_photo->store('img/common/products/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $product->save();
        }
        if ($request->main_video != null) {
            $product->main_video = $request->main_video->store('video/common/products/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $product->save();
        }
        if (isset($request->attributes_namesRU) && $request->all()['attributes_namesRU'] != null && $request->all()['attributes_valuesRU'] != null) {
            for($i = 0; $i < count($request->all()['attributes_namesRU']); $i++) {
            	$productsAttributesNames = ProductsAttributesName::all();
            	$productsAttributesValues = ProductsAttributesValue::all();
            	$productAttributesNameExist = 0;
            	$productAttributesValueExist = 0;

                $counterN = 0;
                $counterV = 0;
                foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
                	foreach($productsAttributesNames as $productsAttributesName) {
                		if($request->all()['attributes_names'.strtoupper($code)][$i] == $productsAttributesName->{'name'.strtoupper($code)}) {
                			$productAttributesNameExist = $productsAttributesName->id;
                            $counterN++;
                			// break;
                		}
                	}
                    foreach($productsAttributesValues as $productsAttributesValue) {
                        if($request->all()['attributes_values'.strtoupper($code)][$i] == $productsAttributesValue->{'value'.strtoupper($code)}) {
                            $productAttributesValueExist = $productsAttributesValue->id;
                            $counterV++;
                            // break;
                        }
                    }
                }
                if($counterN != count(LaravelLocalization::getLocalesOrder())) {
                    $productAttributesNameExist = 0;
                }
                if($counterV != count(LaravelLocalization::getLocalesOrder())) {
                    $productAttributesValueExist = 0;
                }
            	
            	if ($productAttributesNameExist) {
            		$productsAttributesNameNew = ProductsAttributesName::find($productAttributesNameExist);
            	} else {
            		$productsAttributesNameNew = new ProductsAttributesName();
            		foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
            		{
            			$productsAttributesNameNew->{'name'.strtoupper($code)} = $request->all()['attributes_names'.strtoupper($code)][$i];
            		}
	            	$productsAttributesNameNew->save();
            	}
            	if ($productAttributesValueExist) {
            		$productsAttributesValueNew = ProductsAttributesValue::find($productAttributesValueExist);
            	} else {
            		$productsAttributesValueNew = new ProductsAttributesValue();
            		foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
            		{
            			$productsAttributesValueNew->{'value'.strtoupper($code)} = $request->all()['attributes_values'.strtoupper($code)][$i];
            		}
	            	$productsAttributesValueNew->save();
            	}

            	if ($productAttributesNameExist && $productAttributesValueExist && $productsAttributesName->values()->where('products_attributes_value_id', '=', $productAttributesValueExist)->whereHas('products',function($query)use($last_insereted_id){$query->where('product_id', '=', $last_insereted_id);})->first()) {
            		continue;
            	}

            	$productsAttributesNameNew->products()->attach($last_insereted_id); 
            	$productsAttributesValueNew->products()->attach($last_insereted_id); 

            	if ($productAttributesNameExist && $productAttributesValueExist && $productsAttributesName->values()->where('products_attributes_value_id', '=', $productAttributesValueExist)->first()) {
            		continue;
            	}

            	$productsAttributesValueNew->names()->attach($productsAttributesNameNew->id);
            }
        }
        
        return redirect()->to($request->redirectURL)->with(['message' => 'Товар успешно добавлен']);
    }
    
    public function edit(int $id)
    {
        $categories = ProductsCategory::pluck('titleRU','id')->all();
        $product = Product::findOrFail($id);
        $pageTitle = 'Редактировать ' . $product->titleRU;
        return view('admin.products.products-edit', compact(['product', 'categories', 'pageTitle']), ['attributesNamesArray' => $this->attributesNamesArray, 'attributesValuesArray' => $this->attributesValuesArray]);
    }

    public function copy(int $id, string $url)
    {
        $categories = ProductsCategory::pluck('titleRU','id')->all();
        $product = Product::findOrFail($id);
        $redirectURL = Crypt::decrypt($url);
        $product->main_photo = null;
        $product->main_video = null;
        $product->priority = null;
        $product->created_at = null;
        $product->updated_at = null;
        $pageTitle = 'Добавить товар';
        return view('admin.products.products-copy', compact(['product', 'categories', 'pageTitle', 'redirectURL']), ['attributesNamesArray' => $this->attributesNamesArray, 'attributesValuesArray' => $this->attributesValuesArray]);
    }
    
    public function update(StoreProductRequest $request, int $id)
    {
    	$product = Product::findOrFail($id);
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
        {
            $product->{'title'.strtoupper($code)} = $request->{'title'.strtoupper($code)};
            $product->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
            $product->{'short_description'.strtoupper($code)} = $request->{'short_description'.strtoupper($code)};
            $product->{'titleSEO'.strtoupper($code)} = $request->{'titleSEO'.strtoupper($code)};
            $product->{'descriptionSEO'.strtoupper($code)} = $request->{'descriptionSEO'.strtoupper($code)};
            $product->{'keywordsSEO'.strtoupper($code)} = $request->{'keywordsSEO'.strtoupper($code)};
        }
        $product->price = $request->price;
        $product->priority = $request->priority ?: 0;
        $product->category_id = $request->category;
        $product->youtube = $request->youtube;
        $product->save();
        $last_insereted_id = $product->id;
        if ($request->main_photo != null) {
            if($product->main_photo) {
                Storage::disk('uploaded_img')->delete($product->main_photo);
            }
            $product->main_photo = $request->main_photo->store('video/common/products/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $product->save();
        }
        if ($request->main_video != null) {
            if($product->main_video) {
                Storage::disk('uploaded_img')->delete($product->main_video);
            }
            $product->main_video = $request->main_video->store('video/common/products/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $product->save();
        }
        if (isset($request->attributes_namesRU) && $request->all()['attributes_namesRU'] != null && $request->all()['attributes_valuesRU'] != null) {
            $product->attributesNames()->detach();
            $product->attributesValues()->detach();
            for($i = 0; $i < count($request->all()['attributes_namesRU']); $i++) {
                $productsAttributesNames = ProductsAttributesName::all();
                $productsAttributesValues = ProductsAttributesValue::all();
                $productAttributesNameExist = 0;
                $productAttributesValueExist = 0;

                $counterN = 0;
                $counterV = 0;
                foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
                    foreach($productsAttributesNames as $productsAttributesName) {
                        if($request->all()['attributes_names'.strtoupper($code)][$i] == $productsAttributesName->{'name'.strtoupper($code)}) {
                            $productAttributesNameExist = $productsAttributesName->id;
                            $counterN++;
                            // break;
                        }
                    }
                    foreach($productsAttributesValues as $productsAttributesValue) {
                        if($request->all()['attributes_values'.strtoupper($code)][$i] == $productsAttributesValue->{'value'.strtoupper($code)}) {
                            $productAttributesValueExist = $productsAttributesValue->id;
                            $counterV++;
                            // break;
                        }
                    }
                }
                if($counterN != count(LaravelLocalization::getLocalesOrder())) {
                    $productAttributesNameExist = 0;
                }
                if($counterV != count(LaravelLocalization::getLocalesOrder())) {
                    $productAttributesValueExist = 0;
                }
                if ($productAttributesNameExist != 0) {
                    $productsAttributesNameNew = ProductsAttributesName::find($productAttributesNameExist);
                } else {
                    $productsAttributesNameNew = new ProductsAttributesName();
                    foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                    {
                        $productsAttributesNameNew->{'name'.strtoupper($code)} = $request->all()['attributes_names'.strtoupper($code)][$i];
                    }
                    $productsAttributesNameNew->save();
                }
                if ($productAttributesValueExist != 0) {
                    $productsAttributesValueNew = ProductsAttributesValue::find($productAttributesValueExist);
                } else {
                    $productsAttributesValueNew = new ProductsAttributesValue();
                    foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                    {
                        $productsAttributesValueNew->{'value'.strtoupper($code)} = $request->all()['attributes_values'.strtoupper($code)][$i];
                    }
                    $productsAttributesValueNew->save();
                }

                if ($productAttributesNameExist && $productAttributesValueExist && $productsAttributesName->values()->where('products_attributes_value_id', '=', $productAttributesValueExist)->whereHas('products',function($query)use($last_insereted_id){$query->where('product_id', '=', $last_insereted_id);})->first()) {
                    continue;
                }

                $productsAttributesNameNew->products()->attach($last_insereted_id); 
                $productsAttributesValueNew->products()->attach($last_insereted_id); 

                if ($productAttributesNameExist && $productAttributesValueExist && $productsAttributesName->values()->where('products_attributes_value_id', '=', $productAttributesValueExist)->first()) {
                    continue;
                }

                $productsAttributesValueNew->names()->attach($productsAttributesNameNew->id);
            }
        }
        return redirect()->to($request->redirectURL)->with(['message' => 'Товар успешно обновлен']);
    }
    
    public function destroy(int $id)
    {
        Storage::disk('uploaded_img')->deleteDirectory('img/common/products/' . $id);
        Storage::disk('uploaded_img')->deleteDirectory('video/common/products/' . $id);
    	$product = Product::findOrFail($id);
    	$product->attributesNames()->detach();
        $product->attributesValues()->detach();
        $product->delete();
        return redirect()->route('admin.products.index')->with(['message' => 'Товар успешно удален']);
    }

    public function productAttributeDestroy(int $productId, int $attributeNameId, int $attributeValueId) 
    {
    	$product = Product::findOrFail($productId);
        $idInPivotTable = $product->attributesNames()->get()->where('id', $attributeNameId)->first()->pivot->get()->where('product_id', $productId)->where('products_attributes_name_id', $attributeNameId)->first()->id;
        $product->attributesValues()->detach($attributeValueId);
        if(count($product->attributesNames()->get()->where('id', $attributeNameId)) < 2) {
            $product->attributesNames()->detach($attributeNameId);
        } else {
            DB::table('product_products_attributes_name')->where('id', $idInPivotTable)->delete();
        }
        return redirect()->back()->with(['message' => 'Характеристика успешно удалена']);
    }
}
