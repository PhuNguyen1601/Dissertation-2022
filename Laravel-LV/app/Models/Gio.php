<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gio extends Model
{
    use HasFactory;
    protected $fillable = ['tiet', 'start_time', 'end_time', 'type'];
    protected $table = 'gio';
}