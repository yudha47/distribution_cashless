@extends('layouts.main')

@section('container')

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="row">
        <div id="table-admission" class="col-md-12">
          <h2 class="h4 mb-3 d-inline">{{$title}}</h2>
          <p id="subtitle-date" class="text-muted"></p>
          <div class="card shadow">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="toolbar row mb-2">
                    <div id="summary-space" class="col-md">
                      {{-- <ul id="summary-status" class="nav nav-pills justify-content-start">
                        <li class="nav-item">
                          <a class="nav-link active bg-transparent pr-2 pl-0 text-primary" href="#">All <span class="badge badge-pill bg-primary text-white ml-2">{{$all_add}}</span></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-muted px-2" href="#">Send To Analyst <span class="badge badge-pill bg-white border ml-2">{{$send2analyst}}</span></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-muted px-2" href="#">Pending Jaminan Awal <span class="badge badge-pill bg-white border ml-2">{{$pending}}</span></a>
                        </li>
                        <form class="ml-3 form-inline d-none d-lg-flex searchform text-muted">
                          <input id="form-search" class="form-control form-control-sm mr-sm-2 bg-transparent border-0d pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
                        </form>
                      </ul> --}}
                    </div>
                    <div class="col-md-auto ml-auto text-right">
                      <form class="form-inline">
                        {{-- <div class="input-group mb-3">
                          <input type="text" class="form-control form-control-sm" placeholder="Button addons" aria-label="Recipient's username" aria-describedby="button-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="button" id="button-addon2">Button</button>
                          </div>
                        </div> --}}
                        <button id="btn-formadd" type="button" class="btn btn-sm btn-primary mr-2" onclick="show_formadd()">
                          <span class="fe fe-plus"></span> 
                          Admissions
                        </button>
                        
                        {{-- <button type="button" class="btn btn-outline-secondary dropdown-toggle btn-sm mr-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="mr-1">All Status</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#" onclick="input_admission(1, 'cj')">Action CJ</a>
                          <a class="dropdown-item" href="#" onclick="input_admission(1, 'analyst')">Action Analyst</a>
                          <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to set this claim to process?') && set_process(1)">Set to Process</a>
                          <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to remove this action?') && delete_admission(1)">Delete</a>
                        </div> --}}
                        <div class="form-group d-none d-lg-inline border rounded py-1 px-2 ">
                          <label for="reportrange" class="sr-only">Date Ranges</label>
                          <div id="reportrange" class="">
                            <span id="daterange-admissions" class="small"></span>
                            <span id="datestart" class="small d-none"></span>
                            <span id="dateend" class="small d-none"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <button type="button" class="btn btn-sm border ml-2" onclick="refresh_admission()">
                            <span class="fe fe-refresh-ccw fe-16 text-muted"></span>
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div id="form-add" class="col-md-12 ml-auto pt-2 my-2 border" style="display: none">
                    <div>
                      <div class="form-row">
                        <div class="form-group col-md-2">
                          <label for="inputCity">Date</label>
                          <div class="input-group">
                            <input type="text" class="form-control drgpicker form-control-sm" id="add_date" value="" aria-describedby="button-addon2" autocomplete="off">
                            <div class="input-group-append">
                              <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputCity">Member Name</label>
                          <input type="text" class="form-control form-control-sm" id="add_membername">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputCity">Client</label>
                          <select name="" class="form-control form-control-sm" id="add_client">
                            @foreach ($client as $c)
                              <option value="{{$c['id_client']}}">{{$c['fullname']}}</option>
                            @endforeach
                          </select>
                        </div>
                        {{-- <div class="form-group col-md-1">
                          <label for="inputCity">Distribution</label>
                          <input id="add_distribution" class="form-control form-control-sm" type="time" name="time_distribution">
                        </div> --}}
                        <div class="form-group col-md-1">
                          <label for="inputCity">RCV Email</label>
                          <input id="add_rcvemail" class="form-control form-control-sm" type="time" name="time_distribution">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputCity">Remarks</label>
                          <textarea name="" class="form-control form-control-sm" id="add_remarks" rows="1"></textarea>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputCity">No Claim</label>
                          <input type="text" class="form-control form-control-sm" id="add_noclaim">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputCity">Category</label>
                          <select name="" class="form-control form-control-sm" id="add_category">
                            <option value="0" disabled selected>Please Select</option>
                            <option value="Review initial LOG">Review initial LOG</option>
                            <option value="Review ME">Review ME </option>
                          </select>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputCity">PIC</label>
                          <input type="text" class="form-control form-control-sm" id="add_pic" value="{{Session::get('username')}}" readonly>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputCity">Status</label>
                          <input type="text" class="form-control form-control-sm" id="add_status" value="Send To Analyst" readonly>
                        </div>
                      </div>
                      <button type="button" class="btn btn-sm btn-primary mb-3" onclick="store_admission()">Save</button>
                      <button type="button" class="btn btn-sm btn-secondary mb-3 ml-1" onclick="hide_formadd()">Cancel</button>
                    </div>
                  </div>
                  <!-- table -->
                  <div id="table-space" class="scrollbar-info" style="overflow-x: scroll;">
                    <div class="d-flex justify-content-center">
                      <div class="loader d-none"></div>
                    </div>
                    <table id="table-data-admission" class="table table-hover table-bordered" style="table-layout: auto;">
                      {{-- <thead class="thead-dark">
                        <tr class="text-center" style="white-space: nowrap">
                          <th>No</th>
                          <th>Date</th>
                          <th>Category</th>
                          <th>Member Name</th>
                          <th>Client</th>
                          <th>Time Distribution</th>
                          <th>Time RCV Email</th>
                          <th style="min-width: 200px">Remarks</th>
                          <th>No Claim</th>
                          <th>PIC</th>
                          <th class="text-center">
                            <button type="button" class="btn btn-secondary dropdown-toggle btn-sm btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="mr-1">All Status</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#" onclick="input_admission(1, 'cj')">Action CJ</a>
                              <a class="dropdown-item" href="#" onclick="input_admission(1, 'analyst')">Action Analyst</a>
                              <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to set this claim to process?') && set_process(1)">Set to Process</a>
                              <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to remove this action?') && delete_admission(1)">Delete</a>
                            </div>
                          </th>
                          <th class="text-center bg-secondary">#</th>
                          <th>PIC Analyst</th>
                          <th>Finish Time</th>
                          <th>Action Analyst</th>
                          <th style="min-width: 300px">Action Remarks</th>
                          <th>PIC MA</th>
                          <th>Remarks MA</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php($no=0)
                        @foreach ($data as $admission)
                        @php($no++)
                        <tr id="row-{{$admission['id_admission']}}" class="tbody-admission">
                          <td class="text-center">{{$no}}</td>
                          <td style="white-space: nowrap">{{$admission['date_start']}}</td>
                          <td class="text-center">{{$admission['category']}}</td>
                          <td style="white-space: nowrap">{{$admission['member_name']}}</td>
                          <td style="">{{$admission['fullname']}}</td>
                          <td class="text-center">
                            @if($admission['time_distribution'] != '')
                            {{date_format(date_create($admission['time_distribution']), "H:i")}}
                            @endif
                          </td>
                          <td class="text-center">
                            @if($admission['time_rcv_email'] != '')
                            {{date_format(date_create($admission['time_rcv_email']), "H:i")}}
                            @endif
                          </td>
                          <td style="white-space:normal">{{$admission['remarks_info']}}</td>
                          <td class="text-center" style="white-space: nowrap">{{$admission['no_claim']}}</td>
                          <td class="text-center">{{$admission['pic_id']}}</td>
                          <td style="white-space: nowrap">
                            <span class="small">{{$admission['status_admission']}}</span>
                            @if ($admission['status_admission'] == "Send To Analyst")
                              <div class="progress mt-2" style="height: 3px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="33"></div>
                              </div>
                            @elseif ($admission['status_admission'] == "Analyst Process") 
                            <div class="progress mt-2" style="height: 3px;">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="66"></div>
                            </div>
                            @else
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
                              @if ($admission['status_admission'] == "Send To Analyst")
                                <a class="dropdown-item" href="#" onclick="input_admission({{$admission['id_admission']}}, 'cj')">Action CJ</a>
                                <a class="dropdown-item" href="#" onclick="input_admission({{$admission['id_admission']}}, 'analyst')">Action Analyst</a>
                                <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to set this claim to process?') && set_process({{$admission['id_admission']}})">Set to Process</a>
                              @elseif ($admission['status_admission'] == "Analyst Process")
                                <a class="dropdown-item Disabled" href="#" onclick="input_admission({{$admission['id_admission']}}, 'cj')">Action CJ</a>
                                <a class="dropdown-item" href="#" onclick="input_admission({{$admission['id_admission']}}, 'analyst')">Action Analyst</a>
                                <a class="dropdown-item Disbaled" href="#" onclick="return confirm('Are you sure want to set this claim to process?') && set_process({{$admission['id_admission']}})">Set to Process</a>
                              @else
                                <a class="dropdown-item Disabled" href="#" onclick="input_admission({{$admission['id_admission']}}, 'cj')">Action CJ</a>
                                <a class="dropdown-item Disabled" href="#" onclick="input_admission({{$admission['id_admission']}}, 'analyst')">Action Analyst</a>
                                <a class="dropdown-item Disabled" href="#" onclick="return confirm('Are you sure want to set this claim to process?') && set_process({{$admission['id_admission']}})">Set to Process</a>
                              @endif
                              
                              <a class="dropdown-item" href="#" onclick="return confirm('Are you sure want to remove this action?') && delete_admission({{$admission['id_admission']}})">Delete</a>
                            </div>
                          </td>
                          <td class="text-center">{{$admission['pic_analyst']}}</td>
                          <td class="text-center">
                            @if($admission['finish_admission'] != '')
                              {{date_format(date_create($admission['finish_admission']), "H:i")}}
                            @endif
                          </td>
                          <td class="text-center">{{$admission['action_analyst']}}</td>
                          <td style="white-space:normal">{{$admission['remarks_analyst']}}</td>
                          <td class="text-center">{{$admission['pic_ma']}}</td>
                          <td>{{$admission['remarks_ma']}}</td>
                        </tr>
                        @endforeach
                      </tbody> --}}
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="form-admission" class="col-md-3 d-none" style="left: 300px">
          <h2 class="h4 mb-3 d-inline invisible">{{$title}}</h2>
          <p id="" class="text-muted invisible">Demo</p>
          <div class="card shadow">
            <div class="card-body form-space">
              <form id="form-input-cj" action="" class="">
                <p class="mb-3 mt-1 "><strong>Input Admission - As CJ</strong><a href="#" id="hide-form-cj" class="float-right text-decoration-none" onclick=""><span class="fe fe-16 fe-x mt-2"></span></a></p>
                <div class="form-group mb-3">
                  <label for="example-date">Date</label>
                  <input class="form-control" id="input_date" type="date" name="date">
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Member Name</label>
                  <input type="text" id="input_membername" class="form-control" name="member_name">
                  <input type="text" id="input_idadmission" class="form-control d-none" name="id_admission">
                </div>
                <div class="form-group mb-3">
                  <label for="example-select">Client</label>
                  <select id="input_client" class="form-control">
                    @foreach ($client as $c)
                      <option value="{{$c['id_client']}}">{{$c['fullname']}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label for="example-time">Time Distribution</label>
                  <input id="input_timedistribution" class="form-control" type="time" name="time_distribution">
                </div>
                <div class="form-group mb-3">
                  <label for="example-time">Time RCV Email</label>
                  <input id="input_timercv" class="form-control" name="time_rcv_email" type="time" name="time">
                </div>
                <div class="form-group mb-3">
                  <label for="example-textarea">Remarks</label>
                  <textarea id="input_remarksinfo" class="form-control" name="remarks_info" rows="3"></textarea>
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">No Claim</label>
                  <input type="text" id="input_noclaim" name="no_claim" class="form-control">
                </div>
                <button id="btn-updateadmission" type="button" class="btn btn-success btn-block mt-4 btn-updateadmission" onclick="update_admission()">Update</button>
              </form>
              <form id="form-input-analyst" action="" class="">
                <p class="mb-3 mt-1 "><strong>Input Admission - As Analyst<a href="#" id="hide-form-analyst" class="float-right text-decoration-none" onclick=""><span class="fe fe-16 fe-x mt-2"></span></a></p>
                <div class="form-group mb-3">
                  <label for="simpleinput">PIC Analyst</label>
                  <input type="text" class="form-control form-control-sm" id="input_picanalyst" name="pic_analyst" value="{{Session::get('username')}}" readonly>
                </div>
                <div class="form-group mb-3">
                  <label for="example-select">Action Analyst</label>
                  <select class="form-control" id="input_actionanalyst">
                    <option value="0" disabled selected>Please Select</option>
                    @foreach ($status as $s)
                      @if($s['status_type'] == "Action Analyst")
                        <option value="{{$s['status_name']}}">{{$s['status_name']}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label for="example-time">Action Remarks</label>
                  <textarea class="form-control" id="input_actionremarks" name="action_remarks" rows="3"></textarea>
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">PIC MA</label>
                  {{-- <input type="text" id="input_picma" class="form-control" name="pic_ma"> --}}
                  <select name="pic_ma" class="form-control" id="input_picma">
                    <option value="" disabled selected>Please Select</option>
                    @foreach ($user as $u)
                      @if($u['level'] == "3")
                        <option value="{{$u['full_name']}}">{{$u['full_name']}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label for="example-textarea">Remarks MA</label>
                  <textarea class="form-control" id="input_remakrsma" name="remarks_ma" rows="3"></textarea>
                </div>
                <button id="btn-updateadmission-analyst" type="button" class="btn btn-secondary btn-block mt-4 btn-updateadmission" onclick="update_admission('update')">Update</button>
                <button id="btn-updateadmission-analyst" type="button" class="btn btn-success btn-block mt-1 btn-updateadmission-finish" onclick="update_admission('finish')">Set To Finish</button>
              </form>
            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div> <!-- /.col -->
      </div> <!-- end section -->
    </div> <!-- .col-12 -->
  </div> <!-- .row -->
</div> <!-- .container-fluid -->

<script>
  var filter_daterange = function(){
    start = $("#datestart").text();
    end = $("#dateend").text();

    var post_data = {
                    'date_start' : start,
                    'date_end' : end,
                    };

    $("#table-data-admission").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/admission/filter') }}",
            type: "POST",
            data :  post_data,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);

              $.ajax({url: "{{ url('/admission/refresh_status') }}",
                type: "GET",

                success : function(response){
                  $('#summary-space').html(response);
                }
              });
            }
          });
  }
