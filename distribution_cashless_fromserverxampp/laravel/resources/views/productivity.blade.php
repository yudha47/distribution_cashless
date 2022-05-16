@extends('layouts.main')

@section('container')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="row align-items-center mb-2">
        <div class="col">
          <h2 class="h5 page-title d-inline">Time Productivity</h2>
          {{-- <p class="text-muted">Daily Distribution Cashless</p> --}}
          <p class="text-muted"><i>*double click in row table for detail</i></p>
        </div>
        <div class="col-auto">
          <form class="form-inline">
            <div class="form-group d-none d-lg-inline">
              <label for="reportrange" class="sr-only">Date Ranges</label>
              <div id="reportrange" class="px-2 py-2 text-muted">
                <span class="small"></span>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="row">
        @foreach ($avg as $avg)
        <div class="col-md-6 col-xl-3 mb-4">
          <div class="card shadow">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-3 text-center">
                  <span class="circle circle-md bg-primary">
                    <i class="fe fe-32 fe-chevrons-right text-white mb-0"></i>
                  </span>
                </div>
                <div class="col">
                  <p class="small text-muted mb-2">AVG Time <span class="font-weight-bold">RCV to Distribution</span></p>
                  <span class="h3 mb-0">{{$avg['avg_rcv_dist']}}</span>
                  <small class="text-success">minutes</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
          <div class="card shadow">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-3 text-center">
                  <span class="circle circle-md bg-primary">
                    <i class="fe fe-32 fe-inbox text-white mb-0"></i>
                  </span>
                </div>
                <div class="col">
                  <p class="small text-muted mb-2">AVG Time <span class="font-weight-bold">Distribution to Process</span></p>
                  <span class="h3 mb-0">{{$avg['avg_dist_proc']}}</span>
                  <small class="text-success">minutes</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
          <div class="card shadow">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-3 text-center">
                  <span class="circle circle-md bg-primary">
                    <i class="fe fe-32 fe-activity text-white mb-0"></i>
                  </span>
                </div>
                <div class="col">
                  <p class="small text-muted mb-2">AVG Time <span class="font-weight-bold">Analyst Process to Action</span></p>
                  <span class="h3 mb-0">{{$avg['avg_proc_act']}}</span>
                  <small class="text-success">minutes</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
          <div class="card shadow">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-3 text-center">
                  <span class="circle circle-md bg-primary">
                    <i class="fe fe-32 fe-check-square text-white mb-0"></i>
                  </span>
                </div>
                <div class="col">
                  <p class="small text-muted mb-2">AVG Analyst <span class="font-weight-bold">Process to Finish</span></p>
                  <span class="h3 mb-0">{{$avg['avg_proc_fin']}}</span>
                  <small class="text-success">minutes</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="mb-2 align-items-center">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table datatables text-center table-hover" id="dataTable-1" style="cursor: context-menu;">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Type Action</th>
                      <th>Date</th>
                      <th>Receive</th>
                      <th>Distribution</th>
                      <th class="bg-secondary">RCV -> Distribution</th>
                      <th>Analyst Process</th>
                      <th class="bg-secondary">Distribution -> Process</th>
                      <th>Action Analyst</th>
                      <th class="bg-secondary">Process -> Action</th>
                      <th>Action Finish</th>
                      <th class="bg-secondary">Process -> Finish</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($no=0)
                    @foreach ($time as $tm)
                    @php($no++)
                    <tr id="{{$tm['id_action']}}" ondblclick="show_detail({{$tm['id_action']}})">
                      <td>{{$no}}</td>
                      <td class="text-capitalize">{{$tm['type_action']}}</td>
                      <td>{{$tm['date']}}</td>
                      <td>{{$tm['time_receive']}}</td>
                      <td>{{$tm['distribution']}}</td>
                      <td class="text-primary">{{$tm['diff_rcv_dist']}}</td>
                      <td>{{$tm['time_process']}}</td>
                      <td class="text-primary">{{$tm['diff_dist_proc']}}</td>
                      <td>{{$tm['time_action_analyst']}}</td>
                      <td class="text-primary">{{$tm['diff_proc_act']}}</td>
                      <td>{{$tm['finish_time']}}</td>
                      <td class="text-primary">{{$tm['diff_proc_fin']}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
              </div> <!-- .col -->
            </div> <!-- end section -->
          </div> <!-- .card-body -->
        </div> <!-- .card -->
      </div>

      <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            {{-- <div class="modal-header">
              <h5 class="modal-title" id="defaultModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> --}}
            {{-- <div class="modal-body">  --}}
              <div class="card card-fill timeline">
                <div class="card-header">
                  <strong class="card-title text-capitalize"><span id="action_type" class="h4">-</span> </strong>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="card-body">
                  <h6 class="text-uppercase text-muted mb-4">
                    <span id="action_date">-</span>&nbsp
                    <span id="status" class="badge badge-secondary">-</span>
                  </h6>
                  <div class="pb-3 timeline-item item-warning">
                    <div class="pl-5">
                      <div class="mb-1">
                        <strong>@<span id="pic_cj1">-</span> </strong><small><i>(Customer Journey)</i></small><span class="text-muted small mx-2">Receive information at</span>
                        <strong><span id="time_rcv">-</span></strong>
                      </div>
                      <dl class="row mb-0">
                        <dt class="col-sm-2 mb-2 text-muted">Member Name</dt>
                        <dd class="col-sm-10 mb-2"><span id="member_name">-</span></dd>
                        <dt class="col-sm-2 mb-2 text-muted">Client</dt>
                        <dd class="col-sm-10 mb-2 text-primary"><span id="client">-</span></dd>
                        <dt class="col-sm-2 mb-2 text-muted">No Claim</dt>
                        <dd class="col-sm-10 mb-2 text-primary"><span id="claim_no">-</span></dd>
                       </dl>
                    </div>
                  </div>
                  <div class="pb-3 timeline-item item-warning">
                    <div class="pl-5">
                      <div class="mb-1">
                        <strong>@<span id="pic_cj2">-</span> </strong><small><i>(Customer Journey)</i></small><span class="text-muted small mx-2">Distribute action at</span>
                        <strong><span id="time_distribute">-</span></strong>
                      </div>
                      {{-- <p class="small text-muted">Remarks</p> --}}
                      <div class="card d-inline-flex mb-1">
                        <div id="remarks_info" class="card-body bg-light py-2 px-3">-</div>
                      </div>
                    </div>
                  </div>
                  <div class="pb-3 timeline-item item-success">
                    <div class="pl-5">
                      <div class="mb-1">
                        <strong>@<span id="pic_analyst1">-</span> </strong><small><i>(Analyst)</i>
                        </small><span class="text-muted small mx-2">Set process at</span>
                        <strong><span id="time_process">-</span></strong>
                      </div>
                    </div>
                  </div>
                  <div class="pb-3 timeline-item item-success">
                    <div class="pl-5">
                      <div class="mb-1">
                        <strong>@<span id="pic_analyst2">-</span> </strong><small><i>(Analyst)</i></small>
                        <span class="text-muted small mx-2">Process action at</span>
                        <strong><span id="time_action">-</span></strong>
                      </div>
                      <dl class="row mb-0">
                        <dt class="col-sm-2 mb-1 text-muted">Action</dt>
                        <dd class="col-sm-10 mb-1">
                          <span id="action_analyst">-</span>
                        </dd>
                       </dl>
                       <div class="card d-inline-flex mb-1">
                        <div class="card-body bg-light py-2 px-3">
                          <span id="remarks_action">-</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="pb-3 timeline-item item-danger">
                    <div class="pl-5">
                      <div class="mb-1">
                        <strong>@<span id="pic_ma">-</span> </strong><small><i>(Medical Advisor)</i></small>
                        <span class="text-muted small mx-2">Process action at</span>
                        <strong><span id="time_ma">-</span></strong>
                      </div>
                      <dl class="row mb-0">
                        <dt class="col-sm-2 mb-1 text-muted">Action</dt>
                        <dd class="col-sm-10 mb-1"><span id="action_ma">-</span></dd>
                       </dl>
                       <div class="card d-inline-flex mb-2">
                        <div class="card-body bg-light py-2 px-3">
                          <span id="remarks_ma">-</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="pb-3 timeline-item item-success">
                    <div class="pl-5">
                      <div class="mb-1">
                        <strong>@<span id="pic_analyst3">-</span> </strong><small><i>(Analyst)</i></small>
                        <span class="small mx-2 badge badge-success">Finished action at</span>
                        <strong><span id="time_finish">-</span></strong>
                      </div>
                    </div>
                  </div>
                </div> <!-- / .card-body -->
              </div>
            {{-- </div> --}}
            {{-- <div class="modal-footer">
              <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn mb-2 btn-primary">Save changes</button>
            </div> --}}
          </div>
        </div>
      </div>
      
    </div> <!-- .col-12 -->
  </div> <!-- .row -->
</div> <!-- .container-fluid -->

@endsection

@section('addon-page')

<script>
  moment_start = moment().subtract(2, 'days');
  moment_end = moment();
  var filter_daterange = function(start, end){
    
  }
</script>

<script>
  $('#dataTable-1').DataTable({
    autoWidth: true,
    "lengthMenu": [
      [16, 32, 64, -1],
      [16, 32, 64, "All"]
    ]
  });

  // $('tr').on('dblclick', function() {
  var show_detail = function(id){
    // alert(this.id);
    $('#defaultModal').modal('show');
    id_action = id;
    console.log(id_action);

    var post_data = {
                      'id_action' : id_action,
                      'type_action' : 'admissions'
                    };

    $.ajax({type : 'POST',
              url : "{{ url('/action/get_action_detail') }}",
              data :  post_data,
              // headers: {
              //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              // },
              success : function(response){
                var obj = JSON.parse(response);
                // console.log(obj["data"]["type_action"]);
                $('#action_type').text(obj["data"]["type_action"]);
                $('#status').text(obj["data"]["status"]);
                $('#action_date').text(obj["data"]["date"]);
                $('#pic_cj1').text(obj["data"]["pic_id"]);
                $('#time_rcv').text(obj["data"]["date"]+" "+obj["data"]["time_receive"]);
                $('#client').text(obj["data"]["fullname"]);
                $('#member_name').text(obj["data"]["member_name"]);
                $('#claim_no').text(obj["data"]["no_claim"]);
                $('#pic_cj2').text(obj["data"]["pic_id"]);
                $('#time_distribute').text(obj["data"]["time_distribution"]);
                $('#remarks_info').text(obj["data"]["remarks_info"]);
                $('#pic_analyst1').text(obj["data"]["pic_analyst"]);
                $('#time_process').text(obj["data"]["time_process"]);
                $('#pic_analyst2').text(obj["data"]["pic_analyst"]);
                $('#time_action').text(obj["data"]["time_action_analyst"]);
                $('#action_analyst').text(obj["data"]["action_analyst"]);
                $('#remarks_action').text(obj["data"]["remarks_analyst"]);
                $('#pic_ma').text(obj["data"]["pic_ma"]);
                $('#time_ma').text(obj["data"]["time_action_ma"]);
                $('#remarks_ma').text(obj["data"]["remarks_ma"]);
                $('#pic_analyst3').text(obj["data"]["pic_analyst"]);
                $('#time_finish').text(obj["data"]["finish_time"]);
              }
    })
  };
</script>

@endsection