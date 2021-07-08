<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\organisations;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class historyController extends Controller
{
 public function index(){
    $year = date('Y');
    $history = history::where('organisation_code','=',Auth::user()->organisation_code);
     return $history->where('year','=',$year)->get();
 }
 public function currHistory(){
    $month = date('m');
    $year = date('Y');
    $dateObj   = DateTime::createFromFormat('!m', $month);
    $monthName = $dateObj->format('F');
    $model = history::where('organisation_code','=',Auth::user()->organisation_code)->where('month','=',$monthName)->where('year','=',$year);
    $modelValues = $model->get();
    return $modelValues;
 }
 public function updates(Request $request,$orgCode){
    $month = date('m');
    $year = date('Y');
    $dateObj   = DateTime::createFromFormat('!m', $month);
    $monthName = $dateObj->format('F');
    $model = history::where('organisation_code','=',$orgCode)->where('month','=',$monthName)->where('year','=',$year);
    $modelValues = $model->get();
    foreach ($modelValues as $value) {
    $model->update([
        'total_expenses' => $request->expenses,
        'total_rental'  =>  $request->rental,
        'total_salaries' =>  $request->salaries,
        'total_medical' =>  $request->medical,
        'total_utilities' => $request->utilities,
        'total_food' => $request->food,
        'total_insurance' => $request->insurance,
        'total_delivery' => $request->delivery,
        'total_marketing' => $request->marketing,
        'total_food' => $request->food,
        'total_gifts' =>  $request->gifts,
        'total_other' => $request->other,
    ]);
        
        }
 }
}
