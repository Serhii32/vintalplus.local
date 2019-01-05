<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(12);
        $pageTitle = 'Список статтей';
        return view('admin.articles.articles-index', compact(['articles', 'pageTitle']));
    }
    
    public function create()
    {
        $pageTitle = 'Добавить статью';
        return view('admin.articles.articles-create', compact(['pageTitle']));
    }
    
    public function store(StoreArticleRequest $request)
    {
        $article = new Article();
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
        	$article->{'title'.strtoupper($code)} = $request->{'title'.strtoupper($code)};
	        $article->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
	        $article->{'short_description'.strtoupper($code)} = $request->{'short_description'.strtoupper($code)};
	        $article->{'titleSEO'.strtoupper($code)} = $request->{'titleSEO'.strtoupper($code)};
	        $article->{'descriptionSEO'.strtoupper($code)} = $request->{'descriptionSEO'.strtoupper($code)};
	        $article->{'keywordsSEO'.strtoupper($code)} = $request->{'keywordsSEO'.strtoupper($code)};
        }
        $article->save();
        $last_insereted_id = $article->id;
        if ($request->main_photo != null) {
            $article->main_photo = $request->main_photo->store('img/common/articles/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $article->save();
        }
        return redirect()->route('admin.articles.index')->with(['message' => 'Статья успешно добавлена']);
    }
    
    public function edit(int $id)
    {
        $article = Article::findOrFail($id);
        $pageTitle = 'Редактировать ' . $article->titleRU;
        return view('admin.articles.articles-edit', compact(['article', 'pageTitle']));
    }
    
    public function update(StoreArticleRequest $request, int $id)
    {
        $article = Article::findOrFail($id);
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
        	$article->{'title'.strtoupper($code)} = $request->{'title'.strtoupper($code)};
	        $article->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
	        $article->{'short_description'.strtoupper($code)} = $request->{'short_description'.strtoupper($code)};
	        $article->{'titleSEO'.strtoupper($code)} = $request->{'titleSEO'.strtoupper($code)};
	        $article->{'descriptionSEO'.strtoupper($code)} = $request->{'descriptionSEO'.strtoupper($code)};
	        $article->{'keywordsSEO'.strtoupper($code)} = $request->{'keywordsSEO'.strtoupper($code)};
        }
        $article->save();
        $last_insereted_id = $article->id;
        if ($request->main_photo != null) {
            if($article->main_photo) {
                Storage::disk('uploaded_img')->delete($article->main_photo);
            }
            $article->main_photo = $request->main_photo->store('img/common/articles/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $article->save();
        }
        return redirect()->route('admin.articles.index')->with(['message' => 'Статья успешно обновлена']);
    }
    
    public function destroy(int $id)
    {
        Storage::disk('uploaded_img')->deleteDirectory('img/common/articles/' . $id);
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('admin.articles.index')->with(['message' => 'Статья успешно удалена']);
    }
}