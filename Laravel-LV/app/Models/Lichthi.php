<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lichthi extends Model
{
    use HasFactory;
    protected $fillable = ['ngayid', 'gioid', 'phongid', 'lhpid', 'type', 'videodec', 'video', 'tuan'];
    protected $table = 'lichthi';

    public function ngaythi()
    {
        return $this->belongsTo(Ngaythi::class, 'ngayid', 'id');
    }
    public function gio()
    {
        return $this->belongsTo(Gio::class, 'gioid', 'id');
    }
    public function phong()
    {
        return $this->belongsTo(Phong::class, 'phongid', 'id');
    }

    public function lophocphan()
    {
        return $this->belongsTo(Lophocphan::class, 'lhpid', 'id');
    }
}