<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use App\ProductsCategory;
use App\Product;
use App\SEO_Page;
use App\Partner;
use App\Record;
use App\Article;
use App\Page;
use App\Project;
use App\Service;
use App\Http\Requests\SendOrderToMailRequest;
use Illuminate\Support\Collection;
use App\Http\Requests\SearchRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
// use Illuminate\Support\Collection;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->productsCategories = ProductsCategory::orderBy('priority', 'desc')->orderBy('id', 'asc')->where('parent_id', '=', '0')->get();
        $this->menuRecords = Record::orderby('created_at')->get()->take(3);
        $this->locale = strtoupper(App::getLocale());
    }

    public function index()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Главная')->first();
    	$pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
        $categories = ProductsCategory::orderBy('priority', 'desc')->orderBy('id', 'asc')->get();
        $partners = Partner::all();
        $homeActive = true;
        $services = Service::all();
    	return view('index', compact(['homeActive', 'services', 'categories', 'pageTitle', 'pageDescription', 'pageKeywords', 'partners']));
    }

    public function deliveryPayment()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Доставка и оплата')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
        $delivery_and_paymentActive = true;
        return view('delivery-payment', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['delivery_and_paymentActive', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function about()
    {
        $pageSEO = SEO_Page::where('page', '=', 'О нас')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
        $aboutActive = true;
        return view('about', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['aboutActive', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function contacts()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Контакты')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
        $contactsActive = true;
        return view('contacts', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['contactsActive', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function products()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Продукция')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
        $products = Product::orderBy('priority', 'desc')->orderBy('id', 'asc')->paginate(12);
        $productsActive = true;
        return view('products', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['productsActive', 'products', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function categories()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Категории')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
        $categories = ProductsCategory::orderBy('priority', 'desc')->orderBy('id', 'asc')->paginate(12);
        return view('categories', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['categories', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function partners()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Партнеры')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
    	$partnersActive = true;
        $partners = Partner::all();
    	return view('partners', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['partnersActive', 'partners', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function articles()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Статьи')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
    	$articlesActive = true;
        $articles = Article::paginate(16);
    	return view('articles', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['articles', 'articlesActive', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function projects()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Проекты')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
    	$projectsActive = true;
        $projects = Project::paginate(12);
    	return view('projects', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['projects', 'projectsActive', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function catalog()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Каталог')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
        $catalogActive = true;
        return view('catalog', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['catalogActive', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function jobs()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Вакансии')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
        $pageContent = Page::where('page', '=', 'Вакансии')->first();
    	$jobsActive = true;
    	return view('jobs', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['jobsActive', 'pageContent', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function services()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Услуги')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
        $services = Service::all();
        return view('services', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['services', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function records()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Новости')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
        $records = Record::paginate(12);
        $newsActive = true;
        return view('records', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['records', 'pageTitle', 'pageDescription', 'pageKeywords', 'newsActive']));
    }

    public function article(int $articleId)
    {
        $article = Article::findOrFail($articleId);

        $pageTitle = $article->{'titleSEO'.$this->locale};
        $pageDescription = $article->{'descriptionSEO'.$this->locale};
        $pageKeywords = $article->{'keywordsSEO'.$this->locale};
        return view('article', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['article', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function category(int $categoryId)
    {
        $category = ProductsCategory::findOrFail($categoryId);

        $pageTitle = $category->{'titleSEO'.$this->locale};
        $pageDescription = $category->{'descriptionSEO'.$this->locale};
        $pageKeywords = $category->{'keywordsSEO'.$this->locale};
        $products = Product::where('category_id', $categoryId)->paginate(16);
        return view('category', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['category', 'products', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function product(int $productId)
    {
        $product = Product::findOrFail($productId);
        $categoryProducts = $product->category()->first()->products()->where('id', '!=', $product->id)->get();
        if(count($categoryProducts) > 6) {
            $categoryProducts = $categoryProducts->random(6);
        }
        $pageTitle = $product->{'titleSEO'.$this->locale};
        $pageDescription = $product->{'descriptionSEO'.$this->locale};
        $pageKeywords = $product->{'keywordsSEO'.$this->locale};
        return view('product', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['product', 'pageTitle', 'pageDescription', 'pageKeywords', 'categoryProducts']));
    }

    public function record(int $recordId)
    {
        $record = Record::findOrFail($recordId);

        $pageTitle = $record->{'titleSEO'.$this->locale};
        $pageDescription = $record->{'descriptionSEO'.$this->locale};
        $pageKeywords = $record->{'keywordsSEO'.$this->locale};
        return view('record', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['record', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function project(int $projectId)
    {
        $project = Project::findOrFail($projectId);

        $pageTitle = $project->{'titleSEO'.$this->locale};
        $pageDescription = $project->{'descriptionSEO'.$this->locale};
        $pageKeywords = $project->{'keywordsSEO'.$this->locale};
        return view('project', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['project', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }


    public function service(int $serviceId)
    {
        $service = Service::findOrFail($serviceId);

        $pageTitle = $service->{'titleSEO'.$this->locale};
        $pageDescription = $service->{'descriptionSEO'.$this->locale};
        $pageKeywords = $service->{'keywordsSEO'.$this->locale};
        return view('service', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['service', 'pageTitle', 'pageDescription', 'pageKeywords']));
    }

    public function order(SendOrderToMailRequest $request)
    {
        $message = "<h4>Пользователь оставил контактные данные</h4>".
        "<h4>Имя: ". $request->userName ."</h4>".
        "<h4>Телефон: ". $request->userPhone ."</h4>".
        "<h4>Email: ". $request->userEmail ."</h4>".
        "<h4><a href='http://vintalplus.local/product/". $request->hiddenProductId ."'  target='_blank'>Товар</a></h4>";
        $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail("serhii.bondarenko.ria@gmail.com", "<h4>Сделан новый заказ на сайте<h4>", $message, $headers);
        return redirect()->back()->with(["orderSuccess" => 1]);
    }

    public function search(SearchRequest $request)
    {
        $pageSEO = SEO_Page::where('page', '=', 'Поиск')->first();
        $pageTitle = $pageSEO->{'titleSEO'.$this->locale};
        $pageDescription = $pageSEO->{'descriptionSEO'.$this->locale};
        $pageKeywords = $pageSEO->{'keywordsSEO'.$this->locale};
        $searchPhrase = $request->searchPhrase;
        $products = Product::where('title'.strtoupper($this->locale), 'like', '%'.$searchPhrase.'%')->get();
        $records = Record::where('title'.strtoupper($this->locale), 'like', '%'.$searchPhrase.'%')->get();
        $articles = Article::where('title'.strtoupper($this->locale), 'like', '%'.$searchPhrase.'%')->get();
        $projects = Project::where('title'.strtoupper($this->locale), 'like', '%'.$searchPhrase.'%')->get();
        $services = Service::where('title'.strtoupper($this->locale), 'like', '%'.$searchPhrase.'%')->get();
        // $products = new Collection();
        // foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
        // {
        //     $products = $products->merge(Product::where('title'.strtoupper($code), 'like', $searchPhrase.'%')->get());
        // }
        return view('search', ['productsCategories' => $this->productsCategories, 'menuRecords' => $this->menuRecords], compact(['searchPhrase', 'pageTitle', 'pageDescription', 'pageKeywords', 'products', 'records', 'articles', 'projects', 'services']));
    }
}
