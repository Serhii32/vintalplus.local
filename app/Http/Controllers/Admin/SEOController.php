<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SEO_Page;
use App\Http\Requests\StoreSEORequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SEOController extends Controller
{
    public function index()
    {
    	$pages = SEO_Page::all();
    	return view('admin.pagesSEO.pagesSEO-index', compact(['pages']));
    }

    public function update(StoreSEORequest $request)
    {
    	for($i = 1; $i <= (count($request->all())-2)/(3*count(LaravelLocalization::getLocalesOrder())); $i++)
        {
    		$page = SEO_Page::findOrFail($i);
    		foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
        	{
	    		$page->{'titleSEO'.strtoupper($code)} = $request->input('titleSEO'.strtoupper($code).'_'.$i);
	    		$page->{'descriptionSEO'.strtoupper($code)} = $request->input('descriptionSEO'.strtoupper($code).'_'.$i);
	    		$page->{'keywordsSEO'.strtoupper($code)} = $request->input('keywordsSEO'.strtoupper($code).'_'.$i);
    		}
    		$page->save();
    	}
    	return redirect()->route('admin.pagesSEO.index')->with(['message' => 'SEO страниц успешно обновлено']);
    }
}
