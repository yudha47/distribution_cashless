@extends('layouts.main')

@section('container')

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="row">
        <div id="table-action" class="col-md-12">
          <div hidden id="type_action">{{$title}}</div>
          <h2 id="title" class="h4 mb-3 d-inline text-capitalize">{{$title}}</h2>
          <p id="subtitle-date" class="text-muted"></p>
          <div class="card shadow">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="toolbar row mb-2">
                    <div id="summary-space" class="col-md">
                    </div>
                    <div class="col-md-auto ml-auto text-right">
                      <form class="form-inline">
                        <button id="btn-formadd" type="button" class="btn btn-sm btn-primary mr-2 text-capitalize" onclick="show_formadd()">
                          <span class="fe fe-plus"></span> 
                          {{$title}}
                        </button>
                        <div class="form-group d-none d-lg-inline border rounded py-1 px-2 ">
                          <label for="reportrange" class="sr-only">Date Ranges</label>
                          <div id="reportrange" class="">
                            <span id="daterange" class="small"></span>
                            <span id="datestart" class="small d-none"></span>
                            <span id="dateend" class="small d-none"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <button type="button" class="btn btn-sm border ml-2" onclick="refresh_action()">
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
                        <div class="form-group col-md-3">
                          <label for="inputCity">Member Name</label>
                          <input type="text" class="form-control form-control-sm" id="add_membername">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputCity">Client</label>
                          <select name="" class="form-control form-control-sm select2" id="add_client">
                            @foreach ($client as $c)
                              <option value="{{$c['id_client']}}">{{$c['fullname']}}</option>
                            @endforeach
                          </select>
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
                            @foreach ($category_action as $ca)
                              <option value="{{$ca['category_name']}}">{{$ca['category_name']}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputCity">PIC</label>
                          <input type="text" class="form-control form-control-sm" id="add_pic" value="{{Session::get('username')}}" readonly>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputCity">Status</label>
                          <input type="text" class="form-control form-control-sm" id="add_status" value="Send To CJ" readonly>
                        </div>
                      </div>
                      <button type="button" class="btn btn-sm btn-primary mb-3" onclick="input_action()">Save</button>
                      <button type="button" class="btn btn-sm btn-secondary mb-3 ml-1" onclick="hide_formadd()">Cancel</button>
                    </div>
                  </div>
                  <!-- table -->
                  <div id="table-space" class="scrollbar-info" style="overflow-x: scroll;">
                    <div class="d-flex justify-content-center">
                      <div class="loader d-none"></div>
                    </div>
                    <table id="table-data-action" class="table table-hover table-bordered" style="table-layout: auto;">
                      <!-- table data -->
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="form-action" class="col-md-3 d-none" style="left: 300px">
          <h2 class="h4 mb-3 d-inline invisible">{{$title}}</h2>
          <p id="" class="text-muted invisible">Demo</p>
          <div class="card shadow">
            <div class="card-body form-space">
              <form id="form-input-analyst" action="" class="">
                <p class="mb-3 mt-1 "><strong>Input - As Analyst</strong><a href="#" id="hide-form-cj" class="float-right text-decoration-none" onclick=""><span class="fe fe-16 fe-x mt-2"></span></a></p>
                <div class="form-group mb-3">
                  <label for="example-date">Date</label>
                  <input class="form-control" id="input_date" type="date" name="date" readonly>
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Member Name</label>
                  <input type="text" id="input_membername" class="form-control" name="member_name">
                  <input type="text" id="input_idaction" class="form-control d-none" name="id_admission">
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
                  <input id="input_timedistribution" class="form-control" type="time" name="time_distribution" readonly>
                </div>
                <div class="form-group mb-3">
                  <label for="example-textarea">Remarks</label>
                  <textarea id="input_remarksinfo" class="form-control" name="remarks_info" rows="3"></textarea>
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">No Claim</label>
                  <input type="text" id="input_noclaim" name="no_claim" class="form-control">
                </div>
                <button id="btn-updateaction" type="button" class="btn btn-success btn-block mt-4 btn-updateaction" onclick="update_action()">Update</button>
              </form>
              <form id="form-input-cj" action="" class="">
                <p class="mb-3 mt-1 "><strong>Input - As CJ</strong><a href="#" id="hide-form-analyst" class="float-right text-decoration-none" onclick=""><span class="fe fe-16 fe-x mt-2"></span></a></p>
                <div class="form-group mb-3">
                  <label for="simpleinput">PIC CJ</label>
                  <input type="text" class="form-control form-control-sm" id="input_piccj" name="pic_cj" value="{{Session::get('username')}}" readonly>
                </div>
                <div class="form-group mb-3">
                  <label for="example-time">Action Remarks</label>
                  <textarea class="form-control" id="input_actionremarks" name="action_remarks" rows="3"></textarea>
                </div>
                <button id="btn-updateaction-cj" type="button" class="btn btn-secondary btn-block mt-4 btn-updateaction" onclick="update_action('update')">Update</button>
              </form>
            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div> <!-- /.col -->
      </div> <!-- end section -->
    </div> <!-- .col-12 -->
  </div> <!-- .row -->
</div> <!-- .container-fluid -->

<script>
  const type_action = document.querySelector('div[id=type_action]').textContent
  console.log("type_action : "+type_action);
</script>

<script>
  var filter_daterange = function(start, end){
    $('#reportrange #daterange').html(moment(start).format('MMMM D, YYYY') + ' - ' + moment(end).format('MMMM D, YYYY'));
    var date_start = moment(start).format('YYYY-MM-DD');
    var date_end = moment(end).format('YYYY-MM-DD')
    
    status_date = $('#daterange').text();
    $('#subtitle-date').html(status_date);
    // console.log(type_action);
    // start = $("#datestart").text();
    // end = $("#dateend").text();

    var post_data = {
                    'date_start' : date_start,
                    'date_end' : date_end,
                    'type_action' : type_action
                    };

    var post_data2 = {
                    'type_action' : type_action
                    };

    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/instruction-cj/filter') }}",
            type: "POST",
            data :  post_data,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);

              $.ajax({url: "{{ url('/instruction-cj/refresh_status') }}",
                type: "POST",
                data :  post_data2,

                success : function(response){
                  $('#summary-space').html(response);
                }
              });
            }
          });
  }
