<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ActionClaim;
use Illuminate\Http\Request;

class WallboardController extends Controller
{
  public function index(Request $request, $mode = null){
    $datestart = '';
    $dateend = '';
    if($request->session()->has('datestart_wallboard')){
      $datestart = $request->session()->get('datestart_wallboard');
      $dateend = $request->session()->get('dateend_wallboard');
    }else{
      $datestart = Carbon::now()->format('Y-m-d');
      $dateend = Carbon::now()->format('Y-m-d');
    }
    
    $admission = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                              ->select('*')
                              ->where('type_action', 'admissions')
                              ->whereBetween('date', [$datestart, $dateend])
                              ->orderBy('member_name', 'ASC')
                              ->get();

    $monitoring = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                              ->select('*')
                              ->where('type_action', 'monitoring')
                              ->whereBetween('date', [$datestart, $dateend])
                              ->orderBy('member_name', 'ASC')
                              ->get();

    $discharge = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                              ->select('*')
                              ->where('type_action', 'discharge')
                              ->whereBetween('date', [$datestart, $dateend])
                              ->orderBy('member_name', 'ASC')
                              ->get();

    $admission_all = $admission->count();
    $admission_send2analyst = $admission->where('status', 'Send To Analyst')->count();
    $admission_process = $admission->where('status', 'Analyst Process')->where('pic_ma', null)->count();
    $monitoring_all = $monitoring->count();
    $monitoring_send2analyst = $monitoring->where('status', 'Send To Analyst')->count();
    $monitoring_rcvbyanalyst = $monitoring->where('status', 'RCV By Analyst')->count();
    $discharge_all = $discharge->count();
    $discharge_send2analyst = $discharge->where('status', 'Send To Analyst')->count();
    $discharge_rcvbyanalyst = $discharge->where('status', 'RCV By Analyst')->count();
    
    return view('wallboard', [
                              'title' => 'wallboard',
                              'mode' => $mode,
                              'admission' => $admission,
                              'monitoring' => $monitoring,
                              'discharge' => $discharge,
                              'admission_all' => $admission_all,
                              'admission_send2analyst' => $admission_send2analyst,
                              'admission_process' => $admission_process,
                              'monitoring_all' => $monitoring_all,
                              'monitoring_send2analyst' => $monitoring_send2analyst,
                              'monitoring_rcvbyanalyst' => $monitoring_rcvbyanalyst,
                              'discharge_all' => $discharge_all,
                              'discharge_send2analyst' => $discharge_send2analyst,
                              'discharge_rcvbyanalyst' => $discharge_rcvbyanalyst,
                              ]);
  }

