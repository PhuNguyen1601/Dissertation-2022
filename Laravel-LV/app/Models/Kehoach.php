<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehoach extends Model
{
    use HasFactory;

    protected $fillable = ['tieude', 'ngaybd_dk', 'ngaykt_dk', 'ngaybd_thi', 'ngaykt_thi', 'nkid', 'hkid', 'type'];
    protected $table = 'kehoach';
    public function nienkhoa()
    {
        return $this->belongsTo('App\Models\Nienkhoa', 'nkid', 'id');
    }
    public function hocki()
    {
        return $this->belongsTo('App\Models\Hocki', 'hkid', 'id');
    }
}