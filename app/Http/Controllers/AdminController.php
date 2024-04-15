<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Genre;
use App\Models\Song;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //

    public function index() {

        $complaints = Complaint::join('songs', 'song_id', '=', 'songs.id')->join('users', 'user_id', '=', 'users.id')->join('statuses', 'status_id', '=', 'statuses.id')->orderBy('complaints.status_id', "asc")->paginate(3);
        return  view("admin.admin", ["complaints" => $complaints, "genres" => Genre::all(),]);
    }

    public function admin_signin() {

        return Auth::user()->role === 1 ? redirect("/admin_index")  : redirect("/");

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
            return redirect()->back()->with('success_add', "Жанр добавлен");
        } else {
            return redirect()->back();
        }

    }

    public function complaint_accept($id) {
        $status = Complaint::where('complaint_id', $id);
        $user = Complaint::where('complaint_id', $id)->first();
        $user_info = User::where('id', $user->user_id)->first();
        $status->update([
            'status_id' => 2,
        ]);
        Mail::raw('Ваша жалоба была принята администратором', fn ($mail) => $mail->to($user_info->email));
        return redirect('/admin_index');
    }

    
    public function complaint_decline($id) {
        $status = Complaint::where('complaint_id', $id);
        $user = Complaint::where('complaint_id', $id)->first();
        $user_info = User::where('id', $user->user_id)->first();
        $status->update([
            'status_id' => 3,
        ]);
        Mail::raw('Ваша жалоба была отклонена администратором', fn ($mail) => $mail->to($user_info->email));
        return redirect('/admin_index');
    }
}
