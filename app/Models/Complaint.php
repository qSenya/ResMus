<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'comment',
        'user_id',
        'song_id',
        'status_id',
        'updated_at'
    ];


    public function song()
    {
    return $this->belongsTo(Song::class, 'song_id', 'id');
    }
}
