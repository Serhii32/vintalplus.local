<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Partner;
use App\Http\Requests\StorePartnerRequest;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PartnersController extends Controller
{
    public function index()
    {
        $partners = Partner::paginate(12);
        $pageTitle = 'Список партнеров';
        return view('admin.partners.partners-index', compact(['partners', 'pageTitle']));
    }
    
    public function create()
    {
        $pageTitle = 'Добавить партнера';
        return view('admin.partners.partners-create', compact(['pageTitle']));
    }
    
    public function store(StorePartnerRequest $request)
    {
        $partner = new Partner();
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
        	$partner->{'title'.strtoupper($code)} = $request->{'title'.strtoupper($code)};
        }
        $partner->save();
        $last_insereted_id = $partner->id;
        if ($request->main_photo != null) {
            $partner->main_photo = $request->main_photo->store('img/common/partners/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $partner->save();
        }
        return redirect()->route('admin.partners.index')->with(['message' => 'Партнер успешно добавлен']);
    }
    
    public function edit(int $id)
    {
        $partner = Partner::findOrFail($id);
        $pageTitle = 'Редактировать ' . $partner->titleRU;
        return view('admin.partners.partners-edit', compact(['partner', 'pageTitle']));
    }
    
    public function update(StorePartnerRequest $request, int $id)
    {
        $partner = Partner::findOrFail($id);
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
        	$partner->{'title'.strtoupper($code)} = $request->{'title'.strtoupper($code)};
        }
        $partner->save();
        $last_insereted_id = $partner->id;
        if ($request->main_photo != null) {
            if($partner->main_photo) {
                Storage::disk('uploaded_img')->delete($partner->main_photo);
            }
            $partner->main_photo = $request->main_photo->store('img/common/partners/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $partner->save();
        }
        return redirect()->route('admin.partners.index')->with(['message' => 'Партнер успешно обновлен']);
    }
    
    public function destroy(int $id)
    {
        Storage::disk('uploaded_img')->deleteDirectory('img/common/partners/' . $id);
        $partner = Partner::findOrFail($id);
        $partner->delete();
        return redirect()->route('admin.partners.index')->with(['message' => 'Партнер успешно удален']);
    }
}
