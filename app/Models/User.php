<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = "users";
    protected $primary_key = "id";
    protected $increment = true;
    protected $timestamps = false;

    protected $fillable = [
        "name",
        "email",
        "email_verified_at",
        "password",
        "occupational_status"
    ];

    public function to_dos() {
        return $this->belongsToMany(ToDo::class,'to_do_assign_to','user_id','to_do_id','id','id');
    }

    public function manages() {
        return $this->hasMany(Project::class, 'project_manager_id', 'id');
    }

    public function projects() {
        return $this->belongsToMany(Project::class, 'users_projects', 'user_id', 'project_id', 'id', 'id');
    }

    public function posts() {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function post_comments() {
        return $this->hasMany(PostComment::class, 'user_id', 'id');
    }

    public function to_do_comments() {
        return $this->hasMany(ToDoComment::class, 'user_id', 'id');
    }
}
