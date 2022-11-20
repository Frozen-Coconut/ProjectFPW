<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;

    protected $table = "to_dos";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "name",
        "project_id",
        "deadline",
        "tag",
        "created_at",
        "updated_at"
    ];

    public function project() {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function to_do_comments() {
        return $this->hasMany(ToDoComment::class, 'to_do_id', 'id');
    }

    public function users() {
        return $this->belongsToMany(User::class,'to_do_assign_to','to_do_id','user_id','id','id')->withPivot('weights', 'status');
    }
}
