<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\Http\Requests\StoreServiceRequest;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::paginate(12);
        $pageTitle = 'Список услуг';
        return view('admin.services.services-index', compact(['services', 'pageTitle']));
    }
    
    public function create()
    {
        $pageTitle = 'Добавить услугу';
        return view('admin.services.services-create', compact(['pageTitle']));
    }
    
    public function store(StoreServiceRequest $request)
    {
        $service = new Service();
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
        	$service->{'title'.strtoupper($code)} = $request->{'title'.strtoupper($code)};
	        $service->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
	        $service->{'short_description'.strtoupper($code)} = $request->{'short_description'.strtoupper($code)};
	        $service->{'titleSEO'.strtoupper($code)} = $request->{'titleSEO'.strtoupper($code)};
	        $service->{'descriptionSEO'.strtoupper($code)} = $request->{'descriptionSEO'.strtoupper($code)};
	        $service->{'keywordsSEO'.strtoupper($code)} = $request->{'keywordsSEO'.strtoupper($code)};
        }
        $service->save();
        $last_insereted_id = $service->id;
        if ($request->main_photo != null) {
            $service->main_photo = $request->main_photo->store('img/common/services/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $service->save();
        }
        return redirect()->route('admin.services.index')->with(['message' => 'Услуга успешно добавлена']);
    }
    
    public function edit(int $id)
    {
        $service = Service::findOrFail($id);
        $pageTitle = 'Редактировать ' . $service->titleRU;
        return view('admin.services.services-edit', compact(['service', 'pageTitle']));
    }
    
    public function update(StoreServiceRequest $request, int $id)
    {
        $service = Service::findOrFail($id);
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
        	$service->{'title'.strtoupper($code)} = $request->{'title'.strtoupper($code)};
	        $service->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
	        $service->{'short_description'.strtoupper($code)} = $request->{'short_description'.strtoupper($code)};
	        $service->{'titleSEO'.strtoupper($code)} = $request->{'titleSEO'.strtoupper($code)};
	        $service->{'descriptionSEO'.strtoupper($code)} = $request->{'descriptionSEO'.strtoupper($code)};
	        $service->{'keywordsSEO'.strtoupper($code)} = $request->{'keywordsSEO'.strtoupper($code)};
        }
        $service->save();
        $last_insereted_id = $service->id;
        if ($request->main_photo != null) {
            if($service->main_photo) {
                Storage::disk('uploaded_img')->delete($service->main_photo);
            }
            $service->main_photo = $request->main_photo->store('img/common/services/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $service->save();
        }
        return redirect()->route('admin.services.index')->with(['message' => 'Услуга успешно обновлена']);
    }
    
    public function destroy(int $id)
    {
        Storage::disk('uploaded_img')->deleteDirectory('img/common/services/' . $id);
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('admin.services.index')->with(['message' => 'Услуга успешно удалена']);
    }
}
