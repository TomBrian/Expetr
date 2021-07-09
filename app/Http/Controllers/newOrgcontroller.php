<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\organisations;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class newOrgcontroller extends Controller
{

   public function make(Request $request)
   {
      $request->validate([
         'email' => ['required', 'unique:users,email'],
         'organisation_name' => ['required'],
      ]);
      //generate the company code
      $firstTwoChars = str_split($request->organisation_name);
      $OrgCode = $firstTwoChars[0] . $firstTwoChars[1] . rand(1000, 200000);
      //generate admin id
      $adminTwoChars = str_split($request->name);
      $adminId = $adminTwoChars[0] . $firstTwoChars[1] . rand(1000, 200000);
      //create a media folder for company
      $targetPath = public_path('users');
      $folderName = $OrgCode;
      mkdir($targetPath . '/' . $folderName);
      $mediaPath = $targetPath . '/' . $folderName;
      $mediaUrl = asset('users') . '/' . $folderName;
      //store the admin and organisation in the respective data tables
      organisations::create([
         'name' => $request->organisation_name,
         'organisation_code' => $OrgCode,
         'adminId' => $adminId,
         'media_path' => $mediaPath,
         'media_url' => $mediaUrl
      ]);

      //store admin as user
      User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => Hash::make($request->password),
         'organisation_code' => $OrgCode,
         'approved' =>'1',
         'userId' => $adminId,
         'position'=>'admin',
         'media_path' =>   $mediaPath,
         'media_url' => $mediaUrl
      ]);
      $organisation = organisations::where('organisation_code','=',$OrgCode)->get();
        // get name of 
        $month = date('m');
        $year = date('Y');
        $dateObj   = DateTime::createFromFormat('!m', $month);
        $monthName = $dateObj->format('F'); 
         // make new history
       history::create([
           'month'=>  $monthName,
           'year'=> $year,
           'total_expenses'=> 0,
           'total_rental'=> 0,
           'total_salaries'=> 0,
           'total_medical'=> 0,
           'total_utilities'=> 0,
           'total_food'=> 0,
           'total_insurance'=> 0,
           'total_delivery'=> 0,
           'total_marketing'=> 0,
           'total_gifts'=> 0,
           'total_other'=> 0,
           'organisation_code'=>$OrgCode
                ]);
      $to_email = $request->email;
      Mail::send('pages.mail.orgCode',array('content'=>$OrgCode,'userName'=>$request->name,'organisation_name'=>$organisation[0]->name),function($message) use ($to_email){
          $message -> subject("Your organisation's code");
          $message -> to($to_email);
      });
      return redirect(route('login'))->with('message','An email with the organisation code has been sent to '.$request->email);
   }
   public function index()
   {
      return view('auth.new');
   }
}
