<?php

namespace App\Http\Controllers;

use App\Version;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function index(Request $request)
    {
        $items  = Version::all();
        return view('version',compact('items'));
    }

    public function version_insert(Request $request)
    {
        $name = $request->get('name');
        $kosul = ['name'=>$name];
        $count = Version::version_var_mi($kosul)->count();

        if ($count >0) {
            session()->flash('error', trans('teknasyon/alert.warning'));
            return redirect()->back()->withInput();
        }
        else
        {
            $create = Version::create($request->all());
            session()->flash('success', trans('teknasyon/alert.insert'));
            return redirect()->back()->withInput();
        }
    }

    public function version_update(Request $request, $id)
    {
        $edit = Version::find($id);
        if ($edit->name == $request->get('name')){
            Version::find($id)->update($request->all());
            session()->flash('update', trans('teknasyon/alert.update'));
            return redirect()->back()->withInput();
        }else{
            $name = $request->get('name');
            $kosul = ['name'=>$name];
            $version_var_mi = Version::version_var_mi($kosul)->count();

            if ($version_var_mi >0) {
                session()->flash('error', trans('teknasyon/alert.danger'));
                return redirect()->back()->withInput();
            }
            else
            {
                Version::find($id)->update($request->all());
                session()->flash('update', trans('teknasyon/alert.update'));
                return redirect()->back()->withInput();
            }

        }
    }
}