</script>

<script>
  var refresh_admission = function(){
    $("#table-data-admission").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/admission/refresh') }}",
            type: "GET",

            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);

              $.ajax({url: "{{ url('/admission/refresh_ft') }}",
                type: "GET",

                success : function(response){
                  $('#daterange-admissions').html(response);

                  $.ajax({url: "{{ url('/admission/refresh_status') }}",
                    type: "GET",

                    success : function(response){
                      $('#summary-space').html(response);
                    }
                  });
                }
              });
            }
          });
  }
</script>

<script>
  var show_formadd = function(){  
    $("#form-add").slideDown(400);
    $("#add_date").val('');
    $("#add_membername").val('');
    $("#add_client").val('');
    $("#add_category option[value='0']").prop('selected', true);
    $("#add_rcvemail").val('');
    $("#add_remarks").val('');
    $("#add_noclaim").val('');
  };

  var hide_formadd = function(){  
    $("#form-add").slideUp(400);
  };
</script>

<script type="text/javascript">
  var store_admission = function(){ 
    var post_data = {
                    'date_start' : $("#add_date").val(),
                    'category' : $("#add_category").val(),
                    'member_name' : $("#add_membername").val(),
                    'client_id' : $("#add_client").val(),
                    // 'time_distribution' : $("#add_distribution").val(),
                    'time_rcv_email' : $("#add_rcvemail").val(),
                    'remarks_info' : $("#add_remarks").val(),
                    'no_claim' : $("#add_noclaim").val(),
                    'pic_id' : $("#add_pic").val(),
                    'status_admission' : $("#add_status").val()
                    };

    // console.log(post_data);
    $("#table-data-admission").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/admission/store') }}",
            type: "POST",
            data :  post_data,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);
              $("#form-add").slideUp(400);
              $("html, body").animate({ scrollTop: $('html,body').height() }, 2000);

              $.ajax({url: "{{ url('/admission/refresh_status') }}",
                type: "GET",

                success : function(response){
                  $('#summary-space').html(response);
                }
              });

              setTimeout(function() {
                $(".tbody-admission").removeClass("table-success");
              }, 3000);
            }
          });
  }; 
