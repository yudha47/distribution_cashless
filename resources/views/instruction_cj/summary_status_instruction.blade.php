
<ul id="summary-status" class="nav nav-pills justify-content-start">
  <li class="nav-item">
    <a class="nav-link active bg-transparent pr-2 pl-0 text-primary" href="#">All <span class="badge badge-pill bg-primary text-white ml-2" onclick="filter_status('All', 1)">{{$all_act}}</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-muted px-2" href="#">Send To CJ <span class="badge badge-pill badge-danger ml-2" onclick="filter_status('Send To CJ', 1)">{{$status1}}</span></a>
  </li>
  <form class="ml-3 form-inline d-none d-lg-flex searchform text-muted">
    <input id="form_search" class="form-control form-control-sm mr-sm-2 bg-transparent pl-4 text-muted" style="min-width: 220px;" type="search" placeholder="Search name or claim no. . . . " aria-label="Search">
    <button id="btn-search" type="button" class="btn btn-secondary btn-sm" onclick="search_name()">Search</button>
  </form>
</ul>