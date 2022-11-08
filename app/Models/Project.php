<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_project';

    public $timestamps = false;

    protected $fillable = [
        'name_project',
        'invitation_code',
        'status'
    ];
}
