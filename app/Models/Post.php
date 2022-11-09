<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";
    protected $primary_key = "id";
    protected $increment = true;
    protected $timestamps = true;

    protected $fillable = [
        "user_id",
        "project_id",
        "contents",
        "created_at",
        "updated_at"
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function post_comments() {
        return $this->hasMany(PostComment::class, 'post_id', 'id');
    }
}