  public function wallboard_daterange(Request $request){
    $request->session()->put('datestart_wallboard', "$request->date_start");
    $request->session()->put('dateend_wallboard', "$request->date_end");
    
    $datestart = $request->date_start;
    $dateend = $request->date_end;
    
    // $admission = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
    //                           ->select('*')
    //                           ->where('type_action', 'admissions')
    //                           ->whereBetween('date', [$datestart, $dateend])
    //                           ->orderBy('member_name', 'ASC')
    //                           ->get();

    // $monitoring = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
    //                           ->select('*')
    //                           ->where('type_action', 'monitoring')
    //                           ->whereBetween('date', [$datestart, $dateend])
    //                           ->orderBy('member_name', 'ASC')
    //                           ->get();

    // $discharge = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
    //                           ->select('*')
    //                           ->where('type_action', 'discharge')
    //                           ->whereBetween('date', [$datestart, $dateend])
    //                           ->orderBy('member_name', 'ASC')
    //                           ->get();
    
    $admission = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                              ->select('*')
                              ->where('type_action', 'admissions')
                              ->whereBetween('date', [$datestart, $dateend])
                              ->orderBy('member_name', 'ASC')
                              ->get();

    $monitoring = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                              ->select('*')
                              ->where('type_action', 'monitoring')
                              ->whereBetween('date', [$datestart, $dateend])
                              ->orderBy('member_name', 'ASC')
                              ->get();

    $discharge = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                              ->select('*')
                              ->where('type_action', 'discharge')
                              ->whereBetween('date', [$datestart, $dateend])
                              ->orderBy('member_name', 'ASC')
                              ->get();

    $admission_all = $admission->count();
    $admission_send2analyst = $admission->where('status', 'Send To Analyst')->count();
    $admission_process = $admission->where('status', 'Analyst Process')->count();
    $monitoring_all = $monitoring->count();
    $monitoring_send2analyst = $monitoring->where('status', 'Send To Analyst')->count();
    $monitoring_process = $monitoring->where('status', 'Analyst Process')->count();
    $discharge_all = $discharge->count();
    $discharge_send2analyst = $discharge->where('status', 'Send To Analyst')->count();
    $discharge_process = $discharge->where('status', 'Analyst Process')->count();

    return view('data_wallboard', [
                                  'title' => 'wallboard',
                                  'admission' => $admission,
                                  'monitoring' => $monitoring,
                                  'discharge' => $discharge,
                                  'admission_all' => $admission_all,
                                  'admission_send2analyst' => $admission_send2analyst,
                                  'admission_process' => $admission_process,
                                  'monitoring_all' => $monitoring_all,
                                  'monitoring_send2analyst' => $monitoring_send2analyst,
                                  'monitoring_process' => $monitoring_process,
                                  'discharge_all' => $discharge_all,
                                  'discharge_send2analyst' => $discharge_send2analyst,
                                  'discharge_process' => $discharge_process,
                                  ]);
  }

  public function reload_action(Request $request){
    $type_action = $request->type_action;
    $datestart = $request->date_start;
    $dateend = $request->date_end;
    
    $action = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                          ->select('member_name', 'fullname', 'time_distribution', 'status')
                          ->where('type_action', $type_action)
                          ->where('status', '!=', 'RCV By Analyst')
                          // ->whereBetween('date', [$datestart, $dateend])
                          ->orderBy('member_name', 'ASC')
                          ->get();

    // $sql = "SELECT * FROM `action_claim` WHERE `status` != CASE WHEN date < curdate() THEN 'RCV By Analyst' WHEN date = curdate() THEN 'all' END LIMIT 5";
    
    // $action3 = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                          // ->select('member_name', 'fullname', 'time_distribution', 'status', 
                          // DB::raw("WHERE `status` != CASE WHEN date < curdate() THEN 'RCV By Analyst' WHEN date = curdate() THEN 'all'")
                          // )
                          // // ->where('type_action', $type_action)
                          // // ->whereBetween('date', [$datestart, $dateend])
                          // // ->orderBy('member_name', 'ASC')
                          // ->get();

    // $action = DB::select('SELECT * from action_claim');
    // dd($action);
    // exit();

    // $query = DB::table('action_claim')
    // ->when('date', function ($q){
    //     return $q->where('status', 1);
    // })
    // ->when($year, function($q) use ($year) {
    //     return $q->where('year', '>', $year);
    // })
    // ->get();

    // $action2 = DB::select("SELECT * FROM action_claim WHERE `status` != CASE WHEN date < curdate() THEN 'RCV By Analyst' WHEN date = curdate() THEN 'all' END LIMIT 5");

    return view('data_wallboard_action', ['action' => $action]);
  }

  public function reload_count(Request $request){
    $type_action = $request->type_action;
    $datestart = $request->date_start;
    $dateend = $request->date_end;
    
    $action = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                          ->select('member_name', 'fullname', 'time_distribution', 'status')
                          ->where('type_action', $type_action)
                          ->where('status', '!=', 'RCV By Analyst')
                          // ->whereBetween('date', [$datestart, $dateend])
                          ->orderBy('member_name', 'ASC')
                          ->get();

    $count_all = $action->count();
    // :D
    $count_send = $action->where('status', 'Send To Analyst')->count();
    $count_process = $action->where('status', 'Analyst Process')->count();

    $data = array($count_all, $count_send, $count_process);

    return json_encode(array('data'=>$data));
  }
}