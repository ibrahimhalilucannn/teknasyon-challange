<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class TeknasyonController extends Controller
{
    public function  index(){
        if (Auth::check()) {
            return view('index');
        }
        else{
            return Redirect::to('login');
        }
    }
    public function signin(Request $request) {

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
        ]);

        $username =$request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password, 'username' =>$username])) {

            $kosul = ['email' => $email];
            $users = User::where($kosul)->first();
            if($users->status == 0){
                session()->flash('status_danger', trans('teknasyon/alert.status_danger'));
                return redirect()->back()->withInput();
            }else{
                Session::put('username', $username);
                Session::put('name', $users->name);
                Session::put('surname', $users->surname);

                session()->flash('user_login_success', trans('teknasyon/alert.user_login_success'));
                return Redirect::to('/');
            }



        } else {//Girilen bilgiler hatalı yada sisteminiz aktif değil


            session()->flash('user_login_danger', trans('teknasyon/alert.user_login_danger'));
            return redirect()->back()->withInput();
        }
    }
    public function login() {
        if (Auth::check()) {
            return Redirect::to('/');
        } else {

            /*
            $user = new User();
            $user->username = 'teknasyon';
            $user->name     = 'Teknasyon';
            $user->surname  = 'Yazılım';
            $user->email    = 'info@teknasyon.com';
            $user->password = bcrypt('Teknasyon?Y_S*');
            $user->status   = 1;
            $user->role     = 0;
            $user->save();
            */

            return view('login');
        }
    }
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect::to('/login');
    }

}
