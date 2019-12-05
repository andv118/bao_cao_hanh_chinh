<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonViTieuChi extends Model
{
    protected $table = "don_vi_tieu_chi";
    protected $fillable = [
        'id',
        'name',
        'create_at',
        'update_at',
    ];
    public $timestamps = false;

}
