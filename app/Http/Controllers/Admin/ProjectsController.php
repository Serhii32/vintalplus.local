<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(12);
        $pageTitle = 'Список проектов';
        return view('admin.projects.projects-index', compact(['projects', 'pageTitle']));
    }
    
    public function create()
    {
        $pageTitle = 'Добавить проект';
        return view('admin.projects.projects-create', compact(['pageTitle']));
    }
    
    public function store(StoreProjectRequest $request)
    {
        $project = new Project();
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
        	$project->{'title'.strtoupper($code)} = $request->{'title'.strtoupper($code)};
	        $project->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
	        $project->{'short_description'.strtoupper($code)} = $request->{'short_description'.strtoupper($code)};
	        $project->{'titleSEO'.strtoupper($code)} = $request->{'titleSEO'.strtoupper($code)};
	        $project->{'descriptionSEO'.strtoupper($code)} = $request->{'descriptionSEO'.strtoupper($code)};
	        $project->{'keywordsSEO'.strtoupper($code)} = $request->{'keywordsSEO'.strtoupper($code)};
        }
        $project->save();
        $last_insereted_id = $project->id;
        if ($request->main_photo != null) {
            $project->main_photo = $request->main_photo->store('img/common/projects/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $project->save();
        }
        return redirect()->route('admin.projects.index')->with(['message' => 'Проект успешно добавлен']);
    }
    
    public function edit(int $id)
    {
        $project = Project::findOrFail($id);
        $pageTitle = 'Редактировать ' . $project->titleRU;
        return view('admin.projects.projects-edit', compact(['project', 'pageTitle']));
    }
    
    public function update(StoreProjectRequest $request, int $id)
    {
        $project = Project::findOrFail($id);
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale) {
        	$project->{'title'.strtoupper($code)} = $request->{'title'.strtoupper($code)};
	        $project->{'description'.strtoupper($code)} = $request->{'description'.strtoupper($code)};
	        $project->{'short_description'.strtoupper($code)} = $request->{'short_description'.strtoupper($code)};
	        $project->{'titleSEO'.strtoupper($code)} = $request->{'titleSEO'.strtoupper($code)};
	        $project->{'descriptionSEO'.strtoupper($code)} = $request->{'descriptionSEO'.strtoupper($code)};
	        $project->{'keywordsSEO'.strtoupper($code)} = $request->{'keywordsSEO'.strtoupper($code)};
        }
        $project->save();
        $last_insereted_id = $project->id;
        if ($request->main_photo != null) {
            if($project->main_photo) {
                Storage::disk('uploaded_img')->delete($project->main_photo);
            }
            $project->main_photo = $request->main_photo->store('img/common/projects/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $project->save();
        }
        return redirect()->route('admin.projects.index')->with(['message' => 'Проект успешно обновлен']);
    }
    
    public function destroy(int $id)
    {
        Storage::disk('uploaded_img')->deleteDirectory('img/common/projects/' . $id);
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('admin.projects.index')->with(['message' => 'Новость успешно удалена']);
    }
}
