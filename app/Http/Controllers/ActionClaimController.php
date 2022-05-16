<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\Status;
use App\Models\ActionClaim;
use Illuminate\Http\Request;
use App\Models\InstructionCj;
use App\Models\CategoryAction;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class ActionClaimController extends Controller{
  private $dt_now;
  
  public function __construct(Request $request){
    if($request->segment(2) != ''){
      if($request->type_action == null){
        $type_action = $request->segment(3);
        if(self::check_type($type_action) == 0){
          return redirect('/pagenotfound')->send();
        }else{

        }
      }else{
        $type_action = $request->type_action;
        if(self::check_type($type_action) == 0){
          return redirect('/pagenotfound')->send();
        }
      }
    }

    $this->dt_now = date('Y-m-d H:i:s');
  }

  public function check_type($type_action){
    if($type_action == 'admissions' || $type_action == 'monitoring' || $type_action == 'discharge'|| $type_action == 'analyst'){
      return '1';
    }else{
      return '0';
    }
  }

  public function sess_date(Request $request){
    $type_action = $request->type_action;
    $datestart = '';
    $dateend = '';
    
    if($type_action == 'admissions'){
      if($request->session()->has('datestart_admissions')){
        $datestart = $request->session()->get('datestart_admissions');
        $dateend = $request->session()->get('dateend_admissions');
      }else{
        $datestart = Carbon::now()->subDays(1)->format('Y-m-d');
        $dateend = Carbon::now()->format('Y-m-d');
      }
    }else if($type_action == 'monitoring'){
      if($request->session()->has('datestart_monitoring')){
        $datestart = $request->session()->get('datestart_monitoring');
        $dateend = $request->session()->get('dateend_monitoring');
      }else{
        $datestart = Carbon::now()->subDays(1)->format('Y-m-d');
        $dateend = Carbon::now()->format('Y-m-d');
      }
    }else if($type_action == 'discharge'){
      if($request->session()->has('datestart_discharge')){
        $datestart = $request->session()->get('datestart_discharge');
        $dateend = $request->session()->get('dateend_discharge');
      }else{
        $datestart = Carbon::now()->subDays(1)->format('Y-m-d');
        $dateend = Carbon::now()->format('Y-m-d');
      }
    }

    return array($datestart, $dateend);
  }

  public function data_action(Request $request){
    $type_action = $request->type_action;
    $sess_date = self::sess_date($request);
    $datestart = $sess_date[0];
    $dateend = $sess_date[1];
    
    if($request->session()->has('status_sess')){
      if($request->session()->get('status_sess') != 'all'){
        if($request->session()->get('status_sess') == 'open'){
          $filter = '!=';
        }elseif($request->session()->get('status_sess') == 'close'){
          $filter = '=';
        }
      
        $result = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                              ->select('*')
                              ->where('type_action', $type_action)
                              ->whereBetween('date', [$datestart, $dateend])
                              ->where('status', $filter, 'RCV By Analyst')
                              ->orderBy('id_action', 'ASC')
                              ->get();
      }else{
        $result = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                              ->select('*')
                              ->where('type_action', $type_action)
                              ->whereBetween('date', [$datestart, $dateend])
                              ->orderBy('id_action', 'ASC')
                              ->get();
      }
    }else{
      $result = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
      ->select('*')
      ->where('type_action', $type_action)
      ->whereBetween('date', [$datestart, $dateend])
      ->orderBy('id_action', 'ASC')
      ->get();
    }

    return $result;
  }

  public function index(Request $request){
    echo "data session"."</br>";
    echo dd(Session::all());
    exit();
  }
  
  public function action_type(Request $request, $type_action, $mode = null, $operator = null){
    $client = Client::all();
    $user = User::all();
    $status = Status::all();
    $request->request->add(['type_action' => $type_action]);
    $category_action = CategoryAction::Join('action_types', 'action_types.id_types', '=', 'category_actions.action_type')
                                  ->select('*')
                                  ->where('action_name', $type_action)
                                  ->get();

    $result = self::data_action($request);
    if($mode == null){
      $all_action = $result->count();
      $status1 = $result->where('status', 'Send To Analyst')->count();
      $status2 = $result->where('action_analyst', 'Send To MA')->count();
      
      return view('action_claim', [
                                    'title'=> $type_action, 
                                    'client'=>$client, 
                                    'user'=>$user, 
                                    'status'=>$status,
                                    'all_act'=>$all_action,
                                    'status1'=>$status1,
                                    'status2'=>$status2,
                                    'category_action'=>$category_action
                                  ]);
    }else if($mode == 'filter_notif'){
      $notif_status = '';
      if($operator == 'analyst'){
        $notif_status = 'Send To Analyst';
      }else if($operator == 'ma'){
        $notif_status = 'Send To MA';
      }

      $result_notif = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                                ->select('*')
                                ->where('type_action', $type_action)
                                ->where('status', $notif_status)
                                ->orderBy('id_action', 'ASC')
                                ->get();

      $all_action = $result->count();
      $status1 = $result->where('status', 'Send To Analyst')->count();
      $status2 = $result->where('action_analyst', 'Send To MA')->count();
      
      return view('action_claim', [
                                    'title'=> $type_action, 
                                    'client'=> $client, 
                                    'user'=> $user, 
                                    'status'=> $status,
                                    'all_act'=> $all_action,
                                    'status1'=> $status1,
                                    'status2'=> $status2,
                                    'category_action'=> $category_action,
                                    'data_notif' => '3',
                                    'notif_status' => $notif_status
                                  ]);
    }
  }

  public function action_daterange(Request $request){
    $type_action = $request->type_action;
    if($type_action == 'admissions'){
      $request->session()->put('datestart_admissions', "$request->date_start");
      $request->session()->put('dateend_admissions', "$request->date_end");
    }else if($type_action == 'monitoring'){
      $request->session()->put('datestart_monitoring', "$request->date_start");
      $request->session()->put('dateend_monitoring', "$request->date_end");
    }else if($type_action == 'discharge'){
      $request->session()->put('datestart_discharge', "$request->date_start");
      $request->session()->put('dateend_discharge', "$request->date_end");
    }

    $result = self::data_action($request);

    $last_action = 0;
    return view('data_action', [
                                'title'=> $type_action, 
                                'data'=>$result, 
                                'last_action' => $last_action
                                ]
                              );
  }

  public function refresh_action(Request $request){
    if($request->status_sess != 'notset'){
      if($request->status_sess != null){
        $request->session()->put('status_sess', "$request->status_sess");
      }
    }

    $type_action = $request->type_action;
    $result = self::data_action($request);

    $last_action = 0;
    return view('data_action', [
                                'title'=> $type_action, 
                                'data'=>$result, 
                                'last_action' => $last_action
                              ]);
  }

  public function refresh_ft(Request $request){
    $sess_date = self::sess_date($request);
    $datestart = $sess_date[0];
    $dateend = $sess_date[1];

    $html = Carbon::parse($datestart)->format('F j, Y')." - ".Carbon::parse($dateend)->format('F j, Y');
    echo $html;
  }

  public function refresh_status(Request $request){
    $result = self::data_action($request);

    $all_action = $result->count();
    $status1 = $result->where('status', 'Send To Analyst')->count();
    $status2 = $result->where('action_analyst', 'Send To MA')->whereNull('pic_ma')->count();

    return view('summary_status_action', [
                                          'all_act'=>$all_action,
                                          'status1'=>$status1,
                                          'status2'=>$status2
                                          ]);
  }

  public function filter_status(Request $request){    
    $type_action = $request->type_action;
    $mode = $request->mode;
    $status = $request->status;

    $sess_date = self::sess_date($request);
    $datestart = $sess_date[0];
    $dateend = $sess_date[1];
    
    if($mode == 1){
      if($status == 'Send To Analyst'){
        $result = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                                  ->select('*')
                                  ->where('type_action', $type_action)
                                  ->whereBetween('date', [$datestart, $dateend])
                                  ->where('status', $status)
                                  ->orderBy('id_action', 'ASC')
                                  ->get();
      }else if($status == 'Send To MA'){
        $result = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                                  ->select('*')
                                  ->where('type_action', $type_action)
                                  ->whereBetween('date', [$datestart, $dateend])
                                  ->where('action_analyst', $status)
                                  ->where('pic_ma', null)
                                  ->orderBy('id_action', 'ASC')
                                  ->get();
      }else{
        $result = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                                  ->select('*')
                                  ->where('type_action', $type_action)
                                  ->whereBetween('date', [$datestart, $dateend])
                                  ->orderBy('id_action', 'ASC')
                                  ->get();
      }
    }else if($mode == 2){
      if($status == 'All'){
        $result = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                                  ->select('*')
                                  ->where('type_action', $type_action)
                                  ->whereBetween('date', [$datestart, $dateend])
                                  ->orderBy('id_action', 'ASC')
                                  ->get();
      }else{
        $result = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                                  ->select('*')
                                  ->where('type_action', $type_action)
                                  ->where('status', $status)
                                  ->whereBetween('date', [$datestart, $dateend])
                                  ->orderBy('id_action', 'ASC')
                                  ->get();
      }
    }else if($mode == 3){
      if($status == 'Send To Analyst'){
        $result = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                                  ->select('*')
                                  ->where('type_action', $type_action)
                                  ->where('status', $status)
                                  ->orderBy('id_action', 'ASC')
                                  ->get();
      }else if($status == 'Send To MA'){
        $result = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                                  ->select('*')
                                  ->where('type_action', $type_action)
                                  ->where('action_analyst', $status)
                                  ->where('pic_ma', null)
                                  ->orderBy('id_action', 'ASC')
                                  ->get();
      }
    }

    $last_action = 0;
    return view('data_action', [
                                'title'=> $type_action, 
                                'data'=>$result, 
                                'last_action' => $last_action
                              ]);
  }

  public function input_data(Request $request){
    $date = date_format(date_create($request->date_start), "y-m-d");
    $type_action = $request->type_action;

    ActionClaim::create([
                        'date' => $date,
                        'type_action' => $request->type_action,
                        'category' => $request->category,
                        'member_name' => $request->member_name,
                        'client_id' => $request->client_id,
                        'time_distribution' => $this->dt_now,
                        'time_receive' => $request->time_receive,
                        'remarks_info' => $request->remarks_info,
                        'no_claim' => $request->no_claim,
                        'pic_id' => $request->pic_id,
                        'status' => $request->status
                      ]);

    $result = self::data_action($request);

    $last_action = ActionClaim::where('member_name', $request->member_name)
                                      ->where('type_action', $type_action)
                                      ->where('time_distribution', $this->dt_now)
                                      ->first();

    return view('data_action', [
                                'title'=> $type_action, 
                                'data'=>$result, 
                                'last_action' => $last_action
                              ]);
  }

  public function check_process(Request $request){
    $id_action = $request->id_action;

    $check_action = ActionClaim::where('id_action', $id_action)
                                ->where('pic_analyst', null)
                                ->get();

    return $check_action->count();
  }

  public function set_to_process(Request $request){
    $pic = $request->session()->get('username');
    $id_action = $request->id_action;
    $mode = $request->mode;
    $type_action = $request->type_action;

    if($mode == 1){
      ActionClaim::where("id_action", $id_action)
                      ->update([
                                'status' => 'Analyst Process',
                                'pic_analyst' => $pic,
                                'time_process' => $this->dt_now
                              ]);
    }else{
      ActionClaim::where("id_action", $id_action)
                      ->update([
                                'status' => 'RCV By Analyst',
                                'finish_time' => $this->dt_now
                              ]);
    }

    $result = self::data_action($request);
    $last_action = ActionClaim::where('id_action', $id_action)
                              ->first();

    return view('data_action', [
                                'title'=> $type_action, 
                                'data'=>$result, 
                                'last_action' => $last_action
                                ]
                              );
  }

  public function get_action(Request $request){
    $id = $request->id_action;
    $data = ActionClaim::where("id_action", $id)->first();

    return json_encode(array('data'=>$data));
  }

  public function get_action_detail(Request $request){
    $id = $request->id_action;
    $data = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                        ->where("id_action", $id)
                        ->first();

    return json_encode(array('data'=>$data));
  }

  public function update_action(Request $request){
    $id_action = $request->id_action;
    $operator = $request->operator;
    $type_action = $request->type_action;

    if($operator == 'cj'){
      ActionClaim::where("id_action", $id_action)
                      ->update([
                                'member_name' => $request->member_name,
                                'client_id' => $request->client_id,
                                'time_receive' => $request->time_receive,
                                'remarks_info' => $request->remarks_info,
                                'no_claim' => $request->no_claim,
                              ]);
    }else{
      if($request->send_instruction == 1){
        $date = date_format(date_create($this->dt_now), "y-m-d");
        $member_name = '';
        $client_id = '';
        $no_claim = '';

        $getdata_action = ActionClaim::select('member_name', 'client_id', 'no_claim')
                              ->where('id_action', $id_action)
                              ->get();

        foreach($getdata_action as $data){
          $member_name = $data['member_name'];
          $client_id = $data['client_id'];
          $no_claim = $data['no_claim'];
        }

        InstructionCj::create([
          'date' => $date,
          'category' => $type_action,
          'member_name' => $member_name,
          'client_id' => $client_id,
          'time_distribution' => $this->dt_now,
          'remarks_info' => $request->remarks_to_cj,
          'no_claim' => $no_claim,
          'pic_id' => $request->picanalyst,
          'status' => 'Send To CJ'
        ]);
      }

      if($request->mode == 'process'){
        if($request->status == 'Analyst Process'){
          ActionClaim::where("id_action", $id_action)
                          ->update([
                                    'pic_analyst' => $request->picanalyst,
                                    'action_analyst' => $request->actionanalyst,
                                    'remarks_analyst' => $request->actionremarks,
                                    'time_action_analyst' => $this->dt_now,
                                    'status' => $request->status
                                  ]);
        }else{
          ActionClaim::where("id_action", $id_action)
                          ->update([
                                    'pic_ma' => $request->picma,
                                    'remarks_ma' => $request->remakrsma,
                                    'time_action_ma' => $this->dt_now,
                                    'status' => $request->status
                                  ]);
        }
      }else{
        ActionClaim::where("id_action", $id_action)
                          ->update([
                                    'pic_analyst' => $request->picanalyst,
                                    'finish_time' => $this->dt_now,
                                    'action_analyst' => $request->actionanalyst,
                                    'remarks_analyst' => $request->actionremarks,
                                    'pic_ma' => $request->picma,
                                    'remarks_ma' => $request->remakrsma,
                                    'status' => $request->status
                                  ]);
      }
    }

    $result = self::data_action($request);

    $last_action = 0;
    return view('data_action', [
                                'title'=> $type_action, 
                                'data'=>$result, 
                                'last_action' => $last_action
                              ]);
  }

  public function delete_action(Request $request){
    $id = $request->id_action;
    $type_action = $request->type_action;

    ActionClaim::where("id_action", $id)->delete();

    $result = self::data_action($request);

    $last_action = 0;
    return view('data_action', [
                                'title'=> $type_action, 
                                'data'=>$result, 
                                'last_action' => $last_action
                              ]);
  }

  public function search_action(Request $request){    
    $value = $request->value;
    $type_action = $request->type_action;
    
    $result = ActionClaim::Join('clients', 'clients.id_client', '=', 'action_claim.client_id')
                                ->select('*')
                                ->where('member_name', 'LIKE', "%{$value}%") 
                                ->orwhere('no_claim', 'LIKE', "%{$value}%") 
                                ->orderBy('id_action', 'ASC')
                                ->get();

    $last_action = 0;
    return view('data_action', [
                                'title'=> $type_action, 
                                'data'=>$result->where('type_action', $type_action), 
                                'last_action' => $last_action
                              ]);
  }
}