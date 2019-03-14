<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localizationRedirect']], function() {

	Route::get('/', ['as' => 'page.index', 'uses' => 'PagesController@index']);

	Route::get('delivery-payment', ['as' => 'page.delivery-payment', 'uses' => 'PagesController@deliveryPayment']);

	Route::get('about', ['as' => 'page.about', 'uses' => 'PagesController@about']);

	Route::get('contacts', ['as' => 'page.contacts', 'uses' => 'PagesController@contacts']);

	Route::get('products', ['as' => 'page.products', 'uses' => 'PagesController@products']);

	Route::get('partners', ['as' => 'page.partners', 'uses' => 'PagesController@partners']);

	Route::get('articles', ['as' => 'page.articles', 'uses' => 'PagesController@articles']);

	Route::get('projects', ['as' => 'page.projects', 'uses' => 'PagesController@projects']);

	Route::get('catalog', ['as' => 'page.catalog', 'uses' => 'PagesController@catalog']);

	Route::get('categories', ['as' => 'page.categories', 'uses' => 'PagesController@categories']);

	Route::get('jobs', ['as' => 'page.jobs', 'uses' => 'PagesController@jobs']);

	Route::get('records', ['as' => 'page.records', 'uses' => 'PagesController@records']);

	Route::get('services', ['as' => 'page.services', 'uses' => 'PagesController@services']);

	Route::get('article/{articleId}', ['as' => 'page.article', 'uses' => 'PagesController@article']);

	Route::get('category/{categoryId}', ['as' => 'page.category', 'uses' => 'PagesController@category']);

	Route::get('product/{productId}', ['as' => 'page.product', 'uses' => 'PagesController@product']);

	Route::get('record/{recordId}', ['as' => 'page.record', 'uses' => 'PagesController@record']);

	Route::get('project/{projectId}', ['as' => 'page.project', 'uses' => 'PagesController@project']);

	Route::get('service/{serviceId}', ['as' => 'page.service', 'uses' => 'PagesController@service']);

	Route::post('order',['as' => 'order', 'uses' => 'PagesController@order']);

	Route::get('search', ['as' => 'page.search', 'uses' => 'PagesController@search']);

});

Route::group(['namespace' => 'Admin', 'middleware' => 'auth', 'as' => 'admin.', 'prefix'=>'admin'], function () {

	Route::get('home', ['as' => 'home.index', 'uses' => 'HomeController@index']);
	Route::get('home/edit', ['as' => 'home.edit', 'uses' => 'HomeController@edit']);
	Route::match(['put', 'patch'], 'home/store', ['as' => 'home.update', 'uses' => 'HomeController@update']);

	Route::resource('productsCategories', 'ProductsCategoriesController')->except(['create', 'show']);
	
	Route::delete('productsCategories/removeProductFromCategory/{productId}', ['as' => 'productsCategories.removeProductFromCategory', 'uses' => 'ProductsCategoriesController@removeProductFromCategory']);

	Route::resource('products', 'ProductsController')->except(['show']);

	Route::get('products/copy/{product}/{url}', ['as' => 'products.copy', 'uses' => 'ProductsController@copy']);

	Route::resource('articles', 'ArticlesController')->except(['show']);

	Route::resource('attributes', 'AttributesController')->except(['show']);

	Route::resource('records', 'RecordsController')->except(['show']);

	Route::resource('projects', 'ProjectsController')->except(['show']);

	Route::resource('partners', 'PartnersController')->except(['show']);

	Route::resource('services', 'ServicesController')->except(['show']);

	Route::get('pages/jobsEdit', ['as' => 'pages.jobsEdit', 'uses' => 'PagesController@jobsEdit']);

	Route::match(['put', 'patch'], 'pages/jobsUpdate', ['as' => 'pages.jobsUpdate', 'uses' => 'PagesController@jobsUpdate']);

	Route::get('pages/contactsEdit', ['as' => 'pages.contactsEdit', 'uses' => 'PagesController@contactsEdit']);

	Route::match(['put', 'patch'], 'pages/contactsUpdate', ['as' => 'pages.contactsUpdate', 'uses' => 'PagesController@contactsUpdate']);

	Route::get('pages/deliveryPaymentEdit', ['as' => 'pages.deliveryPaymentEdit', 'uses' => 'PagesController@deliveryPaymentEdit']);

	Route::match(['put', 'patch'], 'pages/deliveryPaymentUpdate', ['as' => 'pages.deliveryPaymentUpdate', 'uses' => 'PagesController@deliveryPaymentUpdate']);
	
	Route::get('pages/aboutEdit', ['as' => 'pages.aboutEdit', 'uses' => 'PagesController@aboutEdit']);

	Route::match(['put', 'patch'], 'pages/aboutUpdate', ['as' => 'pages.aboutUpdate', 'uses' => 'PagesController@aboutUpdate']);

	Route::get('pagesSEO', ['as' => 'pagesSEO.index', 'uses' => 'SEOController@index']);

	Route::match(['put', 'patch'], 'pagesSEO/update', ['as' => 'pagesSEO.update', 'uses' => 'SEOController@update']);

	Route::get('products/productAttributeDestroy/{productId}/{attributeNameId}/{attributeValueId}', ['as' => 'products.productAttributeDestroy', 'uses' => 'ProductsController@productAttributeDestroy']);

	Route::post('upload-image', ['as' => 'upload-image', 'uses' => 'CKEditorImageController@uploadImage']);
	Route::get('uploaded-images', ['as' => 'uploaded-images.index', 'uses' => 'CKEditorImageController@index']);
	Route::delete('uploaded-images/{imageName}', ['as' => 'uploaded-images.destroy', 'uses' => 'CKEditorImageController@destroy']);

});