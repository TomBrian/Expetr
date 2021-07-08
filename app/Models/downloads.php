<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class downloads extends Model
{
    use HasFactory;
    protected $fillable = [
'file_path',
'organisation_id',
'file_url',
'name'
    ];
    public function org(){
       return $this->BelongsTo(organisations::class);
    }
}
