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
                          <button type="button" class="btn btn-sm border ml-2" onclick="refresh_admission()">
                            <span class="fe fe-refresh-ccw fe-16 text-muted"></span>
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div id="form-add" class="col-md-12 ml-auto pt-2 my-2 border" style="display: none">
                    <div>
                      {{-- <div class="form-row"> --}}
                      <form id="form_add_action" class="form-row">
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
                          <input type="text" class="form-control form-control-sm" id="add_membername" required>
                          <input type="text" class="form-control form-control-sm invisible" id="add_type" value="{{$title}}">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputCity">Client</label>
                          <select name="" class="form-control form-control-sm select2" id="add_client" required>
                            <option value="0" disabled selected>Please Select</option>
                            @foreach ($client as $c)
                              <option value="{{$c['id_client']}}">{{$c['fullname']}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-1">
                          <label for="inputCity">RCV Email</label>
                          <input id="add_receive" class="form-control form-control-sm" type="time" name="time_receive" required>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputCity">Remarks</label>
                          <textarea name="" class="form-control form-control-sm" id="add_remarks" rows="1" disabled="true"></textarea>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputCity">No Claim</label>
                          <input type="text" class="form-control form-control-sm" id="add_noclaim" required>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputCity">Category</label>
                          <select name="" class="form-control form-control-sm" id="add_category" required onchange="show_remarks_info()">
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
                          <input type="text" class="form-control form-control-sm" id="add_status" value="Send To Analyst" readonly>
                        </div>
                      </form>
                    {{-- </div> --}}
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
              <form id="form-input-cj" action="" class="">
                <p class="mb-3 mt-1 "><strong>Input - As CJ</strong><a href="#" id="hide-form-cj" class="float-right text-decoration-none" onclick=""><span class="fe fe-16 fe-x mt-2"></span></a></p>
                <div class="form-group mb-3">
                  <label for="example-date">Date</label>
                  <input class="form-control" id="input_date" type="date" name="date" readonly required>
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Member Name</label>
                  <input type="text" id="input_membername" class="form-control" name="member_name" required>
                  <input type="text" id="input_idaction" class="form-control d-none" name="id_admission">
                </div>
                <div class="form-group mb-3">
                  <label for="example-select">Client</label>
                  <select id="input_client" class="form-control" required>
                    @foreach ($client as $c)
                      <option value="{{$c['id_client']}}">{{$c['fullname']}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label for="example-time">Time Distribution</label>
                  <input id="input_timedistribution" class="form-control" type="time" name="time_distribution" readonly required>
                </div>
                <div class="form-group mb-3">
                  <label for="example-time">Time RCV Email</label>
                  <input id="input_timereceive" class="form-control" name="time_receive" type="time" name="time_receive" required>
                </div>
                <div class="form-group mb-3">
                  <label for="example-textarea">Remarks</label>
                  <textarea id="input_remarksinfo" class="form-control" name="remarks_info" rows="3"></textarea>
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">No Claim</label>
                  <input type="text" id="input_noclaim" name="no_claim" class="form-control" required>
                </div>
                <button id="btn-updateaction" type="button" class="btn btn-success btn-block mt-4 btn-updateaction" onclick="update_admission()">Update</button>
              </form>
              <form id="form-input-analyst" action="" class="">
                <p class="mb-3 mt-1 "><strong>Input - As Analyst</strong><a href="#" id="hide-form-analyst" class="float-right text-decoration-none" onclick=""><span class="fe fe-16 fe-x mt-2"></span></a></p>
                <div class="form-group mb-3">
                  <label for="simpleinput">PIC Analyst</label>
                  <input type="text" class="form-control form-control-sm" id="input_picanalyst" name="pic_analyst" value="{{Session::get('username')}}" readonly>
                </div>
                <div class="form-group mb-3">
                  <label for="example-select">Action Analyst</label>
                  <select class="form-control" id="input_actionanalyst" required>
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
                  <textarea class="form-control" id="input_actionremarks" name="action_remarks" rows="3" required="true"></textarea>
                  <select name="" id="input_actionremarks_choice" class="form-control d-none" onchange="show_remarks_other()">
                    <option value="0" disabled selected>Please Select</option>
                    <option>Review MA</option>
                    <option>Medis Lanjutan</option>
                    <option>Penunjang tidak lengkap</option>
                    <option>Eskalasi Client</option>
                    <option>Revisi Billing</option>
                    <option>Rincian Billing</option>
                    <option>Other</option>
                  </select>
                  <textarea class="form-control mt-3 d-none" id="input_actionremarks_other" name="action_remarks_other" rows="3"></textarea>
                  </div>
                <div class="custom-control custom-switch mt-3">
                  <input type="checkbox" class="custom-control-input" id="switch_cj">
                  <label class="custom-control-label" for="switch_cj">Send Instruction To Customer Journey</label>
                </div>
                <div class="form-group mb-3 mt-3 d-none" id="remarks_to_cj">
                  <label for="example-time">Remarks To CJ</label>
                  <textarea class="form-control" id="input_remarks_to_cj" name="remarks_to_cj" rows="3"></textarea>
                </div>
                <button id="btn-updateaction-analyst" type="button" class="btn btn-secondary btn-block mt-3 btn-updateaction" onclick="update_admission('update')">Update</button>
              </form>
              <form id="form-input-ma" action="" class="">
                <p class="mb-3 mt-1 "><strong>Input - As Medical Advisor</strong><a href="#" id="hide-form-ma" class="float-right text-decoration-none" onclick=""><span class="fe fe-16 fe-x mt-2"></span></a></p>
                <div class="form-group mb-3">
                  <label for="simpleinput">PIC MA</label>
                  <input type="text" class="form-control form-control-sm" id="input_picma" value="{{Session::get('username')}}" readonly required>
                </div>
                <div class="form-group mb-3">
                  <label for="example-textarea">Remarks MA</label>
                  <textarea class="form-control" id="input_remakrsma" name="remarks_ma" rows="3" required></textarea>
                </div>
                <button id="btn-updateaction-ma" type="button" class="btn btn-secondary btn-block mt-4 btn-updateaction" onclick="update_admission('update')">Send To Analyst</button>
              </form>
              <form id="form-input-send-cj" action="" class="">
                <p class="mb-3 mt-1 "><strong>Send To Customer Journey</strong><a href="#" id="hide-form-send-cj" class="float-right text-decoration-none" onclick=""><span class="fe fe-16 fe-x mt-2"></span></a></p>
                <div class="form-group mb-3">
                  <label for="simpleinput">PIC Analyst</label>
                  <input type="text" class="form-control form-control-sm" id="sendcj_pic" value="{{Session::get('username')}}" readonly>
                </div>
                <div class="form-group mb-3">
                  <label for="example-textarea">Remarks MA</label>
                  <textarea class="form-control" id="sendcj_remakrs" name="sendcj_remakrs" rows="3"></textarea>
                </div>
                <button id="btn-send-tocj" type="button" class="btn btn-secondary btn-block mt-4 btn-send-tocj" onclick="send_to_cj()">Send To CJ</button>
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
  var send_instruction_cj = '';
</script>

<script>
  var filter_daterange = function(start, end){
    $('#reportrange #daterange').html(moment(start).format('MMMM D, YYYY') + ' - ' + moment(end).format('MMMM D, YYYY'));
    var date_start = moment(start).format('YYYY-MM-DD');
    var date_end = moment(end).format('YYYY-MM-DD')
    
    status_date = $('#daterange').text();
    $('#subtitle-date').html(status_date);

    var post_data = {
                    'date_start' : date_start,
                    'date_end' : date_end,
                    'type_action' : type_action
                    };

    var post_data2 = {
                    'type_action' : type_action
                    };                  

    console.log(type_action+" - "+start+" - "+end);

    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/action/filter') }}",
            type: "POST",
            data :  post_data,
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);

              $.ajax({url: "{{ url('/action/refresh_status') }}",
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
  var refresh_admission = function(){
    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    var post_data = {
                    'type_action' : type_action
                    };

    $.ajax({url: "{{ url('/action/refresh') }}",
            type: "POST",
            data: post_data,

            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);

              $.ajax({url: "{{ url('/action/refresh_ft') }}",
                type: "POST",
                data: post_data,

                success : function(response){
                  $('#daterange').html(response);

                  $.ajax({url: "{{ url('/action/refresh_status') }}",
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

  var show_remarks_info = function(){
    if($("#add_category").val() == 'Others'){
      $('#add_remarks').attr('disabled', false);
      $('#add_remarks').attr('required', true);
    }else{
      $('#add_remarks').attr('disabled', true);
      $('#add_remarks').attr('required', false);
    }
  }
</script>

<script type="text/javascript">
  var input_action = function(){ 
    var form = document.getElementById('form_add_action');

    for(var i=0; i < form.elements.length; i++){
      if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
        alert('There are some required fields!');
        return false;
      }

      if($("#add_category").val() === null){
        alert('There are some required fields!');
        return false;
      }
    }

    remarks_info = '';
    if($("#add_category").val() == 'Others'){
      remarks_info = $("#add_remarks").val();
    }else{
      remarks_info = $("#add_category").val();
    }

    var post_data = {
                    'date_start' : $("#add_date").val(),
                    'type_action' : $("#add_type").val(),
                    'category' : $("#add_category").val(),
                    'member_name' : $("#add_membername").val(),
                    'client_id' : $("#add_client").val(),
                    'time_receive' : $("#add_receive").val(),
                    'remarks_info' : remarks_info,
                    'no_claim' : $("#add_noclaim").val(),
                    'pic_id' : $("#add_pic").val(),
                    'status' : $("#add_status").val()
                    };

    var post_data2 = {
                    'type_action' : type_action
                    };

    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/action/input') }}",
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

              $.ajax({url: "{{ url('/action/refresh_status') }}",
                type: "POST",
                data :  post_data2,

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
                    'type_action' : type_action
                    };

    var post_data2 = {
                    'type_action' : type_action
                    };

    if(mode == 1){
      $.ajax({url: "{{ url('/action/check_process') }}",
        type: "POST",
        data :  post_data,
        success : function(response1){
          if(response1 == 0){
            console.log(response1);
            alert('Action has been assigned to another PIC, please refresh !!');
            refresh_admission();
          }else if(response1 > 0){
            console.log(response1);
            $.ajax({url: "{{ url('/action/set_to_process') }}",
              type: "POST",
              data :  post_data,
              success : function(response){
                $("#table-space").css("overflow-x", "scroll");
                $('#table-space').html(response);

                $.ajax({url: "{{ url('/action/refresh_status') }}",
                  type: "POST",
                  data :  post_data2,

                  success : function(response){
                    $('#summary-space').html(response);
                  }
                });
              }
            });
          }
        }
      });
    }else if(mode == 2){
      $.ajax({url: "{{ url('/action/set_to_process') }}",
        type: "POST",
        data :  post_data,
        success : function(response){
          $("#table-space").css("overflow-x", "scroll");
          $('#table-space').html(response);

          $.ajax({url: "{{ url('/action/refresh_status') }}",
            type: "POST",
            data :  post_data2,

            success : function(response){
              $('#summary-space').html(response);
            }
          });
        }
      });
    }
  }

  var send_to_cj = function(id_action){
    $("#form-input-cj" ).addClass('d-none');
    $("#form-input-analyst" ).addClass('d-none');
    $("#form-input-ma" ).addClass('d-none');
    $("#form-input-send-cj" ).removeClass('d-none');
    $('#hide-form-send-cj').attr('onclick', "hide_form("+id_action+", '-')");
    $('#table-space').animate( { scrollLeft: '1000' }, 900); 
    $('#btn-send-tocj').attr('onclick', "send_cj_proses("+id_action+", '"+type_action+"')");

    $("tr").removeClass("table-success");
    $("#row-"+id_action).addClass("table-success");
    $("#form-action" ).animate({"left":"0px"}, 400).removeClass('d-none');
    $("#table-action").removeClass("col-md-12");
    $("#table-action").addClass("col-md-9");
  }

  var send_cj_proses = function(id_action, type_action){
    alert(id_action+" --- "+type_action);
  }
  
  var form_update = function(type_action, id_action, operator){  
    if(operator == 'cj'){
      $("#form-input-cj" ).removeClass('d-none');
      $("#form-input-analyst" ).addClass('d-none');
      $("#form-input-ma" ).addClass('d-none');
      $("#form-input-send-cj" ).addClass('d-none');
      $('#hide-form-cj').attr('onclick', "hide_form("+id_action+", '"+operator+"')");
      $('#table-space').animate( { scrollLeft: '560' }, 900); 
      $('.btn-updateaction').attr('onclick', "update_action("+id_action+", '"+operator+"', '0')");
    }else if(operator == 'analyst'){
      $("#form-input-cj" ).addClass('d-none');
      $("#form-input-analyst" ).removeClass('d-none');
      $("#form-input-ma" ).addClass('d-none');
      $("#form-input-send-cj" ).addClass('d-none');
      $('#hide-form-analyst').attr('onclick', "hide_form("+id_action+", '"+operator+"')");
      $('#table-space').animate( { scrollLeft: '1000' }, 900); 
      $('.btn-updateaction').attr('onclick', "update_action("+id_action+", '"+operator+"', 'process')");
      if(type_action == 'discharge'){
        $('#input_actionanalyst').attr('onchange', "show_remarksanalyst()");
      }
    }else{
      $("#form-input-cj" ).addClass('d-none');
      $("#form-input-analyst" ).addClass('d-none');
      $("#form-input-ma" ).removeClass('d-none');
      $("#form-input-send-cj" ).addClass('d-none');
      $('#hide-form-ma').attr('onclick', "hide_form("+id_action+", '"+operator+"')");
      $('#table-space').animate( { scrollLeft: '1000' }, 900); 
      $('.btn-updateaction').attr('onclick', "update_action("+id_action+", '"+operator+"', 'process')");
    }

    $("tr").removeClass("table-success");
    $("#row-"+id_action).addClass("table-success");
    $("#form-action" ).animate({"left":"0px"}, 400).removeClass('d-none');
    $("#form-operator" ).html(operator);
    $("#table-action").removeClass("col-md-12");
    $("#table-action").addClass("col-md-9");

    var post_data = {
                      'id_action' : id_action,
                      'type_action' : type_action
                    };

    $.ajax({type : 'POST',
              url : "{{ url('/action/get_action') }}",
              data :  post_data,
              success : function(data){
                var obj = JSON.parse(data);

                if(operator == 'cj'){
                  $('#input_date').val(obj["data"]["date"]);
                  $('#input_idaction').val(obj["data"]["id_action"]);
                  $('#input_membername').val(obj["data"]["member_name"]);
                  $("#input_client option[value='"+obj["data"]["client_id"]+"']").prop('selected', true);
                  $('#input_timedistribution').val(obj["data"]["time_distribution"]);
                  $('#input_timereceive').val(obj["data"]["time_receive"]);
                  $('#input_remarksinfo').val(obj["data"]["remarks_info"]);
                  $('#input_noclaim').val(obj["data"]["no_claim"]);
                }else if(operator == 'analyst'){
                  if(obj["data"]["pic_analyst"] != null){
                    $('#input_picanalyst').val(obj["data"]["pic_analyst"]);
                  }else{
                    $('#input_picanalyst').val(sess_username);
                  }
                  $("#input_actionanalyst option[value='"+obj["data"]["action_analyst"]+"']").prop('selected', true);
                  $('#input_actionremarks').val(obj["data"]["remarks_analyst"]);
                }else{
                  if(obj["data"]["pic_ma"] != null){
                    $('#input_picma').val(obj["data"]["pic_ma"]);
                  }else{
                    $('#input_picma').val(sess_username);
                  }
                  $('#input_remakrsma').val(obj["data"]["remarks_ma"]);
                }
              }
    })
  }; 

  var show_remarksanalyst = function(){
    if($("#input_actionanalyst").val() == 'Pending Jaminan Awal'){
      $("#input_actionremarks_choice" ).removeClass('d-none');
      $("#input_actionremarks" ).addClass('d-none');
      $('#input_actionremarks').attr('required', false);
      $('#input_actionremarks_choice').attr('required', true);
    }else{
      $("#input_actionremarks_choice" ).addClass('d-none');
      $("#input_actionremarks" ).removeClass('d-none');
      $("#input_actionremarks_other" ).addClass('d-none');
      $('#input_actionremarks').attr('required', true);
      $('#input_actionremarks_choice').attr('required', false);
      $('#input_actionremarks_other').attr('required', false);
    }
  }

  var show_remarks_other = function(){
    if($("#input_actionremarks_choice").val() == 'Other'){
      $("#input_actionremarks_other" ).removeClass('d-none');
      $('#input_actionremarks_other').attr('required', true);
    }else{
      $("#input_actionremarks_other" ).addClass('d-none');
      $('#input_actionremarks_other').attr('required', false);
    }
  }

  var update_action = function(id, operator, mode){ 
    var form = document.getElementById('form-input-'+operator);

    for(var i=0; i < form.elements.length; i++){
      if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
        alert('There are some required fields!');
        return false;
      }
    }
    if(operator == 'analyst'){
      if($("#input_actionanalyst").val() === null){
        alert('There are some required fields!');
        return false;
      }
    }

    var post_data2 = {
                    'type_action' : type_action
                    };

    if(operator == 'cj'){
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
        if(operator == 'analyst'){
          status = 'Analyst Process';
          remarks_ma = '';

          if(type_action == 'discharge'){
            if($("#input_actionanalyst").val() == 'Pending Jaminan Awal'){
              if($("#input_actionremarks_choice").val() != 'Other'){
                remarks_ma = $("#input_actionremarks_choice").val();
              }else{
                remarks_ma = $("#input_actionremarks_other").val();
              }
            }else{
                remarks_ma = $("#input_actionremarks").val();
            }
          }else{
            remarks_ma = $("#input_actionremarks").val();
          }

          var post_data = {
                        'id_action' : id,
                        'picanalyst' : $("#input_picanalyst").val(),
                        'actionanalyst' : $("#input_actionanalyst").val(),
                        'actionremarks' : remarks_ma,
                        'status' : status,
                        'mode' : mode,
                        'operator' : operator,
                        'type_action' : type_action,
                        'send_instruction' : send_instruction_cj,
                        'remarks_to_cj' : $("#input_remarks_to_cj").val(),
                        };
        }else{
          status = 'Send To Analyst';

          var post_data = {
                          'id_action' : id,
                          'picma' : $("#input_picma").val(),
                          'remakrsma' : $("#input_remakrsma").val(),
                          'status' : status,
                          'mode' : mode,
                          'operator' : operator,
                          'type_action' : type_action,
                          'send_instruction' : send_instruction_cj,
                          'remarks_to_cj' : $("#input_remarks_to_cj").val(),
                          };
        }
      }else{
        status = 'RCV By Analyst';

        var post_data = {
                      'id_action' : id,
                      'picanalyst' : $("#input_picanalyst").val(),
                      'actionanalyst' : $("#input_actionanalyst").val(),
                      'actionremarks' : $("#input_actionremarks").val(),
                      'status' : status,
                      'mode' : mode,
                      'operator' : operator,
                      'type_action' : type_action
                      };
      }
    }

    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/action/update') }}",
            type: "POST",
            data :  post_data,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response){
              $("#input_remarks_to_cj").val('');
              $("#switch_cj").prop("checked", false);
              $("#remarks_to_cj" ).addClass('d-none');

              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);
              hide_form(id, operator);
              $("#row-"+id).addClass('table-success');

              if(operator != 'cj'){
                $('#table-space').animate( { scrollLeft: '1200' }, 900); 
              }

              var nav = $('#row'+id);
              $('html').animate( { scrollTop: '500' }, 900);

              $.ajax({url: "{{ url('/action/refresh_status') }}",
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
  var delete_action = function(id){ 
    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    var post_data = {
                    'id_action' : id,
                    'type_action' : type_action
                    };

    $.ajax({type: "POST",
            url: "{{ url('/action/delete/') }}",
            data :  post_data,
            
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);

              $.ajax({url: "{{ url('/action/refresh_status') }}",
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
                    'status' : status,
                    'type_action' : type_action
                    };

    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/action/filter_status') }}",
            type: "POST",
            data :  post_data,
            headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success : function(response){
              $("#table-space").css("overflow-x", "scroll");
              $('#table-space').html(response);
              
              $.ajax({url: "{{ url('/action/refresh_ft') }}",
                type: "POST",
                data: post_data,

                success : function(response){
                  $('#daterange').html(response);

                  $.ajax({url: "{{ url('/action/refresh_status') }}",
                    type: "POST",
                    data: post_data,

                    success : function(response){
                      $('#summary-space').html(response);
                      status_date = $('#daterange').text();
                      $('#subtitle-date').html(status_date);
                    }
                  });
                }
              });

              $.ajax({url: "{{ url('/action/refresh_status') }}",
                    type: "POST",
                    data: post_data,

                    success : function(response){
                      $('#summary-space').html(response);
                      status_date = $('#daterange').text();
                      $('#subtitle-date').html(status_date);
                    }
                  });

              if(mode == 2){
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
            }
          });
  }
</script>

<script>
  var search_name = function(status){
    var post_data = {
                    'value' : $("#form_search").val(),
                    'type_action' : type_action
                    };

    $("#table-data-action").addClass("d-none");
    $("#table-space").css("overflow", "hidden");
    $(".loader").removeClass("d-none");

    $.ajax({url: "{{ url('/action/search') }}",
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
  function validate() {
    if (document.getElementById('switch_cj').checked) {
        $("#remarks_to_cj" ).removeClass('d-none');
        $("#remarks_to_cj").slideDown(400);

        send_instruction_cj = 1;
    } else {
        $("#remarks_to_cj" ).addClass('d-none');
        $("#remarks_to_cj").slideUp(400);
        
        send_instruction_cj = 0;
    }
}

document.getElementById('switch_cj').addEventListener('change', validate);
</script>

@if (Session::has('datestart_'.$title))
  <script>
    const ds = new Date("{{Session::get('datestart_'.$title)}}");
    const de = new Date("{{Session::get('dateend_'.$title)}}");
    moment_start = moment(ds);
    moment_end = moment(de);
  </script>
@else
  <script>
    moment_start = moment().subtract(1, 'days');
    moment_end = moment();
  </script>  
@endif

@endsection

@section('js-last')
@if (isset($data_notif))
<script>
  var status = @json($notif_status);
  var mode = @json($data_notif);
  console.log('mode : '+mode);

  $( document ).ready(function(){
    // filter_status(status, mode);

    setTimeout(function() {
        filter_status(status, mode);
    }, 1000);
  });
</script>
@else
@endif
@endsection