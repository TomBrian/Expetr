<?php

namespace App\Http\Controllers;

use App\Models\organisations;
use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (Auth::check()) {
    if (Auth::user()->approved == '1') {
     $orgName = organisations::where('organisation_code', '=', Auth::user()->organisation_code)->get();
            foreach ($orgName as $name) {
                return view('pages.dashboard', ['organisation' => $name->name]);
            }
    }
    else{  
        $orgName = organisations::where('organisation_code', '=', Auth::user()->organisation_code)->get();
        foreach ($orgName as $name) {
        return view('pages.notApproved',['organisation' => $name->name,'myName'=>Auth::user()->name]);
        }
    }   
        } 
        else{
            return view('pages.home');
        }

    }
    public function welcome()
    {
        if (Auth::check()) {

            return redirect(route('dashboard'));
        } 
        else{
            return view('pages.home');
        }
    }
}
