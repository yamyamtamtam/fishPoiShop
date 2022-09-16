<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'sale',
        'code',
        'category_id',
        'image',
        'description',
        'del_flg'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];
}