</script>

<script type="text/javascript">
  var input_admission = function(id_admission, operator){  
    if(operator == 'cj'){
      $("#form-input-cj" ).removeClass('d-none');
      $("#form-input-analyst" ).addClass('d-none');
      $('#hide-form-cj').attr('onclick', "hide_form("+id_admission+", '"+operator+"')");
      $('#table-space').animate( { scrollLeft: '560' }, 900); 
      $('.btn-updateadmission').attr('onclick', "update_admission("+id_admission+", '"+operator+"', '0')");
    }else{
      $("#form-input-cj" ).addClass('d-none');
      $("#form-input-analyst" ).removeClass('d-none');
      $('#hide-form-analyst').attr('onclick', "hide_form("+id_admission+", '"+operator+"')");
      $('#table-space').animate( { scrollLeft: '1200' }, 900); 
      $('.btn-updateadmission').attr('onclick', "update_admission("+id_admission+", '"+operator+"', 'process')");
      $('.btn-updateadmission-finish').attr('onclick', "update_admission("+id_admission+", '"+operator+"', 'finish')");
    }

    $(".tbody-admission").removeClass("table-success");
    $("#row-"+id_admission).addClass("table-success");
    $("#form-admission" ).animate({"left":"0px"}, 400).removeClass('d-none');
    $("#form-operator" ).html(operator);
    $("#table-admission").removeClass("col-md-12");
    $("#table-admission").addClass("col-md-9");
    
    var post_data = {'id_admission' : id_admission,
                    'operator' : operator
                    };

    if(operator == 'cj'){
      $.ajax({type : 'POST',
              url : "/admission/get_admission",
              data :  post_data,
              success : function(data){
                console.log(data);
                
                var obj = JSON.parse(data);
                $('#input_date').val(obj["data"]["date_start"]);
                $('#input_idadmission').val(obj["data"]["id_admission"]);
                $('#input_membername').val(obj["data"]["member_name"]);
                $("#input_client option[value='"+obj["data"]["client_id"]+"']").prop('selected', true);
                $('#input_timedistribution').val(obj["data"]["time_distribution"]);
                $('#input_timercv').val(obj["data"]["time_rcv_email"]);
                $('#input_remarksinfo').val(obj["data"]["remarks_info"]);
                $('#input_noclaim').val(obj["data"]["no_claim"]);
              }
            });
    }else{
      $.ajax({type : 'POST',
              url : "/admission/get_admission",
              data :  post_data,
              success : function(data){
                console.log(data);
                
                var obj = JSON.parse(data);
                $("#input_statusadmission option[value='"+obj["data"]["status_admission"]+"']").prop('selected', true);
                if(obj["data"]["pic_analyst"] != null){
                  $('#input_picanalyst').val(obj["data"]["pic_analyst"]);
                }else{
                  $('#input_picanalyst').val(sess_username);
                }
                // $('#input_finishtime').val(obj["data"]["finish_admission"]);
                $("#input_actionanalyst option[value='"+obj["data"]["action_analyst"]+"']").prop('selected', true);
                $('#input_actionremarks').val(obj["data"]["remarks_analyst"]);
                $('#input_picma').val(obj["data"]["pic_ma"]);
                $('#input_remakrsma').val(obj["data"]["remarks_ma"]);
              }
            });
    }
  }; 

  var set_process = function(id){ 
    $("#table-data-admission").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "admission/set_to_process/"+id,
            type: "GET",

            success : function(response){
              // alert(response);
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);
            }
          });
  }
