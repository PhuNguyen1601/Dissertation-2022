<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lophocphan extends Model
{
    use HasFactory;
    protected $fillable = [
        'hkid', 'nkid', 'hpid', 'gvid',
        'malhp', 'type', 'tgthi'
    ];
    protected $table = 'lophocphan';
    public function nienkhoa()
    {
        return $this->belongsTo('App\Models\Nienkhoa', 'nkid', 'id');
    }
    public function hocki()
    {
        return $this->belongsTo('App\Models\Hocki', 'hkid', 'id');
    }
    public function giangvien()
    {
        return $this->belongsTo('App\Models\Giangvien', 'gvid', 'id');
    }
    public function hocphan()
    {
        return $this->belongsTo('App\Models\Hocphan', 'hpid', 'id');
    }
    public function lichthi()
    {
        return $this->belongsTo('App\Models\Lichthi', 'id', 'lhpid');
    }
    public function sv()
    {
        return $this->belongsToMany(Sinhvien::class);
    }
}