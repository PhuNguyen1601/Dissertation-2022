<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    use HasFactory;
    protected $fillable = ['map', 'succhua', 'type'];
    protected $table = 'phong';
    public function videothi()
    {
        return $this->hasMany('App\Models\Videothi', 'phongid', 'id');
    }

    public function lichthi()
    {
        return $this->hasMany('App\Models\Lichthi', 'phongid', 'id');
    }
}