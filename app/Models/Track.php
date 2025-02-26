<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['id'];
    protected $table = 'tracks';
    public $timestamps = false;
}
