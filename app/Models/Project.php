<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = "projects";
    protected $primary_key = "id";
    protected $increment = true;
    protected $timestamps = true;

    protected $fillable = [
        "name_project",
        "invitation_code",
        "project_manager_id",
        "status",
        "created_at",
        "updated_at"
    ];
}
