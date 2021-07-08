<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
        'year',
        'total_expenses',
        'total_rental',
        'total_salaries',
        'total_medical',
        'total_utilities',
        'total_food',
        'total_insurance',
        'total_delivery',
        'total_marketing',
        'total_gifts',
        'total_other',
        'organisation_code'
    ];
    public function organisation(){
      return $this->belongsTo(organisations::class);
    }
}