</script>

<script type="text/javascript">
  var update_admission = function(id, operator, mode){ 
    if(operator == 'cj'){
      var post_data = {
                    'date_start' : $("#input_date").val(),
                    'member_name' : $("#input_membername").val(),
                    'id_admission' : $("#input_idadmission").val(),
                    'client_id' : $("#input_client").val(),
                    'time_distribution' : $("#input_timedistribution").val(),
                    'time_rcv_email' : $("#input_timercv").val(),
                    'remarks_info' : $("#input_remarksinfo").val(),
                    'no_claim' : $("#input_noclaim").val(),
                    'operator' : operator
                    };
    }else{
      status = '';
      if(mode == 'process'){
        status = 'Analyst Process';
      }else{
        status = 'RCV By Analyst';
      }

      var post_data = {
                    'id_admission' : id,
                    'picanalyst' : $("#input_picanalyst").val(),
                    'actionanalyst' : $("#input_actionanalyst").val(),
                    'actionremarks' : $("#input_actionremarks").val(),
                    'picma' : $("#input_picma").val(),
                    'remakrsma' : $("#input_remakrsma").val(),
                    'status_admission' : status,
                    'mode' : mode,
                    'operator' : operator
                    };
    }

    $("#table-data-admission").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/admission/update') }}",
            type: "POST",
            data :  post_data,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);
              hide_form(id, operator);
              $("#row-"+id).addClass('table-success');

              $.ajax({url: "{{ url('/admission/refresh_status') }}",
                type: "GET",

                success : function(response){
                  $('#summary-space').html(response);
                }
              });

              setTimeout(function() {
                $("#row-"+id).removeClass("table-success");
              }, 3000);
            }
          });
  }; 
