<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\InstructionCj;
use App\Models\CategoryAction;

class InstructionCjController extends Controller{
  private $dt_now;
  private $title;

  public function __construct(){
    $this->title = 'Instruction CJ';
    $this->dt_now = date('Y-m-d H:i:s');
  }

  public function check_type($type_action){
    if($type_action == 'admissions' || $type_action == 'monitoring' || $type_action == 'discharge'){
      return '1';
    }else{
      return '0';
    }
  }

  public function sess_date(Request $request){
    $datestart = '';
    $dateend = '';

    if($request->session()->has('datestart_cj')){
      $datestart = $request->session()->get('datestart_cj');
      $dateend = $request->session()->get('dateend_cj');
    }else{
      $datestart = Carbon::now()->subDays(1)->format('Y-m-d');
      $dateend = Carbon::now()->format('Y-m-d');
    }

    return array($datestart, $dateend);
  }

  public function data_instruction(Request $request){
    $sess_date = self::sess_date($request);
    $datestart = $sess_date[0];
    $dateend = $sess_date[1];

    $result = InstructionCj::Join('clients', 'clients.id_client', '=', 'instruction_cj.client_id')
                          ->select('*')
                          ->whereBetween('date', [$datestart, $dateend])
                          ->orderBy('id_instruction', 'ASC')
                          ->get();

    return $result;
  }
  
  public function index(Request $request, $mode = null){
    $client = Client::all();
    $user = User::all();
    $status = Status::all();

    $category_action = CategoryAction::Join('action_types', 'action_types.id_types', '=', 'category_actions.action_type')
                                  ->select('*')
                                  ->where('action_name', 'instruction_cj')
                                  ->get();

    $result = self::data_instruction($request);
    if($mode == null){
      $all_action = $result->count();
      $status1 = $result->where('status', 'Send To CJ')->count();
      return view('instruction_cj/instruction', [
                                    'title'=> $this->title, 
                                    'action'=>'instruction_cj', 
                                    'data'=>$result, 
                                    'client'=>$client, 
                                    'user'=>$user, 
                                    'status'=>$status,
                                    'all_act'=>$all_action,
                                    'status1'=>$status1,
                                    'category_action'=>$category_action
                                  ]);
    }else if($mode == 'filter_notif'){
      $result_notif = $result->where('action_analyst', 'Send To MA');

      $all_action = $result->count();
      $status1 = $result->where('status', 'Send To CJ')->count();
      
      return view('instruction_cj/instruction', [
                                    'title'=> $this->title, 
                                    'action'=>'instruction_cj', 
                                    // 'data'=>$result_notif, 
                                    'client'=> $client, 
                                    'user'=> $user, 
                                    'status'=> $status,
                                    'all_act'=> $all_action,
                                    'status1'=> $status1,
                                    'category_action'=> $category_action,
                                    'data_notif' => '3',
                                    'notif_status' => 'Send To CJ'
                                  ]);
    }
  }

  public function action_daterange(Request $request){
    $request->session()->put('datestart_cj', "$request->date_start");
    $request->session()->put('dateend_cj', "$request->date_end");

    $result = self::data_instruction($request);

    $last_action = 0;
    return view('instruction_cj/data_instruction', [
                                'title'=> $this->title, 
                                'data'=>$result, 
                                'last_action' => $last_action
                                ]
                              );
  }

