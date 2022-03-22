<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\Status;
use App\Models\Discharge;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use App\Models\Admission as ModelsAdmission;

class ActionSummaryController extends Controller{
  public function test_function(Request $request){
    echo "page action summmary";
  }

  public function index(Request $request){
    $client = Client::all();
    $user = User::all();
    $status = Status::all();

    $datestart = '';
    $dateend = '';
    if($request->session()->has('datestart_admission')){
      $datestart = $request->session()->get('datestart_admission');
      $dateend = $request->session()->get('dateend_admission');
    }else{
      $datestart = Carbon::now()->subDays(2)->format('Y-m-d');
      $dateend = Carbon::now()->format('Y-m-d');
    }

    $result = ModelsAdmission::Join('clients', 'clients.id_client', '=', 'admissions.client_id')
                              ->select('*')
                              ->whereBetween('date_start', [$datestart, $dateend])
                              ->orderBy('id_admission', 'ASC')
                              ->get();

    $result = Monitoring::Join('clients', 'clients.id_client', '=', 'monitoring.client_id')
                              ->select('*')
                              ->whereBetween('date_start', [$datestart, $dateend])
                              ->orderBy('id_monitoring', 'ASC')
                              ->get();

    $result = Discharge::Join('clients', 'clients.id_client', '=', 'discharge.client_id')
                              ->select('*')
                              ->whereBetween('date_start', [$datestart, $dateend])
                              ->orderBy('id_discharge', 'ASC')
                              ->get();

    $all_admission = $result->count();
    $send2analyst = $result->where('status_admission', 'Send To Analyst')->count();
    $pending = $result->where('action_analyst', 'Pending Jaminan Awal')->count();
    
    return view('action_summary', ['title'=>'Action Summary', 
                                  'data'=>$result, 
                                  'client'=>$client, 
                                  'user'=>$user, 
                                  'status'=>$status,
                                  'all_add'=>$all_admission,
                                  'send2analyst'=>$send2analyst,
                                  'pending'=>$pending
                                ]);
  }
}
