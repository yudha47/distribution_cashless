@foreach ($action as $a)
<tr>
  <td class="text-left">
    {{$a['member_name']}}</br>
    <small class="text-primary">{{$a['fullname']}}</small>
  </td>
  <td class="font-weight-bold"><span class="d-inline-bloc p-1 border rounded border-success">{{date_format(date_create($a['time_distribution']), "H:i")}}</span></td>
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