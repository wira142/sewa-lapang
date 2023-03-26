<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory, HasFactory;
    protected $fillable = [
        'title',
        'image',
        'desc',
        'disc',
        'min_time',
        'status',
        'price',
        'map_link',
    ];

    public function getFields()
    {
        return Field::get();
    }
    public function create($request)
    {
        return "input field";
    }
}
