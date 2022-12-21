<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hocphan extends Model
{
    use HasFactory;
    protected $fillable = ['mahp', 'tenhp', 'sotc', 'type'];
    protected $table = 'hocphan';
}