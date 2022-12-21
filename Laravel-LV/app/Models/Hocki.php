<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hocki extends Model
{
    use HasFactory;
    protected $fillable = ['hocki', 'type'];
    protected $table = 'hocki';
    public function kehoach()
    {
        return $this->belongsTo('App\Models\Kehoach');
    }
    public function lophocphan()
    {
        return $this->belongsTo('App\Models\Lophocphan');
    }
}