<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class organisations extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'organisation_code',
        'adminId',
        'media_path',
        'media_url'
    ];
    public function history(){
        return $this->hasMany(history::class);
    }
    public function downloads(){
        return $this->hasMany(downloads::class);
    }
}
