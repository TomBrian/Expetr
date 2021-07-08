<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'amount',
        'status',
        'author',
        'organisation_code',
        'category'
    ];
}
