<?php

namespace App\Http\Controllers;

use App\Languages;
use App\Projects;
use App\ProjectTranslation;
use App\Version;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $items  = Projects::all();
        $versions = Version::where('status',1)->get();
        $languages = Languages::where('status',1)->get();
        return view('projects',compact('items','versions','languages'));
    }

    public function projects_insert(Request $request)
    {
        $name = $request->get('name');
        $version_id = $request->get('version_id');
        $kosul = ['name'=>$name,'version_id'=>$version_id];
        $count = Projects::proje_var_mi($kosul)->count();

        if ($count >0) {
            session()->flash('error', trans('teknasyon/alert.warning'));
            return redirect()->back()->withInput();
        }
        else
        {
            $create = Projects::create($request->all());
            session()->flash('success', trans('teknasyon/alert.insert'));
            return redirect()->back()->withInput();
        }
    }

    public function projects_update(Request $request, $id)
    {
        $name = $request->get('name');
        $version_id = $request->get('version_id');
        $edit = Projects::find($id);
        if ($edit->name == $name && $edit->version_id == $version_id){
            Projects::find($id)->update($request->all());
            session()->flash('update', trans('teknasyon/alert.update'));
            return redirect()->back()->withInput();
        }else{
            $name = $request->get('name');
            $version_id = $request->get('version_id');
            $kosul = ['name'=>$name,'version_id'=>$version_id];
            $count = Projects::proje_var_mi($kosul)->count();

            if ($count >0) {
                session()->flash('error', trans('teknasyon/alert.danger'));
                return redirect()->back()->withInput();
            }
            else
            {
                Projects::find($id)->update($request->all());
                session()->flash('update', trans('teknasyon/alert.update'));
                return redirect()->back()->withInput();
            }

        }
    }

    public function languages(Request $request, $project_id, $lang_id){

        $project = Projects::find($project_id);
        $language = Languages::find($lang_id);
        $kosul =['project_id'=> $project_id, 'language_id'=>$lang_id];
        $items = ProjectTranslation::where('project_id',$project_id)->where('language_id',$lang_id)->get();

        return view('projects-lang', compact('project','language','items'));

    }

    public function languages_insert(Request $request){
        ProjectTranslation::create($request->all());
        session()->flash('success', trans('teknasyon/alert.insert'));
        return redirect()->back()->withInput();
    }

    public function languages_update(Request $request, $id){

        ProjectTranslation::find($id)->update($request->all());
        session()->flash('update', trans('teknasyon/alert.update'));
        return redirect()->back()->withInput();

    }
}
