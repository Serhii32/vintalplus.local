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

    public function contactsEdit()
    {
        $page = Page::where('page', '=', 'Контакты')->first();
        $route = 'contactsUpdate';
        return view('admin.pages.pages-edit', compact(['page', 'route']));
    }

    public function contactsUpdate(StorePageRequest $request)
    {
        $page = Page::where('page', '=', 'Контакты')->first();
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
            $page->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
        }
        $page->save();
        return redirect()->route('admin.pages.contactsEdit')->with(['message' => 'Страница успешно обновлена']);
    }

    public function deliveryPaymentEdit()
    {
        $page = Page::where('page', '=', 'Доставка и оплата')->first();
        $route = 'deliveryPaymentUpdate';
        return view('admin.pages.pages-edit', compact(['page', 'route']));
    }

    public function deliveryPaymentUpdate(StorePageRequest $request)
    {
        $page = Page::where('page', '=', 'Доставка и оплата')->first();
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
            $page->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
        }
        $page->save();
        return redirect()->route('admin.pages.deliveryPaymentEdit')->with(['message' => 'Страница успешно обновлена']);
    }

    public function aboutEdit()
    {
        $page = Page::where('page', '=', 'О нас')->first();
        $route = 'aboutUpdate';
        return view('admin.pages.pages-edit', compact(['page', 'route']));
    }

    public function aboutUpdate(StorePageRequest $request)
    {
        $page = Page::where('page', '=', 'О нас')->first();
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
            $page->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
        }
        $page->save();
        return redirect()->route('admin.pages.aboutEdit')->with(['message' => 'Страница успешно обновлена']);
    }
}
