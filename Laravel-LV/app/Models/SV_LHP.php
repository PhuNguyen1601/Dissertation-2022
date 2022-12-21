<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SV_LHP extends Model
{
    use HasFactory;
    protected $table = 'lophocphan_sinhvien';
    protected $fillable = ['lophocphan_id', 'sinhvien_id', 'type'];
    public function sv()
    {
        return $this->belongsTo('App\Models\Sinhvien', 'sinhvien_id', 'id');
    }
    public function lhp()
    {
        return $this->belongsTo('App\Models\Lophocphan', 'lophocphan_id', 'id');
    }
}