<nav class="navbar navbar-expand-lg navbar-light bg-white flex-row border-bottom shadow">
  <div class="container-fluid">
    <a class="navbar-brand" style="width: 40px" href="./index.html">
      {{-- <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
        <g>
          <polygon class="st0" points="78,105 15,105 24,87 87,87  " />
          <polygon class="st0" points="96,69 33,69 42,51 105,51   " />
          <polygon class="st0" points="78,33 15,33 24,15 87,15  " />
        </g>
      </svg> --}}
      <img src="{{ asset('assets/images/AAI_Icon.png') }}" alt="" class="" style="width: 150%">
    </a>
    <button class="navbar-toggler mt-2 mr-auto toggle-sidebar text-muted">
      <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <div class="navbar-slide bg-white ml-lg-4" id="navbarSupportedContent">
      <a href="#" class="btn toggle-sidebar d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
      </a>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link pl-lg-2 {{ ($title == 'Dashboard') ? 'navbar-active' : ''}}" href="{{url('/dashboard')}}"><span class="ml-1">Dashboard</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link pl-lg-2 {{ ($title == 'admissions') ? 'navbar-active' : ''}}" href="{{url('/action/type/admissions')}}"><span class="ml-1">Admission</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link pl-lg-2 {{ ($title == 'monitoring') ? 'navbar-active' : ''}}" href="{{url('/action/type/monitoring')}}"><span class="ml-1">Monitoring</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link pl-lg-2 {{ ($title == 'discharge') ? 'navbar-active' : ''}}" href="{{url('/action/type/discharge')}}"><span class="ml-1">Discharge</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link pl-lg-2 {{ ($title == 'Instruction CJ') ? 'navbar-active' : ''}}" href="{{url('/instruction-cj')}}"><span class="ml-1">Instruction CJ</span></a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link pl-lg-2 {{ ($title == 'Action Summary') ? 'navbar-active' : ''}}" href="/summary"><span class="ml-1">Action Summary</span></a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link pl-lg-2 {{ ($title == 'Wallboard') ? 'navbar-active' : ''}}" href="{{url('/wallboard')}}"><span class="ml-1">Wallboard</span></a>
        </li>
      </ul>
    </div>
    <form class="form-inline ml-md-auto d-none d-lg-flex searchform text-muted invisible">
      <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
    </form>
    <ul class="navbar-nav d-flex flex-row">
      <li class="nav-item mr-1">
        <a class="nav-link text-muted px-2 mt-2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="get_notif('analyst')">Analyst <span id="notif_all_analyst" class="badge badge-pill badge-danger ml-2">0</span></a>
        
        <div class="dropdown-menu" id="filter_status_option" style="left: auto">
          <a id="" class="dropdown-item" target="_BLANK" href="{{url('/action/type/admissions/filter_notif/analyst')}}">
            Admission 
            <span id="notif-analyst-admission" class="badge badge-pill bg-white border text-muted ml-2"></span>
          </a>          
          <a id="" class="dropdown-item" target="_BLANK" href="{{url('/action/type/monitoring/filter_notif/analyst')}}">
            Monitoring 
            <span id="notif-analyst-monitoring" class="badge badge-pill bg-white border text-muted ml-2"></span>
          </a>
          <a id="" class="dropdown-item" target="_BLANK" href="{{url('/action/type/discharge/filter_notif/analyst')}}">
            Discharge 
            <span id="notif-analyst-discharge" class="badge badge-pill bg-white border text-muted ml-2"></span>
          </a>
        </div>
      </li>
      <li class="nav-item mr-1">
        <a class="nav-link text-muted px-2 mt-2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="get_notif('ma')">Medical Advisor <span id="notif_all_ma" class="badge badge-pill badge-danger ml-2">0</span></a>
      
        <div class="dropdown-menu" id="filter_status_option" style="left: auto">
          <a id="" class="dropdown-item" target="_BLANK" href="{{url('/action/type/admissions/filter_notif/ma')}}">
            Admission 
            <span id="notif-ma-admission" class="badge badge-pill bg-white border text-muted ml-2"></span>
          </a>          
          <a id="" class="dropdown-item" target="_BLANK" href="{{url('/action/type/monitoring/filter_notif/ma')}}">
            Monitoring 
            <span id="notif-ma-monitoring" class="badge badge-pill bg-white border text-muted ml-2"></span>
          </a>
          <a id="" class="dropdown-item" target="_BLANK" href="{{url('/action/type/discharge/filter_notif/ma')}}">
            Discharge 
            <span id="notif-ma-discharge" class="badge badge-pill bg-white border text-muted ml-2"></span>
          </a>
        </div>
      </li>
      <li class="nav-item mr-1">
        <a class="nav-link text-muted px-2 mt-2" href="{{url('/instruction-cj/filter_notif')}}" target="_BLANK">Customer Journey <span id="notif_all_cj" class="badge badge-pill badge-danger ml-2">0</span></a>
      </li>
      <li class="nav-item mr-1">
        <a class="nav-link text-muted my-2 mt-2" href="./#" id="modeSwitcher" data-mode="light">
          <i class="fe fe-sun fe-16"></i>
        </a>
      </li>
      <li class="nav-item dropdown ml-lg-0">
        <a class="nav-link dropdown-toggle text-muted" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="avatar avatar-sm mt-2 mr-1">
            <img src="{{ asset('assets/avatars/icon-doctor-8.jpg') }}" alt="..." class="avatar-img rounded-circle">
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          <li class="nav-item">
            <a class="nav-link pl-3" href="#">{{Session::get('username')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="3" data-toggle="modal" data-target="#changepassword">Change Password</a>
          </li>
          @if (Session::get('level') == 0)
          <li class="nav-item">
            <a class="nav-link pl-3" href="{{url('/users')}}">User Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="{{url('/productivity')}}">Time Productivity</a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link pl-3" href="{{route('logout')}}">Logout</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>