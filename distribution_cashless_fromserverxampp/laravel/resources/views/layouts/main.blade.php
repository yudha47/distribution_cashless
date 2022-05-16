<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="favicon.ico">
    <title>{{$title}} - Daily Distribution Case</title>
    <link rel="stylesheet" href="{{ asset('css/simplebar.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme" disabled>
    <link rel="stylesheet" href="{{ asset('css/scroll.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">

    <style>
      #table-action, #form-action{
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
      }

      .invalid-blink {
        background-color: #aafce2;
        transition: all 2s ease;
      }

      .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
      }

      /* Safari */
      @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }

      .table th, .table td{
        padding: 0.5em;
      }

      .table-wallboard td{
        padding: 0.3em;
      }
    </style>
  </head>
  <body class="horizontal light">
    <div class="wrapper">
      @if($title == 'wallboard1')
        @include('layouts.header_wb')
      @else
        @include('layouts.header')
      @endif

      @if(Session::get('messages') != null)
      <div id="messages" class="alert alert-success alert-dismissible">
        {{ Session::get('messages') }}
        @php
            Session::put('messages', ''); 
        @endphp
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      </div>
      @endif

      <main role="main" class="main-content">
        @yield('container')
      </main> <!-- main -->
      
      <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content text-center">
            <div class="modal-header d-block">
              <h5 class="modal-title text-center" id="defaultModalLabel">Change Password</h5>
            </div>
            <div class="modal-body"> 
              <form id="form-change-password" action="{{url('users/change_password')}}" class="" method="post">
                @csrf
                <div class="form-group mb-3">
                  <label for="simpleinput">New Password</label>
                  <input type="password" id="password1" name="password1" class="form-control text-center">
                  <input type="text" id="id_user" name="id_user" class="form-control text-center" value="{{Session::get('id')}}" hidden>
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Confirm Password</label>
                  <input type="password" id="password2" name="password2" class="form-control text-center">
                </div>
                <button type="submit" class="btn mb-1 mt-4 btn-primary btn-block" onclick="return check_password()">Save New Password</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- .wrapper -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.stickOnScroll.js') }}"></script>
    <script src="{{ asset('js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.timepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
      var sess_username = '<?php echo Session::get('username') ?>';
    </script>

    <script>
       var check_password = function(){
        password_1 = $("#password1").val();
        password_2 = $("#password2").val();

        if(password_1 == password_2){
          return true;
        }else{
          alert('Password not same, please check again !');
          return false;
        }
      }
    </script>

    <script>
      setTimeout(function(){$('#messages').alert('close')}, 6000);
    </script>
    
    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
      });
    </script>
    
    @yield('addon-page')

    <script>
      function reload_notif() {
        $.ajax({url: "{{ url('/dashboard/get_notif') }}",
                type: "POST",

                success : function(response){
                  // console.log(response);
                  var obj = JSON.parse(response);

                  $('#notif_all_analyst').text(obj["result"][0]);
                  $('#notif_all_ma').text(obj["result"][1]);
                  $('#notif_all_cj').text(obj["result"][2]);
                }
              });
      }

      var myInterval = setInterval(reload_notif, 3000);

      function get_notif(operator){
        var post_data = {
                          'operator' : operator,
                        };

        $.ajax({url: "{{ url('/dashboard/get_notif_action') }}",
                type: "POST",
                data: post_data,

                success : function(response){
                  console.log(response);
                  var obj = JSON.parse(response);

                  $('#notif-'+operator+'-admission').text(obj["result"][0]);
                  $('#notif-'+operator+'-monitoring').text(obj["result"][1]);
                  $('#notif-'+operator+'-discharge').text(obj["result"][2]);
                }
              });
      }
    </script>

    <script>
      $('.select2').select2(
      {
        theme: 'bootstrap4',
      });
      $('.select2-multi').select2(
      {
        multiple: true,
        theme: 'bootstrap4',
      });
      $('.drgpicker').daterangepicker(
      {
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        locale:
        {
          format: 'MM/DD/YYYY'
        }
      });
      $('.time-input').timepicker(
      {
        'scrollDefault': 'now',
        'zindex': '9999' /* fix modal open */
      });
      /** date range picker */
      if ($('.datetimes').length)
      {
        $('.datetimes').daterangepicker(
        {
          timePicker: true,
          startDate: moment().startOf('hour'),
          endDate: moment().startOf('hour').add(32, 'hour'),
          locale:
          {
            format: 'M/DD hh:mm A'
          }
        });
      }
      var start = moment_start;
      var end = moment_end;

      $('#reportrange').daterangepicker(
      {
        startDate: start,
        endDate: end,
        ranges:
        {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 2 Days': [moment().subtract(2, 'days'), moment()],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      }, filter_daterange);
      filter_daterange(start, end);
    </script>
    
    <script src="{{ asset('js/apps.js') }}"></script>
    
    @yield('js-last')

  </body>
</html>