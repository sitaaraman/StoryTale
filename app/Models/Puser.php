<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puser extends Model
{
    protected $fillable = [
        'fullname',
        'username',
        'email',
        'gender',
        'dateofbirth',
        'phone_number',
        'profile',
        'password',
        'slug',
    ];
}
