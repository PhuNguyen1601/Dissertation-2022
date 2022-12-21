<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bomon extends Model
{
    use HasFactory;
    protected $fillable = ['mabm', 'tenbm', 'type'];
    protected $table = 'bomon';
}