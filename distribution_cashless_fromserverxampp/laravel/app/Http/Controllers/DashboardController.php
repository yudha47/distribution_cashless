<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use App\Models\Admission;
use App\Models\Discharge;
use App\Models\Monitoring;
use App\Models\ActionClaim;
use App\Models\InstructionCj;
use App\Models\Status;
use Illuminate\Http\Request;

class DashboardController extends Controller{
  public function test_function(){
    dd(session()->all());
  }

  public function index(){
    $datestart = Carbon::now()->subDays(16);
    $dateend = Carbon::now()->addDays(2);

    $period = new DatePeriod($datestart, new DateInterval('P1D'), $dateend);
    foreach ($period as $date) {
      $dates[] = $date->format("m/d/Y");
    }

    $raw_admission = ActionClaim::select(ActionClaim::raw('DATE_FORMAT(date, "%m/%d/%Y") as date, count(id_action) as count'))
                              ->where('type_action', 'admissions')
                              ->groupBy('date')
                              ->get();

    $raw_monitoring = ActionClaim::select(ActionClaim::raw('DATE_FORMAT(date, "%m/%d/%Y") as date, count(id_action) as count'))
                              ->where('type_action', 'monitoring')
                              ->groupBy('date')
                              ->get();

    $raw_discharge = ActionClaim::select(ActionClaim::raw('DATE_FORMAT(date, "%m/%d/%Y") as date, count(id_action) as count'))
                              ->where('type_action', 'discharge')
                              ->groupBy('date')
                              ->get();

                              
    $admission[]= 0;
    $monitoring[]= 0;
    $discharge[]= 0;
    foreach($dates as $date){
      $same_admission = 0;
      $same_monitoring = 0;
      $same_discharge = 0;

      foreach($raw_admission as $ra){
        if($date == $ra['date']){
          $admission[]= $ra['count'];
          $same_admission = 1;
        }
      }
      
      foreach($raw_monitoring as $ra){
        if($date == $ra['date']){
          $monitoring[]= $ra['count'];
          $same_monitoring = 1;
        }
      }
      
      foreach($raw_discharge as $ra){
        if($date == $ra['date']){
          $discharge[]= $ra['count'];
          $same_discharge = 1;
        }
      }

      if($same_admission == 0){
        $admission[]= 0;
      }

      if($same_monitoring == 0){
        $monitoring[]= 0;
      }

      if($same_discharge == 0){
        $discharge[]= 0;
      }

      $same_admission = 0;
    }

    return view('home', [
                          'title'=> 'Dashboard',
                          'list_date' => $dates,
                          'admission' => $admission,
                          'monitoring' => $monitoring,
                          'discharge' => $discharge
                        ]);
  }

  public function page_404(){
    return view('layouts/page404');
  }

  public function get_notif_all(Request $request){
    $result_analyst = ActionClaim::select('id_action')->where('status', 'Send To Analyst')->count();
    $result_ma = ActionClaim::select('id_action')->where('action_analyst', 'Send To MA')->where('pic_ma', null)->count();
    $result_cj = InstructionCj::select('id_instruction')->where('status', 'Send To CJ')->count();

    $result = array($result_analyst, $result_ma, $result_cj);

    return json_encode(array('result'=>$result));
  }

  public function get_notif_action(Request $request){
    $operator = $request->operator;

    if($operator == 'analyst'){
      $status = 'Send To Analyst';

      $result = ActionClaim::select('type_action')->where('status', $status)->get();
  
      $admissions = $result->where('type_action', 'admissions')->count();
      $monitoring = $result->where('type_action', 'monitoring')->count();
      $discharge = $result->where('type_action', 'discharge')->count();
    }else if($operator == 'ma'){
      $status = 'Send To MA';

      $result = ActionClaim::select('type_action')->where('action_analyst', $status)->where('pic_ma', null)->get();
  
      $admissions = $result->where('type_action', 'admissions')->count();
      $monitoring = $result->where('type_action', 'monitoring')->count();
      $discharge = $result->where('type_action', 'discharge')->count();
    }

    $result = array($admissions, $monitoring, $discharge);
    return json_encode(array('result'=>$result));
  }
}
