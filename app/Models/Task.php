<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'element',
        'color',
        'description',
        'rarity',
    ];
}
