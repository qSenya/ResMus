<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function index() {


        return view("admin");

    }

    public function create_genre(Request $request) {

        $request->validate([
            "genre" => "required"
        ], [
            "genre.required" => "Поле название жанра должно быть заполнено!"
        ]);

        $genre = Genre::create([
            "title" => $request->genre
        ]);
        if($genre){
            return redirect()->back()->with('success_add', "Вы успешно добавили аудиозапись!");
        } else {
            return redirect()->back();
        }

    }
}
