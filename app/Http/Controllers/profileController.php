<?php

namespace App\Http\Controllers;

use App\Models\organisations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class profileController extends Controller
{
    public function orgDetails()
    {
        $id = Auth::user()->organisation_code;
        $organisation = organisations::where('organisation_code', '=', $id)->get();
        return $organisation[0];
    }
}
