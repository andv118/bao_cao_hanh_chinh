<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";
    protected $fillable =[
        'id',
        'base',
        'code',
        'name',
        'password',
        'email',
        'phone',
        'id_hanhchinh',
        'don_vi_quan_ly',
        'role',
        'create_at',
        'update_at',
    ];
    public $timestamps = false;
    
}