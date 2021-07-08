<?php

namespace App\Http\Controllers;

use App\Models\downloads;
use App\Models\organisations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class downloadsController extends Controller
{
    public function index(){
        return downloads::where('organisation_id','=',Auth::user()->organisation_code)->get();
    }
}
