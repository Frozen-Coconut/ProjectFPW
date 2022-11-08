<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    protected $table = "post_comments";
    protected $primary_key = "id";
    protected $increment = true;
    protected $timestamps = true;

    protected $fillable = [
        "user_id",
        "post_id",
        "contents",
        "created_at",
        "updated_at"
    ];
}
