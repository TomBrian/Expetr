<?php

namespace App\Console\Commands;

use App\Models\downloads;
use App\Models\expenses;
use App\Models\history;
use App\Models\organisations;
use App\Models\User;
use App\Notifications\jobDone;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;

class historyJobs extends Command
{
    use Notifiable;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:monthlyCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this saves data from the previous month in form of pdf and stores totals in the history database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){
    // get all organisations
    $allOrgs = organisations::all();
    // group each of them
        foreach ($allOrgs as $org) {
          $orgCode =  $org->organisation_code;
         $expenses = expenses::where('organisation_code','=', $orgCode)->get();
         $approvedExp = expenses::where('organisation_code','=', $orgCode)->where('status','=','approved')->get();
        //  get total of approved expenses
        $totalExp = 0;

        for ($i=0; $i < count($approvedExp); $i++) { 
            // get the total
            $amount = $approvedExp[$i]->amount;
            $totalExp += $amount;
        }
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
            'organisation_code'=>$orgCode
                 ]);
            echo  $monthName;
            // save the files
            $pdf = PDF::loadView('pages.exPdf', ['expenses'=>$expenses,'organisation'=>$org]);
        $paper = $pdf->setPaper('a4', 'landscape');
        $save = $pdf->save(public_path('users').'/'.$orgCode.'/'.$monthName.'_'.date('Y').'_expenses'.'.pdf');
        //   refresh the expenses table
        expenses::where('organisation_code','=', $orgCode)->delete();
    // users to notify
         $users = User::where('organisation_code','=', $orgCode)->get();
        Notification::send($users, new jobDone($monthName));
        }
    // attach data about the saved files
       downloads::create([
           'organisation_id' => $orgCode,
           'file_path' => public_path('users').'/'.$orgCode.'/'.$monthName.'_'.date('Y').'_expenses'.'.pdf',
           'file_url' => asset('users').'/'.$orgCode.'/'.$monthName.'_'.date('Y').'_expenses'.'.pdf',
           'name' => $monthName." ".$year."'s expenses"
       ]);
    }
}
//php artisan command:monthlyCommand