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
}
