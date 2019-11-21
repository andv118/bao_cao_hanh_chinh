<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $table="user_permission";
    protected $fillable =[
        'id',
        'name',
        'description',
        'level',
        'create_at',
        'update_at',
    ];
    public $timestamps = false;
}
