<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //

    function signin(){

        return view("signin");
    }

    function signin_validate(Request $request){
        $user = Auth::attempt([
            "login" => $request->login,
            "role" => 2,
            "password" => $request->password,
        ]);
        if($user){
            return redirect('/lk')->with('success', "Вы успешно авторизовались!");
        } else {
            return redirect()->back()->with('error', 'Неправильный логин или пароль');
        }
        
    }

    function reg_validate(Request $request){
        $request->validate([
            'nickname'=> ['required', 'unique:users'],
            'login'=> ['required', 'unique:users'],
            'password'=> 'required',
            'confirm_pass'=>['required', 'same:password']
        ], [
            "confirm_pass.same" => "Пароли не совпадают!",
            'nickname'=> "Псевдоним должен быть уникальным!",
            'login'=> "Логин должен быть уникальным!",
            'password'=> "Поле с паролем должно быть заполнено!"
        ]);
        $user = User::create([
            
            "nickname" => $request->nickname,
            "login" => $request->login,
            "role" => 2,
            "avatar" => "avatar/default_avatar.jpeg",
            "password" => Hash::make($request->password),
        ]);
        if($user){
            return redirect()->back()->with('success_reg', "Вы успешно зарегистрировались!");
        } else {
            return redirect()->back()->with('error_reg', "Логин или псевдоним уже занят");
        }
    }

    function lk(){
        $genres = Genre::all();
        $user = User::where("id", Auth::user()->id)->get();
        $songs_count = Song::where('nickname', Auth::user()->nickname)->count();
        $songs = Song::where('nickname', Auth::user()->nickname)->orderBy("created_at", "desc")->get();
        return view("lk", 
        ["songs" => $songs, "genres" => $genres, "user" => $user, "count" => $songs_count]);
    }
    

    function signout(){
        Session::flush();
        
        Auth::logout();

        return redirect('/');
    }

}