</script>

<script type="text/javascript">
  var delete_admission = function(id){ 
    $("#table-data-admission").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({type: "GET",
            url: "/admission/delete/"+id,
            
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);

              $.ajax({url: "{{ url('/admission/refresh_status') }}",
                type: "GET",

                success : function(response){
                  $('#summary-space').html(response);
                }
              });
            }
          });
  }; 
</script>

<script type="text/javascript">
  var hide_form = function(id_admission, operator){  
    if(operator == 'cj'){
      $("#form-input-cj" ).addClass('d-none');
      $('#table-space').animate( { scrollLeft: '200' }, 900); 
    }else{
      $("#form-input-analyst" ).addClass('d-none');
      $("#input_actionanalyst option[value='0']").prop('selected', true);
    }

    setTimeout(function() {
      $("#row-"+id_admission).removeClass("table-success");
    }, 3000);
    
    $("#form-admission" ).animate({"left":"300px"}, 400).addClass('d-none');
    $("#table-admission").addClass("col-md-12");
    $("#table-admission").removeClass("col-md-9");      
  }; 
</script>

<script>
  var filter_status = function(status){
    // alert(status);
    var post_data = {
                    'status' : status,
                    };

    $("#table-data-admission").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/admission/filter_status') }}",
            type: "POST",
            data :  post_data,
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);
    
              if(status == 'Send To Analyst'){
                $("#filter_status_opt1").addClass("text-primary");
                $("#filter_status_opt1 span").addClass("fe");
                $("#filter_status_opt1 span").addClass("fe-check");
              }else if(status == 'Analyst Process'){
                $("#filter_status_opt2").addClass("text-primary");
                $("#filter_status_opt2 span").addClass("fe");
                $("#filter_status_opt2 span").addClass("fe-check");
              }else if(status == 'RCV By Analyst'){
                $("#filter_status_opt3").addClass("text-primary");
                $("#filter_status_opt3 span").addClass("fe");
                $("#filter_status_opt3 span").addClass("fe-check");
              }else{
                $("#filter_status_opt4").addClass("text-primary");
                $("#filter_status_opt4 span").addClass("fe");
                $("#filter_status_opt4 span").addClass("fe-check");
              }
            }
          });
  }
</script>

<script>
  // $(document).ready(function(){
  //     $('#form-search').change(function(){
  //         alert("alert here");
  //     });
  // });
  
  var search_name = function(status){
    var post_data = {
                    'value' : $("#form_search").val(),
                    };

    $("#table-data-admission").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/admission/search') }}",
            type: "POST",
            data :  post_data,
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);
            }
          });
  }
</script>
@endsection

@section('addon-page')

<script>
  $('#dateend').on('DOMSubtreeModified',function(){
    filter_daterange();
    status_date = $('#daterange-admissions').text();
    $('#subtitle-date').html(status_date);
  });
</script>

@if (Session::has('datestart_admission'))
  <script>
    const ds = new Date("{{Session::get('datestart_admission')}}");
    const de = new Date("{{Session::get('dateend_admission')}}");
    moment_start =moment(ds);
    moment_end =moment(de);
  </script>
@else
  <script>
    moment_start = moment().subtract(2, 'days');;
    moment_end =moment();
  </script>  
@endif

@endsection