<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = "projects";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "name_project",
        "invitation_code",
        "project_manager_id",
        "status",
        "created_at",
        "updated_at"
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'users_projects', 'project_id', 'user_id', 'id', 'id');
    }

    public function managed() {
        return $this->belongsTo(User::class, 'project_manager_id', 'id');
    }

    public function to_dos() {
        return $this->hasMany(ToDo::class,'project_id','id');
    }

    public function h_trans() {
        return $this->hasMany(HTransaction::class,'project_id','id');
    }

    public function posts() {
        return $this->hasMany(Post::class,'project_id','id');
    }

    public function notifications() {
        return $this->hasMany(Notification::class,'project_id','id');
    }
}
