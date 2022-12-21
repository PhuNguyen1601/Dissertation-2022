<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ngaythi extends Model
{
    use HasFactory;
    protected $fillable = [
        'ngaythang', 'ngay_thi', 'type'
    ];
    protected $table = 'ngay';
}