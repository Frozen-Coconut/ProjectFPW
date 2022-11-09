<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoComment extends Model
{
    use HasFactory;

    protected $table = "to_do_comments";
    protected $primary_key = "id";
    protected $increment = true;
    protected $timestamps = true;

    protected $fillable = [
        "user_id",
        "to_do_id",
        "contents",
        "created_at",
        "updated_at"
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function to_do() {
        return $this->belongsTo(ToDo::class, 'to_do_id', 'id');
    }
}

