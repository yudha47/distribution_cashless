@extends('layouts.main')

@section('container')

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="row">
        <div id="table-action" class="col-md-9">
          <h2 id="title" class="h4 mb-3 d-block text-capitalize">{{$title}}</h2>
          <div class="card shadow">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- table -->
                  <div id="table-space" class="scrollbar-info" style="">
                    <div class="d-flex justify-content-center">
                      <div class="loader d-none"></div>
                    </div>
                    <div class="d-flex justify-content-center">
                      <div class="loader d-none"></div>
                    </div> 

                    @if(Session::get('messages') != null)
                    <div id="messages" class="alert alert-success alert-dismissible">
                      {{ Session::get('messages') }}
                      @php
                          Session::put('messages', ''); 
                      @endphp
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    @endif

                    <table id="table-data-action" class="table table-hover table-bordered" style="white-space: nowrap;">
                      <thead class="thead-dark">
                        <tr class="text-center">
                          <th>No</th>
                          <th>Fullname</th>
                          <th>Email</th>
                          <th>Username</th>
                          <th>Password</th>
                          <th>Level</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php($no=0)
                        @foreach ($data as $user)
                        @php($no++)
                        <tr>
                          <td class="text-center">{{$no}}</td>
                          <td>{{$user['full_name']}}</td>
                          <td>{{$user['email']}}</td>
                          <td>{{$user['username']}}</td>
                          <td class="text-center">
                            <form action="{{url('/users/reset_password')}}" method="post">
                              @csrf
                              <input type="text" value="{{$user['id']}}" name="id_user" hidden>
                              <button type="submit" class="btn btn-warning btn-sm btn-block" onclick="return confirm('Are you sure want to reset password ? password will be update with ~~P@ssw0rd~~ ')">Reset Password</button>
                            </form>
                          </td>
                          <td class="text-center">{{$user['name_group']}}</td>
                          <td class="text-center">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="mr-1">Action</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#" onclick="edit_users({{$user['id']}})">Edit</a>
                              <a class="dropdown-item" href="{{url('users/delete/'.$user['id'])}}" onclick="return confirm('Are you sure you want to delete this user ?')">Remove</a>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="form-action" class="col-md-3" style="">
          <h2 class="h4 mb-3 d-block invisible">{{$title}}</h2>
          <div class="card shadow">
            <div class="card-body form-space">
              <form id="form-add" action="{{url('users/add')}}" class="" method="post" autocomplete="off">
                @csrf
                <p class="mb-3 mt-1 "><strong>Add New User</strong></p>
                <div class="form-group mb-3">
                  <label for="simpleinput">Fullname</label>
                  <input type="text" id="input_fullname" class="form-control" name="fullname">
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Email</label>
                  <input type="text" id="input_email" class="form-control" name="email">
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Username</label>
                  <input type="text" id="input_username" class="form-control" name="username" autocomplete="new-username">
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Password</label>
                  <input type="password" id="input_password" class="form-control" name="password" autocomplete="new-password">
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Level</label>
                  <select name="level" id="input_level" class="form-control">
                    @foreach ($level as $l)
                      <option value="{{$l['id_group']}}">{{$l['name_group']}}</option>
                    @endforeach
                  </select>
                </div>
                <button id="btn-add" type="submit" class="btn btn-success btn-block mt-4 btn-add">Add</button>
              </form>
              <form id="form-edit" action="{{url('users/update')}}" class="d-none" method="post" autocomplete="off">
                @csrf
                <p class="mb-3 mt-1 "><strong>Update User : <span class="text-capitalize" id="title-name-edit"></span></strong></p>
                <div class="form-group mb-3">
                  <label for="simpleinput">Fullname</label>
                  <input type="text" id="edit_fullname" class="form-control" name="fullname">
                  <input type="text" id="edit_id" class="form-control" name="id" hidden>
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Email</label>
                  <input type="text" id="edit_email" class="form-control" name="email">
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Username</label>
                  <input type="text" id="edit_username" class="form-control" name="username" autocomplete="new-username">
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Password</label>
                  <input type="password" id="edit_password" class="form-control" name="password" autocomplete="new-password">
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">Level</label>
                  <select name="level" id="edit_level" class="form-control">
                    @foreach ($level as $l)
                      <option value="{{$l['id_group']}}">{{$l['name_group']}}</option>
                    @endforeach
                  </select>
                </div>

                <button id="btn-add" type="button" class="btn btn-secondary mt-4 btn-add" style="width: 49%" onclick="cancel_edit()">Cancel</button>
                <button id="btn-add" type="submit" class="btn btn-success mt-4 btn-add" style="width: 49%">Update</button>
              </form>
            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div> <!-- /.col -->
      </div> <!-- end section -->
    </div> <!-- .col-12 -->
  </div> <!-- .row -->
</div> <!-- .container-fluid -->

@endsection

@section('addon-page')
<script>
  moment_start = moment().subtract(2, 'days');
  moment_end = moment();
  var filter_daterange = function(start, end){

  };
</script>
<script>
  // setTimeout(function(){$('#messages').alert('close')}, 6000);
</script>

<script type="text/javascript">
  var edit_users = function(id){  
    // alert(id);
    var post_data = {'id_users' : id
                    };

    $.ajax({type : 'POST',
              url : "{{url('/users/get_user')}}",
              data :  post_data,
              success : function(data){
                console.log(data);
                // $("#form-edit").slideDown(600);
                $("#form-add" ).addClass('d-none');
                $("#form-edit" ).removeClass('d-none');
                
                var obj = JSON.parse(data);
                $("#title-name-edit").text(obj["data"]["full_name"]);
                $('#edit_id').val(obj["data"]["id"]);
                $('#edit_fullname').val(obj["data"]["full_name"]);
                $('#edit_email').val(obj["data"]["email"]);
                $('#edit_username').val(obj["data"]["username"]);
                $("#edit_level option[value='"+obj["data"]["level"]+"']").prop('selected', true);
              }
            });
  }; 

  var cancel_edit = function(){ 
    $("#form-add" ).removeClass('d-none');
    $("#form-edit" ).addClass('d-none');
 
    setTimeout(function() {
      $("#edit_level option[value='0']").prop('selected', true);
      $('#title-name-edit').text('');
      $('#edit_fullname').val('');
      $('#edit_email').val('');
      $('#edit_username').val('');
    }, 1000);
  };
</script>
@endsection