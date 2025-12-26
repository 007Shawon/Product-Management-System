<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'api_id',
        'title',
        'price',
        'description',
        'category',
        'image_url',
        'rating_rate',
        'rating_count',
    ];
}
