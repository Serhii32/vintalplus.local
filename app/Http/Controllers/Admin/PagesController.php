<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\Http\Requests\StorePageRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PagesController extends Controller
{
    public function jobsEdit()
    {
    	$page = Page::where('page', '=', 'Вакансии')->first();
    	$route = 'jobsUpdate';
    	return view('admin.pages.pages-edit', compact(['page', 'route']));
    }

    public function jobsUpdate(StorePageRequest $request)
    {
    	$page = Page::where('page', '=', 'Вакансии')->first();
    	foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
        	$page->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
        }
        $page->save();
        return redirect()->route('admin.pages.jobsEdit')->with(['message' => 'Страница успешно обновлена']);
    }
}
