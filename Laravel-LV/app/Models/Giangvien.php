<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giangvien extends Model
{
    use HasFactory;
    protected $table = 'giangvien';
    protected $fillable = [
        'magv', 'tengv', 'email', 'password', 'ngaysinh', 'bmid', 'type'
    ];
    public function bomon()
    {
        return $this->belongsTo('App\Models\Bomon', 'bmid', 'id');
    }
}