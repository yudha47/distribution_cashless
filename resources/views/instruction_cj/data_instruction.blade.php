<div class="d-flex justify-content-center">
  <div class="loader d-none"></div>
</div>
<table id="table-data-action" class="table table-hover table-bordered" style="white-space: nowrap;">
  <thead class="thead-dark">
    <tr class="text-center" style="white-space: nowrap">
      <th>No</th>
      <th>Date</th>
      <th style="min-width: 250px">Member Name</th>
      <th>Time Distribution</th>
      <th style="min-width: 200px">Remarks</th>
      <th>No Claim</th>
      <th>PIC</th>
      <th class="text-center">
        <button type="button" class="btn btn-secondary dropdown-toggle btn-sm btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-1">Status</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" id="filter_status_option">
          <a id="filter_status_opt1" class="dropdown-item" href="#" onclick="filter_status('Send To CJ', 2)"><span class=""></span> Send To CJ</a>
          <a id="filter_status_opt2" class="dropdown-item" href="#" onclick="filter_status('CJ Process', 2)"><span class=""></span> CJ Process</a>
          <a id="filter_status_opt3" class="dropdown-item" href="#" onclick="filter_status('RCV By CJ', 2)"><span class=""></span> RCV By CJ</a>
          <a id="filter_status_opt4" class="dropdown-item" href="#" onclick="filter_status('All', 2)"><span class=""></span> All Status</a>
        </div>
      </th>
      <th class="text-center bg-secondary">#</th>
      <th>PIC CJ</th>
      <th style="min-width: 300px">Action Remarks</th>
      <th>Finish Time</th>
    </tr>
  </thead>
  <tbody>
    @php($no=0)
    @foreach ($data as $instruction)
    @php($no++)
    <tr id="row-{{$instruction['id_instruction']}}" class="tbody-admission @if($last_action['id_instruction'] != 0 && $instruction['id_instruction'] == $last_action['id_instruction']) table-success @endif">
      <td class="text-center">{{$no}}</td>
      <td>
        {{$instruction['date']}}</br>
        {{$instruction['category']}}
      </td>
      <td style="white-space: normal;">
        {{$instruction['member_name']}}</br>
        <span class="text-center text-primary">{{$instruction['fullname']}}</span>
      </td>
      <td class="text-center text-success">
        {{date_format(date_create($instruction['time_distribution']), "H:i")}}
      </td>
      <td style="white-space: normal;">
        {{$instruction['remarks_info']}} 
      </td>
      <td class="text-center">
        @if (strlen($instruction['no_claim']) == 6 )
          <a href="http://webapps.aa-international.co.id:2021/intsys/his-tpa/case_01view.php?showdetail=&id={{$instruction['no_claim']}}" target="_Blank"><span class="fe fe-external-link"></span> {{$instruction['no_claim']}}</a>
        @else
          {{$instruction['no_claim']}}
        @endif
      </td>
      <td class="text-center">{{$instruction['pic_id']}}</td>
      <td class="text-center">
        @if ($instruction['status'] == "Send To CJ")
        <span class="">{{$instruction['status']}}</span>
          <div class="progress mt-2" style="height: 3px;">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="33"></div>
          </div>
        @elseif ($instruction['status'] == "CJ Process") 
        <span class="">RCV By CJ</span>
        <div class="progress mt-2" style="height: 3px;">
          <div class="progress-bar bg-warning" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="66"></div>
        </div>
         @else
         <span class="">{{$instruction['status']}}</span>
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
          @if ($instruction['status'] == 'Send To CJ')
            @if ($instruction['pic_cj'] != null)
              <a class="dropdown-item disabled" href="#" onclick="form_update({{$instruction['id_instruction']}}, 'analyst')">Update Analyst</a>
              <a class="dropdown-item" href="#" onclick="form_update({{$instruction['id_instruction']}}, 'cj')">Action CJ</a>
              <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to PROCESS?') && set_process({{$instruction['id_instruction']}}, 1)">Set to Process</a>
              <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to set this action to FINISH?') && set_process({{$instruction['id_instruction']}}, 2)">Set to Finish</a>
            @else
              <a class="dropdown-item" href="#" onclick="form_update({{$instruction['id_instruction']}}, 'analyst')">Update Analyst</a>
              <a class="dropdown-item disabled" href="#" onclick="form_update({{$instruction['id_instruction']}}, 'cj')">Action CJ</a>
              <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to set this action to PROCESS?') && set_process({{$instruction['id_instruction']}}, 1)">Set to Process</a>
              <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to FINISH?') && set_process({{$instruction['id_instruction']}}, 2)">Set to Finish</a>
            @endif
          @elseif ($instruction['status'] == 'CJ Process')
            @if ($instruction['pic_cj'] != null)
              <a class="dropdown-item disabled" href="#" onclick="form_update({{$instruction['id_instruction']}}, 'analyst')">Action Analyst</a>
              <a class="dropdown-item" href="#" onclick="form_update({{$instruction['id_instruction']}}, 'cj')">Action CJ</a>
              <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to PROCESS?') && set_process({{$instruction['id_instruction']}}, 1)">Set to Process</a>
              <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to set this action to FINISH?') && set_process({{$instruction['id_instruction']}}, 2)">Set to Finish</a>
            @else
              <a class="dropdown-item disabled" href="#" onclick="form_update({{$instruction['id_instruction']}}, 'analyst')">Action Analyst</a>
              <a class="dropdown-item" href="#" onclick="form_update({{$instruction['id_instruction']}}, 'cj')">Action CJ</a>
              <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to PROCESS?') && set_process({{$instruction['id_instruction']}}, 1)">Set to Process</a>
              <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to FINISH?') && set_process({{$instruction['id_instruction']}}, 2)">Set to Finish</a>
            @endif
          @else
            <a class="dropdown-item disabled" href="#" onclick="form_update({{$instruction['id_instruction']}}, 'cj')">Action CJ</a>
            <a class="dropdown-item disabled" href="#" onclick="form_update({{$instruction['id_instruction']}}, 'analyst')">Action Analyst</a>
            <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to PROCESS?') && set_process({{$instruction['id_instruction']}}, 1)">Set to Process</a>
            <a class="dropdown-item disabled" href="#" onclick="return confirm('Are you sure want to set this action to FINISH?') && set_process({{$instruction['id_instruction']}}, 2)">Set to Finish</a>
          @endif
          
          <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to remove this action?') && delete_instruction({{$instruction['id_instruction']}})">Delete</a>
        </div>
      </td>
      <td class="text-center">{{$instruction['pic_cj']}}</td>
      <td>
        @if ($instruction['time_action_cj'] == '')
          -
        @else
          {{date_format(date_create($instruction['time_action_cj']), "H:i")." - ".$instruction['remarks_cj']}}
        @endif
      </td>
      <td class="text-center">
        @if($instruction['finish_time'] != '')
          {{date_format(date_create($instruction['finish_time']), "H:i")}}
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
    $("#row-{{$last_action['id_instruction']}}").removeClass("table-success");
  }, 3000);
</script>
