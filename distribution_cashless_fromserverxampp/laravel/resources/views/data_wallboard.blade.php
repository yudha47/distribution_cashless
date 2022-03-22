<div class="col-md-4">
  <div class="card shadow mb-4">
    <div class="card-header text-center">
      <strong>Admission</strong>
    </div>
    <div class="card-body px-4">
      <div class="row border-bottom">
        <div class="col-4 text-center mb-3">
          <p class="mb-1 small text-muted">All Case</p>
          <span class="h3" id="count-admissions">{{$admission_all}}</span><br />
        </div>
        <div class="col-4 text-center mb-3">
          <p class="mb-1 small text-muted"><span class="dot dot-lg bg-warning mr-2"></span>Analyst Process</p>
          <span class="h3" id="count-admissions-process">{{$admission_process}}</span><br />
        </div>
        <div class="col-4 text-center mb-3">
          <p class="mb-1 small text-muted"><span class="dot dot-lg bg-danger mr-2"></span>Send To Analyst</p>
          <span class="h3" id="count-admissions-send">{{$admission_send2analyst}}</span><br />
        </div>
      </div>
      <table class="table table-borderless mt-3 mb-1 mx-n1 table-sm text-center table-wallboard">
        <thead>
          <tr>
            <th class="text-left">Member Name</th>
            <th class="">Time Distribution</th>
            <th class="w-10">Status</th>
          </tr>
        </thead>
        <tbody id="tbody-admissions">
          @foreach ($admission as $a)
          <tr>
            <td class="text-left">
              {{$a['member_name']}}</br>
              <small class="text-primary">{{$a['fullname']}}</small>
            </td>
            <td class="font-weight-bold"><span class="d-inline-block p-1 border rounded border-success">{{date_format(date_create($a['time_distribution']), "H:i")}}</span></td>
            <td class="">
              @if ($a['status'] == "Send To Analyst")
                <span class="dot dot-lg bg-danger mr-2"></span>
              @elseif ($a['status'] == "Analyst Process")
                <span class="dot dot-lg bg-warning mr-2"></span>
              @else
              <span class="dot dot-lg bg-success mr-2"></span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div> <!-- .card-body -->
  </div> <!-- .card -->
</div> <!-- .col -->
<div class="col-md-4">
  <div class="card shadow mb-4">
    <div class="card-header text-center">
      <strong>Monitoring</strong>
    </div>
    <div class="card-body px-4">
      <div class="row border-bottom">
        <div class="col-4 text-center mb-3">
          <p class="mb-1 small text-muted">All Case</p>
          <span class="h3" id="count-monitoring">{{$monitoring_all}}</span><br />
        </div>
        <div class="col-4 text-center mb-3">
          <p class="mb-1 small text-muted"><span class="dot dot-lg bg-warning mr-2"></span>Analyst Process</p>
          <span class="h3" id="count-monitoring-process">{{$monitoring_process}}</span><br />
        </div>
        <div class="col-4 text-center mb-3">
          <p class="mb-1 small text-muted"><span class="dot dot-lg bg-danger mr-2"></span>Send To Analyst</p>
          <span class="h3" id="count-monitoring-send">{{$monitoring_send2analyst}}</span><br />
        </div>
      </div>
      <table class="table table-borderless mt-3 mb-1 mx-n1 table-sm text-center">
        <thead>
          <tr>
            <th class="text-left">Member Name</th>
            <th class="">Time Distribution</th>
            <th class="w-10">Status</th>
          </tr>
        </thead>
        <tbody id="tbody-monitoring">
          @foreach ($monitoring as $m)
          <tr>
            <td class="text-left">
              {{$m['member_name']}}</br>
              <small class="text-primary">{{$m['fullname']}}</small>
            </td>
            <td class="font-weight-bold"><span class="d-inline-bloc p-1 border rounded border-success">{{date_format(date_create($m['time_distribution']), "H:i")}}</span></td>
            <td class="">
              @if ($m['status'] == "Send To Analyst")
                <span class="dot dot-lg bg-danger mr-2"></span>
              @elseif ($m['status'] == "Analyst Process")
                <span class="dot dot-lg bg-warning mr-2"></span>
              @else
              <span class="dot dot-lg bg-success mr-2"></span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div> <!-- .card-body -->
  </div> <!-- .card -->
</div> <!-- .col -->
<div class="col-md-4">
  <div class="card shadow mb-4">
    <div class="card-header text-center">
      <strong>Discharge</strong>
    </div>
    <div class="card-body px-4">
      <div class="row border-bottom">
        <div class="col-4 text-center mb-3">
          <p class="mb-1 small text-muted">All Case</p>
          <span class="h3" id="count-discharge">{{$discharge_all}}</span><br />
        </div>
        <div class="col-4 text-center mb-3">
          <p class="mb-1 small text-muted"><span class="dot dot-lg bg-warning mr-2"></span>Analyst Process</p>
          <span class="h3" id="count-discharge-process">{{$discharge_process}}</span><br />
        </div>
        <div class="col-4 text-center mb-3">
          <p class="mb-1 small text-muted"><span class="dot dot-lg bg-danger mr-2"></span>Send To Analyst</p>
          <span class="h3" id="count-discharge-send">{{$discharge_send2analyst}}</span><br />
        </div>
      </div>
      <table class="table table-borderless mt-3 mb-1 mx-n1 table-sm text-center">
        <thead>
          <tr>
            <th class="text-left">Member Name</th>
            <th class="">Time Distribution</th>
            <th class="w-10">Status</th>
          </tr>
        </thead>
        <tbody id="tbody-discharge">
          @foreach ($discharge as $d)
          <tr>
            <td class="text-left">
              {{$d['member_name']}}</br>
              <small class="text-primary">{{$d['fullname']}}</small>
            </td>
            <td class="font-weight-bold"><span class="d-inline-bloc p-1 border rounded border-success">{{date_format(date_create($d['time_distribution']), "H:i")}}</span></td>
            <td class="">
              @if ($d['status'] == "Send To Analyst")
                <span class="dot dot-lg bg-danger mr-2"></span>
              @elseif ($d['status'] == "Analyst Process")
                <span class="dot dot-lg bg-warning mr-2"></span>
              @else
              <span class="dot dot-lg bg-success mr-2"></span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div> <!-- .card-body -->
  </div> <!-- .card -->
</div> <!-- .col -->