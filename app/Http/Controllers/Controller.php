<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Genre;
use App\Models\Song;
use App\Models\User;
use GuzzleHttp\Psr7\Query;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    function index() {

        $songs = Song::take(5)->orderBy('created_at', "desc")->get();
        return view("index", 
        ["songs" => $songs]);
    }


    function add_song(Request $request) {
        $request->validate([
            'name'=>'required',
            'song'=>['required', 'extensions:mp3'],
            'image'=>'extensions:jpg,jpeg,png',
        ], [
            'name'=>'Поле "Название песни" должно быть обязательно заполненым',
            'song'=>'Песня должна быть форматом mp3',
            'image'=>'Обложка должна быть форматом jpeg jpg или png'
        ]);

        if($request->hasFile('song')) {
            $song = $request->file('song');
            $path = $song->store('songs');
        };

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $img = $image->store('img');
        } else {
            $img = "img/default_song.png";
        };

        $song = Song::create([
            "name" => $request->name,
            "song" => $path,
            "nickname" => Auth::user()->nickname,
            "image" => $img,
            "genre_id" =>$request->genre,
        ]);
        if($song){
            return redirect()->back()->with('success_song', "Вы успешно добавили аудиозапись!");
        } else {
            return redirect()->with('error_song', "Данные заполены неверно");
        }
    }

    function song_redact(Song $id) {
        return view("song_redact", [
            'song'=>$id
        ]);

    }
    

    function change_song(Request $request, Song $song) {

        $request->validate([
            'name' => 'required',
            'image'=>'extensions:jpg,jpeg,png',
        ], [
            'name.required'=> 'Название не может быть пустым',
            'image'=>'Обложка должна быть форматом jpeg jpg или png'
        ]);

        if($request->image !== null) {
            $image = $request->image;
            $img = "img/".$image;
        } else {
            $img = $request->image_last;
        };

            $song->update([
            'name' => $request->name,
            'image'=> $img,
            
            ]);
        $song->save();
     
        if($song){
            return redirect()->route('lk')->with('success_redact', "Вы успешно отредактировали аудиозапись!");
        } else {
            return redirect()->back()->with('error_redact', "Данные заполены неверно");
        }
    }

    function song_delete(Song $song) {
        $song->delete();
        return redirect()->back()->with('delete_success', 'Песня успешно удалена');
    }

    function create_complaint(Request $request) {

        $song_id = $request->song_id;

        $request->validate([
            'comment'=>'required',
        ], [
            'comment'=>'Жалоба не может быть пустой',
        ]);

        $song = Complaint::create([
            "comment" => $request->comment,
            "user_id" => Auth::user()->id,
            "song_id"=> $request->song_id,
            "status_id" => 1,
        ]);
        if($song){
            Song::where('id', $song_id)->increment('complaints_count', 1);
            return redirect('/')->with('success_complaint', "Жалоба успешно отправлена!");
        } else {
            return redirect()->back();
        }
    }

    function complaint($id) {
        $song = $id;
        if($song){
            return view("complaint", [
                "song" => $song,
            ]);
        }

    }

    // public function complaint_index(){
    //     $user_id = Auth::user()->id;
    //     $complaints = Complaint::where("user_id", $user_id)->paginate(3);
    //     $user = DB::table("complaints")->where("user_id", $user_id)->join("songs", "songs.id", "=", "complaints.song_id")->get();
    //     dd($user);
    //     return view("complaints", ["complaints" => $complaints]);
    // }
        
    

}