  public function refresh_action(Request $request){
    $type_action = $request->type_action;

    $result = self::data_instruction($request);

    $last_action = 0;
    return view('instruction_cj/data_instruction', [
                                'title'=> $this->title, 
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
    $result = self::data_instruction($request);

    $all_action = $result->count();
    $status1 = $result->where('status', 'Send To CJ')->count();

    return view('instruction_cj/summary_status_instruction', [
                                          'all_act'=>$all_action,
                                          'status1'=>$status1
                                          ]);
  }

  public function input_data(Request $request){
    $date = date_format(date_create($request->date_start), "y-m-d");

    InstructionCj::create([
                        'date' => $date,
                        'category' => $request->category,
                        'member_name' => $request->member_name,
                        'client_id' => $request->client_id,
                        'time_distribution' => $this->dt_now,
                        'remarks_info' => $request->remarks_info,
                        'no_claim' => $request->no_claim,
                        'pic_id' => $request->pic_id,
                        'status' => $request->status
                      ]);

    $result = self::data_instruction($request);

    $last_action = InstructionCj::where('member_name', $request->member_name)
                                      ->where('time_distribution', $this->dt_now)
                                      ->first();

    return view('instruction_cj/data_instruction', [
                                                    'title'=> $this->title, 
                                                    'data'=>$result, 
                                                    'last_action' => $last_action
                                                  ]);
  }

  public function get_action(Request $request){
    $id = $request->id_action;
    $data = InstructionCj::where("id_instruction", $id)->first();

    return json_encode(array('data'=>$data));
  }

  public function set_to_process(Request $request){
    $pic = $request->session()->get('username');
    $id_action = $request->id_action;
    $mode = $request->mode;
    // $type_action = $request->type_action;

    if($mode == 1){
      InstructionCj::where("id_instruction", $id_action)
                      ->update([
                                'status' => 'CJ Process',
                                'pic_cj' => $pic
                              ]);
    }else{
      InstructionCj::where("id_instruction", $id_action)
                      ->update([
                                'status' => 'RCV By CJ',
                                'finish_time' => $this->dt_now
                              ]);
    }

    $result = self::data_instruction($request);
    $last_action = InstructionCj::where('id_instruction', $id_action)
                              ->first();

    return view('instruction_cj/data_instruction', [
                                                    'title'=> $this->title, 
                                                    'data'=>$result, 
                                                    'last_action' => $last_action
                                                    ]
                                                  );
  }

  public function update_action(Request $request){
    $id_action = $request->id_action;
    $operator = $request->operator;

    if($operator == 'analyst'){
      InstructionCj::where("id_instruction", $id_action)
                      ->update([
                                'member_name' => $request->member_name,
                                'client_id' => $request->client_id,
                                'time_receive' => $request->time_receive,
                                'remarks_info' => $request->remarks_info,
                                'no_claim' => $request->no_claim,
                              ]);
    }else{
      if($request->mode == 'process'){
        InstructionCj::where("id_instruction", $id_action)
                        ->update([
                                  'pic_cj' => $request->picanalyst,
                                  'remarks_cj' => $request->actionremarks,
                                  'time_action_cj' => $this->dt_now,
                                  'status' => $request->status
                                ]);
      }else{
        InstructionCj::where("id_instruction", $id_action)
                          ->update([
                                    'pic_cj' => $request->picanalyst,
                                    'finish_time' => $this->dt_now,
                                    'remarks_cj' => $request->actionremarks,
                                    'status' => $request->status
                                  ]);
      }
    }

    $result = self::data_instruction($request);

    $last_action = 0;
    return view('instruction_cj/data_instruction', [
                                                    'title'=> $this->title, 
                                                    'data'=>$result, 
                                                    'last_action' => $last_action
                                                  ]);
  }

  public function filter_status(Request $request){  
    $mode = $request->mode;
    $status = $request->status;

    $sess_date = self::sess_date($request);
    $datestart = $sess_date[0];
    $dateend = $sess_date[1];
    

    if($mode == 1){
      if($status == 'Send To CJ'){
        $result = InstructionCj::Join('clients', 'clients.id_client', '=', 'instruction_cj.client_id')
                                  ->select('*')
                                  ->whereBetween('date', [$datestart, $dateend])
                                  ->where('status', $status)
                                  ->orderBy('id_instruction', 'ASC')
                                  ->get();
      }else{
        $result = InstructionCj::Join('clients', 'clients.id_client', '=', 'instruction_cj.client_id')
                                  ->select('*')
                                  ->whereBetween('date', [$datestart, $dateend])
                                  ->orderBy('id_instruction', 'ASC')
                                  ->get();
      }
    }else if($mode == 3){
      $result = InstructionCj::Join('clients', 'clients.id_client', '=', 'instruction_cj.client_id')
                                ->select('*')
                                ->where('status', 'Send To CJ')
                                ->orderBy('id_instruction', 'ASC')
                                ->get();
    }else{
      if($status == 'All'){
        $result = InstructionCj::Join('clients', 'clients.id_client', '=', 'instruction_cj.client_id')
                                  ->select('*')
                                  ->whereBetween('date', [$datestart, $dateend])
                                  ->orderBy('id_instruction', 'ASC')
                                  ->get();
      }else{
        $result = InstructionCj::Join('clients', 'clients.id_client', '=', 'instruction_cj.client_id')
                                  ->select('*')
                                  ->where('status', $status)
                                  ->whereBetween('date', [$datestart, $dateend])
                                  ->orderBy('id_instruction', 'ASC')
                                  ->get();
      }
    }

    $last_action = 0;
    return view('instruction_cj/data_instruction', [
                                                    'title' => $this->title, 
                                                    'data' => $result, 
                                                    'last_action' => $last_action
                                                  ]);
  }

  public function delete_instruction(Request $request){
    $id = $request->id_action;

    InstructionCj::where("id_instruction", $id)->delete();

    $result = self::data_instruction($request);

    $last_action = 0;
    return view('instruction_cj/data_instruction', [
                                'title'=> $this->title, 
                                'data'=>$result, 
                                'last_action' => $last_action
                              ]);
  }

  public function search_instruction(Request $request){    
    $value = $request->value;
    
    $result = InstructionCj::Join('clients', 'clients.id_client', '=', 'instruction_cj.client_id')
                                ->select('*')
                                ->where('member_name', 'LIKE', "%{$value}%") 
                                ->orwhere('no_claim', 'LIKE', "%{$value}%") 
                                ->orderBy('id_instruction', 'ASC')
                                ->get();

    $last_action = 0;
    return view('data_action', [
                                'title'=> $this->title, 
                                'data'=>$result, 
                                'last_action' => $last_action
                              ]);
  }
}
