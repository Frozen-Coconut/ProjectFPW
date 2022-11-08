<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;

    protected $table = "to_dos";
    protected $primary_key = "id";
    protected $increment = true;
    protected $timestamps = true;

    protected $fillable = [
        "name",
        "project_id",
        "deadline",
        "tag",
        "created_at",
        "updated_at"
    ];
}
