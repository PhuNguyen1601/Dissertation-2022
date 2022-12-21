<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinhvien extends Model
{
    use HasFactory;
    protected $table = 'sinhvien';
    protected $fillable = ['masv', 'tensv', 'type'];
    public function lhp()
    {

        return $this->belongsToMany(Lophocphan::class);
    }
}