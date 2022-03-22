@extends('layouts.main')

@section('container')

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="row">
        <div id="table-admission" class="col-md-12">
          <div class="">
            <h2 class="h4 text-center">{{$title}}</h2>
            {{-- <form class="form-inline justify-content-center">
              <div class="form-group d-none d-lg-inline rounded py-1 px-2 ">
                <label for="reportrange" class="sr-only">Date Ranges</label>
                <div id="reportrange" class="">
                  <span id="daterange-wallboard" class="small btn btn-outline-primary btn-sm">February 9, 2022 - February 9, 2022</span>
                  <span id="datestart-wallboard" class="small d-none"></span>
                  <span id="dateend-wallboard" class="small d-none"></span>
                </div>
              </div>
            </form> --}}
          </div>
          <div id="wallboard-space" class="row mt-4">
            {{-- <div class="col-md-4">
              <div class="card shadow mb-4">
                <div class="card-header text-center">
                  <strong>Admission</strong>
                </div>
                <div class="card-body px-4">
                  <div class="row border-bottom">
                    <div class="col-4 text-center mb-3">
                      <p class="mb-1 small text-muted">All Case</p>
                      <span class="h3">{{$admission_all}}</span><br />
                    </div>
                    <div class="col-4 text-center mb-3">
                      <p class="mb-1 small text-muted"><span class="dot dot-lg bg-danger mr-2"></span>Send To Analyst</p>
                      <span class="h3">{{$admission_send2analyst}}</span><br />
                    </div>
                    <div class="col-4 text-center mb-3">
                      <p class="mb-1 small text-muted"><span class="dot dot-lg bg-success mr-2"></span>RCV By Analyst</p>
                      <span class="h3">{{$admission_send2ma}}</span><br />
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
                    <tbody>
                      @foreach ($admission as $a)
                      <tr>
                        <td class="text-left">{{$a['member_name']}}</td>
                        <td class="">{{date_format(date_create($a['time_distribution']), "H:i")}}</td>
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
                      <span class="h3">{{$monitoring_all}}</span><br />
                    </div>
                    <div class="col-4 text-center mb-3">
                      <p class="mb-1 small text-muted"><span class="dot dot-lg bg-danger mr-2"></span>Send To Analyst</p>
                      <span class="h3">{{$monitoring_send2analyst}}</span><br />
                    </div>
                    <div class="col-4 text-center mb-3">
                      <p class="mb-1 small text-muted"><span class="dot dot-lg bg-success mr-2"></span>RCV By Analyst</p>
                      <span class="h3">{{$monitoring_rcvbyanalyst}}</span><br />
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
                    <tbody>
                      @foreach ($monitoring as $m)
                      <tr>
                        <td class="text-left">{{$m['member_name']}}</td>
                        <td class="">{{date_format(date_create($m['time_distribution']), "H:i")}}</td>
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
                      <span class="h3">{{$discharge_all}}</span><br />
                    </div>
                    <div class="col-4 text-center mb-3">
                      <p class="mb-1 small text-muted"><span class="dot dot-lg bg-danger mr-2"></span>Send To Analyst</p>
                      <span class="h3">{{$discharge_send2analyst}}</span><br />
                    </div>
                    <div class="col-4 text-center mb-3">
                      <p class="mb-1 small text-muted"><span class="dot dot-lg bg-success mr-2"></span>RCV By Analyst</p>
                      <span class="h3">{{$discharge_rcvbyanalyst}}</span><br />
                    </div>
                  </div>
                  <table class="table table-borderless mt-3 mb-1 mx-n1 table-sm text-center">
                    <thead>
                      @foreach ($discharge as $d)
                      <tr>
                        <td class="text-left">{{$d['member_name']}}</td>
                        <td class="">{{date_format(date_create($d['time_distribution']), "H:i")}}</td>
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
            </div> <!-- .col --> --}}
          </div> <!-- .row -->
        </div>
      </div> <!-- end section -->
    </div> <!-- .col-12 -->
  </div> <!-- .row -->
</div> <!-- .container-fluid -->

<script>
  var filter_daterange = function(start, end){
    $('#reportrange #daterange-wallboard').html(moment(start).format('MMMM D, YYYY') + ' - ' + moment(end).format('MMMM D, YYYY'));
    $('#reportrange #datestart-wallboard').html(moment(start).format('YYYY-MM-DD'));
    $('#reportrange #dateend-wallboard').html(moment(end).format('YYYY-MM-DD'));
    var date_start = moment(start).format('YYYY-MM-DD');
    var date_end = moment(end).format('YYYY-MM-DD')

    var post_data = {
                    'date_start' : date_start,
                    'date_end' : date_end,
                    };

    $.ajax({url: "{{ url('/wallboard/filter') }}",
            type: "POST",
            data :  post_data,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response){
              $('#wallboard-space').html(response);
            }
          });
  }

var reload_action = function(type_action){
  start = $("#datestart-wallboard").text();
  end = $("#dateend-wallboard").text();

  var post_data = {
                  'type_action' : type_action,
                  'date_start' : start,
                  'date_end' : end,
                  };

  $.ajax({url: "{{ url('/wallboard/reload') }}",
          type: "POST",
          data :  post_data,
          success : function(response){
            // console.log("reload"+type_action);
            $('#tbody-'+type_action).html(response);

            $.ajax({url: "{{ url('/wallboard/reload_count') }}",
                    type: "POST",
                    data :  post_data,
                    success : function(data){
                      // console.log('reload_count '+data);
                      var obj = JSON.parse(data);
                      $('#count-'+type_action).text(obj["data"][0]);
                      $('#count-'+type_action+'-send').text(obj["data"][1]);
                      $('#count-'+type_action+'-process').text(obj["data"][2]);
                    }
                  });
          }
        });
}

</script>
@endsection

@section('addon-page')

@if (Session::has('datestart_wallboard'))
  <script>
    const ds = new Date("{{Session::get('datestart_wallboard')}}");
    const de = new Date("{{Session::get('dateend_wallboard')}}");
    moment_start =moment(ds);
    moment_end =moment(de);
  </script>
@else
  <script>
    moment_start = moment();
    moment_end =moment();
  </script>  
@endif

@endsection

@section('js-last')
<script>
  var interval_reload_action = function(){
    setTimeout(function() {
                          reload_action("admissions");
                          setTimeout(function() {
                                                reload_action("monitoring");
                                              }, 2500);
                                              setTimeout(function() {
                                                                    reload_action("discharge");
                                                                  }, 2500);
                                                                  setTimeout(function() {
                                                                                      interval_reload_action();
                                                                                      }, 2500);
                        }, 2500);
  }
</script>
@if ($mode == null)
<script>
  setTimeout(function() {
                        reload_action("admissions");
                        setTimeout(function() {
                                              reload_action("monitoring");
                                            }, 2000);
                                            setTimeout(function() {
                                                                  reload_action("discharge");
                                                                }, 2000);
                      }, 2000);
</script>
@else
<script>
  setTimeout(function() {
                        reload_action("admissions");
                        setTimeout(function() {
                                              reload_action("monitoring");
                                            }, 2000);
                                            setTimeout(function() {
                                                                  reload_action("discharge");
                                                                }, 2000);
                                                                  setTimeout(function() {
                                                                                      interval_reload_action();
                                                                                      }, 2000);
                      }, 2000);
</script>
@endif
@endsection