<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nienkhoa extends Model
{
    use HasFactory;
    protected $fillable = ['nienkhoa', 'type'];
    protected $table = 'nienkhoa';
    public function kehoach()
    {
        return $this->hasMany('App\Models\Kehoach', 'nkid', 'id');
    }
}