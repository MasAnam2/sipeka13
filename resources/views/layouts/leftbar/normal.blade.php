@php
$authority = App\Models\Hris\Authority::where('user', Auth::id())->first();
@endphp
@if($authority->home==1)
<li {{ active_modul($modul, 'dashboard') }}>
  <a href="{{ route('home') }}">
    <i class="fa fa-home"></i><span> Home</span>
  </a>
</li>
@endif
@if($authority->department==1)
<li {{ active_modul($modul, 'department') }}>
  <a href="{{ route('departments') }}">
    <i class="fa fa-institution"></i><span> Departments</span>
  </a>
</li>
@endif
@if($authority->position==1)
<li {{ active_modul($modul, 'position') }}>
  <a href="{{ route('positions') }}">
    <i class="fa fa-male"></i><span> Positions</span>
  </a>
</li>
@endif
@if($authority->employee==1)
<li {{ active_modul($modul, 'employee') }}>
  <a href="{{ route('employees') }}">
    <i class="fa fa-group"></i><span> Employees</span>
  </a>
</li>
@endif
@if($authority->attendance==1)
<li {{ active_modul($modul, 'attendance') }}>
  <a href="{{ route('attendances') }}">
    <i class="fa fa-clock-o"></i><span> Attendances</span>
  </a>
</li>
@endif
@if($authority->over_time==1)
<li {{ active_modul($modul, 'over_time') }}>
  <a href="{{ route('over_time') }}">
    <i class="fa fa-coffee"></i><span> Over Time</span>
  </a>
</li>
@endif
@if($authority->loan==1)
<li {{ active_modul($modul, 'loan') }}>
  <a href="{{ route('loans') }}">
    <i class="fa fa-credit-card"></i><span> Loans</span>
  </a>
</li>
@endif
@if($authority->account==1)
<li {{ active_modul($modul, 'account') }}>
  <a href="{{ route('accounts') }}">
    <i class="fa fa-user"></i><span> Accounts</span>
  </a>
</li>
@endif
@if($authority->salary==1)
<li {{ active_modul($modul, 'salary') }}>
  <a href="{{ route('salaries') }}">
    <i class="fa fa-money"></i><span> Salaries</span>
  </a>
</li>
@endif