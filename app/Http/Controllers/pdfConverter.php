<?php

namespace App\Http\Controllers;

use App\Models\expenses;
use App\Models\organisations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class pdfConverter extends Controller
{
    public function index(){
        $organisations = organisations::where('organisation_code','=',Auth::user()->organisation_code)->get();
        $expenses = expenses::where('organisation_code','=',Auth::user()->organisation_code)->get();
        foreach ($organisations as $organisation) {
      
        $pdf = PDF::loadView('pages.exPdf', ['expenses'=>$expenses,'organisation'=>$organisation]);
      return $pdf->setPaper('a4', 'landscape')->stream(); 
        }
    }
    public function download(){
      $organisation = organisations::where('organisation_code','=',Auth::user()->organisation_code)->get();
      $expenses = expenses::where('organisation_code','=',Auth::user()->organisation_code)->get();
      $pdf = PDF::loadView('pages.exPdf', ['expenses'=>$expenses,'organisation'=>$organisation[0]]);
    return $pdf->setPaper('a4', 'landscape')->download($organisation[0]->name.'_expenses_'.Date('y_m_d').'.pdf');
    }
}
