<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function index()
    {
     //    $pageSEO = SEO_Page::where('page', '=', 'Главная')->first();
    	// $pageTitle = $pageSEO->titleSEO;
     //    $pageDescription = $pageSEO->descriptionSEO;
     //    $pageKeywords = $pageSEO->keywordsSEO;
     //    $products = Product::paginate(12);
        $homeActive = true;
    	return view('index', compact(['homeActive']));
    }

    public function deliveryPayment()
    {
        // $pageSEO = SEO_Page::where('page', '=', 'Доставка и оплата')->first();
        // $pageTitle = $pageSEO->titleSEO;
        // $pageDescription = $pageSEO->descriptionSEO;
        // $pageKeywords = $pageSEO->keywordsSEO;
        $delivery_and_paymentActive = true;
        return view('delivery-payment', compact(['delivery_and_paymentActive']));
    }

    public function about()
    {
        // $pageSEO = SEO_Page::where('page', '=', 'О нас')->first();
        // $pageTitle = $pageSEO->titleSEO;
        // $pageDescription = $pageSEO->descriptionSEO;
        // $pageKeywords = $pageSEO->keywordsSEO;
        $aboutActive = true;
        return view('about', compact(['aboutActive']));
    }

    public function contacts()
    {
        // $pageSEO = SEO_Page::where('page', '=', 'Контакты')->first();
        // $pageTitle = $pageSEO->titleSEO;
        // $pageDescription = $pageSEO->descriptionSEO;
        // $pageKeywords = $pageSEO->keywordsSEO;
        $contactsActive = true;
        return view('contacts', compact(['contactsActive']));
    }

    public function products()
    {
        // $pageSEO = SEO_Page::where('page', '=', 'Товары и услуги')->first();
        // $pageTitle = $pageSEO->titleSEO;
        // $pageDescription = $pageSEO->descriptionSEO;
        // $pageKeywords = $pageSEO->keywordsSEO;
        // $productsActive = true;
        // $products = Product::paginate(12);
        $productsActive = true;
        return view('products', compact(['productsActive']));
    }

    public function partners()
    {
    	$partnersActive = true;
    	return view('partners', compact(['partnersActive']));
    }

    public function articles()
    {
    	$articlesActive = true;
    	// dd(App::getLocale());
    	return view('articles', compact(['articlesActive']));
    }

    public function projects()
    {
    	$projectsActive = true;
    	return view('projects', compact(['projectsActive']));
    }

    public function jobs()
    {
    	$jobsActive = true;
    	return view('jobs', compact(['jobsActive']));
    }

}
