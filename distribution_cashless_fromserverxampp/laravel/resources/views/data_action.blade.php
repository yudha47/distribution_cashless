<div class="d-flex justify-content-center">
  <div class="loader d-none"></div>
</div>
<table id="table-data-action" class="table table-hover table-bordered" style="white-space: nowrap;">
  <thead class="thead-dark">
    <tr class="text-center" style="white-space: nowrap">
      <th>No</th>
      <th>Date</th>
      <th style="min-width: 250px">Member Name</th>
      <th>Time</th>
      <th style="min-width: 250px">Remarks</th>
      <th>No Claim</th>
      <th>PIC</th>
      <th class="text-center">
        <button type="button" class="btn btn-secondary dropdown-toggle btn-sm btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-1">Status</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" id="filter_status_option">
          <a id="filter_status_opt1" class="dropdown-item" href="#" onclick="filter_status('Send To Analyst', 2)"><span class=""></span> Send To Analyst</a>
          <a id="filter_status_opt2" class="dropdown-item" href="#" onclick="filter_status('Analyst Process', 2)"><span class=""></span> Analyst Process</a>
          <a id="filter_status_opt3" class="dropdown-item" href="#" onclick="filter_status('RCV By Analyst', 2)"><span class=""></span> RCV By Analyst</a>
          <a id="filter_status_opt4" class="dropdown-item" href="#" onclick="filter_status('All', 2)"><span class=""></span> All Status</a>
        </div>
      </th>
      <th class="text-center bg-secondary">#</th>
      <th>PIC Analyst</th>
      <th>Finish Time</th>
      <th>Action Analyst</th>
      <th style="min-width: 300px">Action Remarks</th>
      <th class="text-center bg-secondary">#</th>
      <th>PIC MA</th>
      <th style="min-width: 300px">Remarks MA</th>
    </tr>
  </thead>
  <tbody>
    @php($no=0)
    @foreach ($data as $action)
    @php($no++)
    <tr id="row-{{$action['id_action']}}" class="tbody-admission @if($last_action['id_action'] != 0 && $action['id_action'] == $last_action['id_action']) table-success @endif">
      <td class="text-center">{{$no}}</td>
      <td>
        {{$action['date']}}</br>
        {{-- {{$action['category']}} --}}
      </td>
      <td style="white-space: normal;">
        {{$action['member_name']}}</br>
        <span class="text-center text-primary">{{$action['fullname']}}</span>
      </td>
      <td class="text-right text-success">
        Receive : {{date_format(date_create($action['time_receive']), "H:i")}}</br>
        Distribution : {{date_format(date_create($action['time_distribution']), "H:i")}}
      </td>
      {{-- <td id="" style="width: 200px; white-space: normal;" class="td-remarks d-inline-block border-bottom-0"> --}}
      <td style="white-space: normal;">
        {{$action['remarks_info']}} 
      </td>
      <td class="text-center">
        @if (strlen($action['no_claim']) == 6 )
          <a href="http://webapps.aa-international.co.id:2021/intsys/his-tpa/case_01view.php?showdetail=&id={{$action['no_claim']}}" target="_Blank"><span class="fe fe-external-link"></span> {{$action['no_claim']}}</a>
        @else
          {{$action['no_claim']}}
        @endif
      </td>
      <td class="text-center">{{$action['pic_id']}}</td>
      <td class="text-center">
        @if ($action['status'] == "Send To Analyst")
        <span class="">{{$action['status']}}</span>
          <div class="progress mt-2" style="height: 3px;">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="33"></div>
          </div>
        @elseif ($action['status'] == "Analyst Process") 
        <span class="">RCV By Analyst</span>
        <div class="progress mt-2" style="height: 3px;">
          <div class="progress-bar bg-warning" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="66"></div>
        </div>
         @else
         <span class="">{{$action['status']}}</span>
          <div class="progress mt-2" style="height: 3px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        @endif
      </td>
      <td>
        <button type="button" class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-1">Action</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          @if ($action['status'] == 'Send To Analyst')
            @if ($action['pic_analyst'] != null)
              <a class="dropdown-item disabled" href="#" onclick="form_update('{{$title}}', {{$action['id_action']}}, 'cj')">Update CJ</a>
              <a class="dropdown-item" href="#" onclick="form_update('{{$title}}', {{$action['id_action']}}, 'analyst')">Action Analyst</a>
              <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to PROCESS?') && set_process({{$action['id_action']}}, 1)">Set to Process</a>
              <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to set this action to FINISH?') && set_process({{$action['id_action']}}, 2)">Set to Finish</a>
            @else
              <a class="dropdown-item" href="#" onclick="form_update('{{$title}}', {{$action['id_action']}}, 'cj')">Update CJ</a>
              <a class="dropdown-item disabled" href="#" onclick="form_update('{{$title}}', {{$action['id_action']}}, 'analyst')">Action Analyst</a>
              <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to set this action to PROCESS?') && set_process({{$action['id_action']}}, 1)">Set to Process</a>
              <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to FINISH?') && set_process({{$action['id_action']}}, 2)">Set to Finish</a>
            @endif
          @elseif ($action['status'] == 'Analyst Process')
            @if ($action['pic_analyst'] != null)
              <a class="dropdown-item disabled" href="#" onclick="form_update('{{$title}}', {{$action['id_action']}}, 'cj')">Action CJ</a>
              <a class="dropdown-item" href="#" onclick="form_update('{{$title}}', {{$action['id_action']}}, 'analyst')">Action Analyst</a>
              <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to PROCESS?') && set_process({{$action['id_action']}}, 1)">Set to Process</a>
              <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to set this action to FINISH?') && set_process({{$action['id_action']}}, 2)">Set to Finish</a>
            @else
              <a class="dropdown-item disabled" href="#" onclick="form_update('{{$title}}', {{$action['id_action']}}, 'cj')">Action CJ</a>
              <a class="dropdown-item" href="#" onclick="form_update('{{$title}}', {{$action['id_action']}}, 'analyst')">Action Analyst</a>
              <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to PROCESS?') && set_process({{$action['id_action']}}, 1)">Set to Process</a>
              <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to FINISH?') && set_process({{$action['id_action']}}, 2)">Set to Finish</a>
            @endif
          @else
            <a class="dropdown-item disabled" href="#" onclick="form_update('{{$title}}', {{$action['id_action']}}, 'cj')">Action CJ</a>
            <a class="dropdown-item disabled" href="#" onclick="form_update('{{$title}}', {{$action['id_action']}}, 'analyst')">Action Analyst</a>
            <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to PROCESS?') && set_process({{$action['id_action']}}, 1)">Set to Process</a>
            <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to set this action to FINISH?') && set_process({{$action['id_action']}}, 2)">Set to Finish</a>
          @endif
          
          <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to remove this action?') && delete_action({{$action['id_action']}})">Delete</a>
        </div>
      </td>
      <td class="text-center">{{$action['pic_analyst']}}</td>
      <td class="text-center">
        @if($action['finish_time'] != '')
          {{date_format(date_create($action['finish_time']), "H:i")}}
        @endif
      </td>
      <td class="text-center">{{$action['action_analyst']}}</td>
      <td>
        @if ($action['time_action_analyst'] == '')
          -
        @else
          {{date_format(date_create($action['time_action_analyst']), "H:i")." - ".$action['remarks_analyst']}}
        @endif
      </td>
      <td><button class="btn btn-sm btn-outline-secondary" onclick="form_update('{{$title}}', {{$action['id_action']}}, 'ma')">Action MA</button></td>
      <td class="text-center">{{$action['pic_ma']}}</td>
      <td style="width: 300px; white-space: normal;">
        @if ($action['time_action_ma'] == '')
          -
        @else
          {{date_format(date_create($action['time_action_ma']), "H:i")." - ".$action['remarks_ma']}}
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<script>
  $(function() {
    var on = false;
    window.setInterval(function() {
        on = !on;
        if (on) {
            $('.invalid').addClass('invalid-blink')
        } else {
            $('.invalid-blink').removeClass('invalid-blink')
        }
    }, 500);
  });
    
  setTimeout(function() {
    $("#row-{{$last_action['id_action']}}").removeClass("table-success");
  }, 3000);
</script>