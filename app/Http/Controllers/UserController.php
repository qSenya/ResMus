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
            "email" => $request->email,
            "password" => $request->password,
        ]);
        if($user){
            return redirect('/lk')->with('success', "Вы успешно авторизовались!");
        } else {
            return redirect()->back()->with('error', 'Неправильная почта или пароль');
        }
        
    }

    function reg_validate(Request $request){
        $request->validate([
            'nickname'=> ['required', 'unique:users'],
            'email'=> ['required', 'unique:users'],
            'password'=> 'required',
            'confirm_pass'=>['required', 'same:password']
        ], [
            "confirm_pass.same" => "Пароли не совпадают!",
            'nickname'=> "Псевдоним должен быть уникальным!",
            'email'=> "Почта должен быть уникальной!",
            'password'=> "Поле с паролем должно быть заполнено!"
        ]);
        $user = User::create([
            
            "nickname" => $request->nickname,
            "email" => $request->email,
            "role" => 2,
            "avatar" => "avatar/default_avatar.jpg",
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
        $songs_count = Song::where('nickname', Auth::user()->nickname)->select(DB::raw("SUM(complaints_count) as complaints"))->get();
        $songs = Song::where('nickname', Auth::user()->nickname)->orderBy("created_at", "desc")->paginate(3);
        return view("lk", 
        ["songs" => $songs, "genres" => $genres, "user_info" => $user, "count" => $songs_count]);
    }
    

    function signout(){
        Session::flush();
        
        Auth::logout();

        return redirect('/');
    }

    function lk_redact(User $id) {
        return view("redact_profile", ["user" => $id]);
    }

    function redact_profile(Request $request, User $user) {

        $request->validate([
            'password' =>  ['required'],
            'confirm_pass'=>['required', 'same:password']
        ], [
            'password.required'=> 'Пароль не может быть пустым',

        ]);

            $user->update([
            'password' => $request->password,
            ]);
        $user->save();
     
        if($user){
            return redirect()->route('lk')->with('success_redact_prof', "Вы успешно сменили пароль!");
        } else {
            return redirect()->back()->with('error_redact', "Данные заполены неверно");
        }
    }

}
