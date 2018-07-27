<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                $items  = User::where('role',1)->get();
                return view('user',compact('items'));
            }else{
                session()->flash('permission', trans('teknasyon/alert.info_warning'));
                return redirect()->back()->withInput();
            }
        }
        else{
            return Redirect::to('login');
        }

    }

    public function user_insert(Request $request)
    {
        if (Auth::check()) {
            $email = $request->get('email');
            $kosul = ['email'=>$email];
            $user_var_mi = User::user_var_mi($kosul)->count();

            if ($user_var_mi >0) {
                session()->flash('error', trans('teknasyon/alert.warning'));
                return redirect()->back()->withInput();
            }
            else
            {
                $password = bcrypt($request->get('password'));
                $request->merge([
                    'password' => $password,
                    'role' => 1,
                ]);
                User::create($request->all());
                session()->flash('success', trans('teknasyon/alert.insert'));
                return redirect()->back()->withInput();
            }
        }
        else{
            return Redirect::to('login');
        }

    }

    public function user_update(Request $request, $id)
    {
        if (Auth::check()) {
            $edit = User::find($id);
            if ($edit->email == $request->get('email')){
                User::find($id)->update($request->all());
                session()->flash('update', trans('teknasyon/alert.update'));
                return redirect()->back()->withInput();
            }else{
                $email = $request->get('email');
                $kosul = ['email'=>$email];
                $user_var_mi = User::user_var_mi($kosul)->count();

                if ($user_var_mi >0) {
                    session()->flash('error', trans('teknasyon/alert.danger'));
                    return redirect()->back()->withInput();
                }
                else
                {
                    User::find($id)->update($request->all());
                    session()->flash('update', trans('teknasyon/alert.update'));
                    return redirect()->back()->withInput();
                }

            }
        }
        else{
            return Redirect::to('login');
        }

    }
}
