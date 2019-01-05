<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Record;
use App\Http\Requests\StoreRecordRequest;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RecordsController extends Controller
{
    public function index()
    {
        $records = Record::paginate(12);
        $pageTitle = 'Список новостей';
        return view('admin.records.records-index', compact(['records', 'pageTitle']));
    }
    
    public function create()
    {
        $pageTitle = 'Добавить новость';
        return view('admin.records.records-create', compact(['pageTitle']));
    }
    
    public function store(StoreRecordRequest $request)
    {
        $record = new Record();
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
        	$record->{'title'.strtoupper($code)} = $request->{'title'.strtoupper($code)};
	        $record->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
	        $record->{'short_description'.strtoupper($code)} = $request->{'short_description'.strtoupper($code)};
	        $record->{'titleSEO'.strtoupper($code)} = $request->{'titleSEO'.strtoupper($code)};
	        $record->{'descriptionSEO'.strtoupper($code)} = $request->{'descriptionSEO'.strtoupper($code)};
	        $record->{'keywordsSEO'.strtoupper($code)} = $request->{'keywordsSEO'.strtoupper($code)};
        }
        $record->save();
        $last_insereted_id = $record->id;
        if ($request->main_photo != null) {
            $record->main_photo = $request->main_photo->store('img/common/records/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $record->save();
        }
        return redirect()->route('admin.records.index')->with(['message' => 'Новость успешно добавлена']);
    }
    
    public function edit(int $id)
    {
        $record = Record::findOrFail($id);
        $pageTitle = 'Редактировать ' . $record->titleRU;
        return view('admin.records.records-edit', compact(['record', 'pageTitle']));
    }
    
    public function update(StoreRecordRequest $request, int $id)
    {
        $record = Record::findOrFail($id);
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
        	$record->{'title'.strtoupper($code)} = $request->{'title'.strtoupper($code)};
	        $record->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
	        $record->{'short_description'.strtoupper($code)} = $request->{'short_description'.strtoupper($code)};
	        $record->{'titleSEO'.strtoupper($code)} = $request->{'titleSEO'.strtoupper($code)};
	        $record->{'descriptionSEO'.strtoupper($code)} = $request->{'descriptionSEO'.strtoupper($code)};
	        $record->{'keywordsSEO'.strtoupper($code)} = $request->{'keywordsSEO'.strtoupper($code)};
        }
        $record->save();
        $last_insereted_id = $record->id;
        if ($request->main_photo != null) {
            if($record->main_photo) {
                Storage::disk('uploaded_img')->delete($record->main_photo);
            }
            $record->main_photo = $request->main_photo->store('img/common/records/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $record->save();
        }
        return redirect()->route('admin.records.index')->with(['message' => 'Новость успешно обновлена']);
    }
    
    public function destroy(int $id)
    {
        Storage::disk('uploaded_img')->deleteDirectory('img/common/records/' . $id);
        $record = Record::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.records.index')->with(['message' => 'Новость успешно удалена']);
    }
}