</script>

<script>
  var refresh_action = function(){
    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    var post_data = {
                    'type_action' : type_action
                    };

    $.ajax({url: "{{ url('/instruction-cj/refresh') }}",
            type: "POST",
            data: post_data,

            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);

              $.ajax({url: "{{ url('/instruction-cj/refresh_ft') }}",
                type: "POST",
                data: post_data,

                success : function(response){
                  $('#daterange').html(response);

                  $.ajax({url: "{{ url('/instruction-cj/refresh_status') }}",
                    type: "POST",
                    data: post_data,

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
  var input_action = function(){ 
    var post_data = {
                    'date_start' : $("#add_date").val(),
                    'category' : $("#add_category").val(),
                    'member_name' : $("#add_membername").val(),
                    'client_id' : $("#add_client").val(),
                    'remarks_info' : $("#add_remarks").val(),
                    'no_claim' : $("#add_noclaim").val(),
                    'pic_id' : $("#add_pic").val(),
                    'status' : $("#add_status").val()
                    };

                    console.log(post_data);

    var post_data2 = {
                    'type_action' : type_action
                    };

    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/instruction-cj/input') }}",
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

              $.ajax({url: "{{ url('/instruction-cj/refresh_status') }}",
                type: "POST",

                success : function(response){
                  $('#summary-space').html(response);
                }
              });

              setTimeout(function() {
                $(".tbody-action").removeClass("table-success");
              }, 3000);
            }
          });
  }; 
</script>

<script type="text/javascript">
  var set_process = function(id_action, mode){ 
    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    var post_data = {'id_action' : id_action,
                    'mode' : mode,
                    };

    $.ajax({url: "{{ url('/instruction-cj/set_to_process') }}",
            type: "POST",
            data :  post_data,
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);

              $.ajax({url: "{{ url('/instruction-cj/refresh_status') }}",
                type: "POST",

                success : function(response){
                  $('#summary-space').html(response);
                }
              });
            }
          });
  }
  
  var form_update = function(id_action, operator){  
    if(operator == 'analyst'){
      $("#form-input-analyst" ).removeClass('d-none');
      $("#form-input-cj" ).addClass('d-none');
      $('#hide-form-cj').attr('onclick', "hide_form("+id_action+", '"+operator+"')");
      $('#table-space').animate( { scrollLeft: '560' }, 900); 
      $('.btn-updateaction').attr('onclick', "update_action("+id_action+", '"+operator+"', '0')");
    }else{
      $("#form-input-analyst" ).addClass('d-none');
      $("#form-input-cj" ).removeClass('d-none');
      $('#hide-form-analyst').attr('onclick', "hide_form("+id_action+", '"+operator+"')");
      $('#table-space').animate( { scrollLeft: '1000' }, 900); 
      $('.btn-updateaction').attr('onclick', "update_action("+id_action+", '"+operator+"', 'process')");
    }

    $(".tbody-action").removeClass("table-success");
    $("#row-"+id_action).addClass("table-success");
    $("#form-action" ).animate({"left":"0px"}, 400).removeClass('d-none');
    $("#form-operator" ).html(operator);
    $("#table-action").removeClass("col-md-12");
    $("#table-action").addClass("col-md-9");

    var post_data = {
                      'id_action' : id_action,
                    };

    $.ajax({type : 'POST',
              url : "/instruction-cj/get_action",
              data :  post_data,
              success : function(data){
                var obj = JSON.parse(data);

                if(operator == 'analyst'){
                  $('#input_date').val(obj["data"]["date"]);
                  $('#input_idaction').val(obj["data"]["id_action"]);
                  $('#input_membername').val(obj["data"]["member_name"]);
                  $("#input_client option[value='"+obj["data"]["client_id"]+"']").prop('selected', true);
                  $('#input_timedistribution').val(moment(obj["data"]["time_distribution"]).format('HH:MM'));
                  $('#input_remarksinfo').val(obj["data"]["remarks_info"]);
                  $('#input_noclaim').val(obj["data"]["no_claim"]);
                }else{
                  if(obj["data"]["pic_analyst"] != null){
                    $('#input_piccj').val(obj["data"]["pic_analyst"]);
                  }else{
                    $('#input_piccj').val(sess_username);
                  }
                  $("#input_actionanalyst option[value='"+obj["data"]["action_analyst"]+"']").prop('selected', true);
                  $('#input_actionremarks').val(obj["data"]["remarks_analyst"]);
                }
              }
    })
  }; 

  var update_action = function(id, operator, mode){ 
    if(operator == 'analyst'){
      var post_data = {
                    'member_name' : $("#input_membername").val(),
                    'id_action' : $("#input_idaction").val(),
                    'client_id' : $("#input_client").val(),
                    'time_receive' : $("#input_timereceive").val(),
                    'remarks_info' : $("#input_remarksinfo").val(),
                    'no_claim' : $("#input_noclaim").val(),
                    'operator' : operator,
                    'type_action' : type_action
                    };
    }else{
      status = '';
      post_data;
      if(mode == 'process'){
        status = 'CJ Process';

        var post_data = {
                      'id_action' : id,
                      'picanalyst' : $("#input_piccj").val(),
                      'actionremarks' : $("#input_actionremarks").val(),
                      'status' : status,
                      'mode' : mode,
                      'operator' : operator
                      };
      }else{
        status = 'RCV By CJ';

        var post_data = {
                      'id_action' : id,
                      'picanalyst' : $("#input_piccj").val(),
                      'actionremarks' : $("#input_actionremarks").val(),
                      'status' : status,
                      'mode' : mode,
                      'operator' : operator
                      };
      }
    }

    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/instruction-cj/update') }}",
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

              if(operator != 'cj'){
                $('#table-space').animate( { scrollLeft: '1200' }, 900); 
              }

              var nav = $('#row'+id);
              $('html').animate( { scrollTop: '500' }, 900); 

              $.ajax({url: "{{ url('/instruction-cj/refresh_status') }}",
                type: "POST",
                data :  post_data2,

                success : function(response1){
                  $('#summary-space').html(response1);
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
  var delete_instruction = function(id){ 
    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    var post_data = {
                    'id_action' : id
                    };

    $.ajax({type: "POST",
            url: "/instruction-cj/delete/",
            data :  post_data,
            
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);

              $.ajax({url: "{{ url('/instruction-cj/refresh_status') }}",
                type: "POST",
                data :  post_data,

                success : function(response){
                  $('#summary-space').html(response);
                }
              });
            }
          });
  }; 
</script>

<script type="text/javascript">
  var hide_form = function(id_action, operator){  
    if(operator == 'cj'){
      $("#form-input-cj" ).addClass('d-none');
      $('#table-space').animate( { scrollLeft: '200' }, 900); 
    }else{
      $("#form-input-analyst").addClass('d-none');
      $("#input_actionanalyst option[value='0']").prop('selected', true);
    }

    setTimeout(function() {
      $("#row-"+id_action).removeClass("table-success");
    }, 3000);
    
    $("#form-action" ).animate({"left":"300px"}, 400).addClass('d-none');
    $("#table-action").addClass("col-md-12");
    $("#table-action").removeClass("col-md-9");      
  }; 
</script>

<script>
  var filter_status = function(status, mode){
    var post_data = {
                    'mode' : mode,
                    'status' : status
                    };

    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/instruction-cj/filter_status') }}",
            type: "POST",
            data :  post_data,
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);

              if(mode == 2){
                if(status == 'Send To CJ'){
                  $("#filter_status_opt1").addClass("text-primary");
                  $("#filter_status_opt1 span").addClass("fe");
                  $("#filter_status_opt1 span").addClass("fe-check");
                }else if(status == 'CJ Process'){
                  $("#filter_status_opt2").addClass("text-primary");
                  $("#filter_status_opt2 span").addClass("fe");
                  $("#filter_status_opt2 span").addClass("fe-check");
                }else if(status == 'RCV By CJ'){
                  $("#filter_status_opt3").addClass("text-primary");
                  $("#filter_status_opt3 span").addClass("fe");
                  $("#filter_status_opt3 span").addClass("fe-check");
                }else{
                  $("#filter_status_opt4").addClass("text-primary");
                  $("#filter_status_opt4 span").addClass("fe");
                  $("#filter_status_opt4 span").addClass("fe-check");
                }
              }
            }
          });
  }
</script>

<script>
  var search_name = function(status){
    var post_data = {
                    'value' : $("#form_search").val()
                    };

    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/instruction-cj/search') }}",
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
    // filter_daterange();
    // status_date = $('#daterange').text();
    // $('#subtitle-date').html(status_date);
  });
</script>

@if (Session::has('datestart_cj'))
  <script>
    const ds = new Date("{{Session::get('datestart_cj')}}");
    const de = new Date("{{Session::get('dateend_cj')}}");
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

@section('js-last')
@if (isset($data_notif))
<script>
  // $('#dateend').on('DOMSubtreeModified',function(){
  //   filter_daterange();
  //   status_date = $('#daterange').text();
  //   $('#subtitle-date').html(status_date);
  // });

  var status = @json($notif_status);
  var mode = @json($data_notif);
  console.log(mode);
  filter_status(status, mode);
</script>
@else
@endif
@endsection