@extends('layouts.main')

@section('container')

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="row">
        <div id="table-admission" class="col-md-12">
          <div class="">
            <h2 class="h4 text-center">{{$title}}</h2>
          </div>
          <div id="wallboard-space" class="row mt-4">
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
                                              }, 3500);
                                              setTimeout(function() {
                                                                    reload_action("discharge");
                                                                  }, 3500);
                                                                  setTimeout(function() {
                                                                                      interval_reload_action();
                                                                                      }, 3500);
                        }, 3500);
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
                                            }, 3000);
                                            setTimeout(function() {
                                                                  reload_action("discharge");
                                                                }, 3000);
                                                                  setTimeout(function() {
                                                                                      interval_reload_action();
                                                                                      }, 3000);
                      }, 3000);
</script>
@endif
@endsection