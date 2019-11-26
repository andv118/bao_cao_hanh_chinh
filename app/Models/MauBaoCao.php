<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MauBaoCao extends Model
{
    protected $table = "mau_bao_cao";
    protected $fillable =[
        'id',
        'type',
        'level',
        'code',
        'name_phuluc',
        'name_baocao',
        'name_ghichu',
        'quarter_year',
        'year',
        'create_at',
        'update_at',
    ];
    public $timestamps = false;
}