@if($profile->leftbar->home==1)
  <li {{ active_modul($modul, 'dashboard') }}><a href="{{ route('home') }}"><i class="fa fa-home"></i><span> Home</span></a></li>
@endif
@if($profile->leftbar->department==1 or $profile->leftbar->sub_department==1)
  <?php $moduls = ['department', 'subdepartment'] ?>
  <li class="treeview @if(in_array($modul, $moduls)) active @endif">
    <a href="#">
      <i class="fa fa-institution"></i> <span>Departments</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      @if($profile->leftbar->department==1)
      <li {{ active_modul($modul, 'department') }}><a href="{{ route('departments') }}"><i class="fa fa-institution"></i> Departments</a></li>
      @endif
      @if($profile->leftbar->sub_department==1)
      <li {{ active_modul($modul, 'subdepartment') }}><a href="{{ route('subdepartments') }}"><i class="fa fa-institution"></i> Sub Departments</a></li>
      @endif
    </ul>
  </li>
@endif
@if($profile->leftbar->position==1)
  <li {{ active_modul($modul, 'position') }}><a href="{{ route('positions') }}"><i class="fa fa-male"></i><span> Positions</span></a></li>
@endif
@if($profile->leftbar->employee==1)
  <li {{ active_modul($modul, 'employee') }}><a href="{{ route('employees') }}"><i class="fa fa-suitcase"></i><span> 
Employees</span></a></li>
@endif
@if($profile->leftbar->calendar==1)
  <li {{ active_modul($modul, 'calendar') }}><a href="{{ route('calendars') }}"><i class="fa fa-calendar"></i><span> 
Calendar</span></a></li>
@endif
@if($profile->leftbar->attendance==1 or $profile->leftbar->over_time==1)
  <?php $moduls = ['absence', 'overtime'] ?>
  <li class="treeview @if(in_array($modul, $moduls)) active @endif">
    <a href="#">
      <i class="fa fa-clock-o"></i> <span>Attendance</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      @if($profile->leftbar->attendance==1)</a></li>
        <li {{ active_modul($modul, 'absence') }}><a href="{{ route('absences') }}"><i class="fa fa-clock-o"></i> Manage Attendance</a></li>
      @endif
      @if($profile->leftbar->over_time==1)
        <li {{ active_modul($modul, 'overtime') }}><a href="{{ route('overtimes') }}"><i class="fa fa-legal"></i> Over Time</a></li>
      @endif
    </ul>
  </li>
@endif
@if($profile->leftbar->official_travel==1)
  <li {{ active_modul($modul, 'travel') }}><a href="{{ route('travels') }}"><i class="fa fa-truck"></i><span> 
Official Travel</span></a></li>
@endif
@if($profile->leftbar->mutation==1)
  <li {{ active_modul($modul, 'mutation') }}><a href="{{ route('mutations') }}"><i class="fa fa-cc"></i><span> 
Mutations</span></a></li>
@endif
@if($profile->leftbar->payroll==1)
  <li {{ active_modul($modul, 'payroll') }}><a href="{{ route('payroll') }}"><i class="fa fa-dollar"></i><span> 
Payroll</span></a></li>
@endif
@if($profile->leftbar->account==1)
  <li {{ active_modul($modul, 'account') }}><a href="{{ route('accounts') }}"><i class="fa fa-user"></i><span> 
Accounts</span></a></li>
@endif
@if($profile->leftbar->leave_period==1)
  <li {{ active_modul($modul, 'leave_period') }}><a href="{{ route('leaves') }}"><i class="fa fa-clock-o"></i><span> 
Leave Period</span></a></li>
@endif
@if($profile->leftbar->announcement==1)
  <li {{ active_modul($modul, 'announcement') }}><a href="{{ route('announcements') }}"><i class="fa fa-bullhorn"></i><span> 
Announcements</span></a></li>
@endif
@if(Auth::id()==1)
  <li {{ active_modul($modul, 'setting') }}><a href="{{ route('settings') }}"><i class="fa fa-gear"></i><span> 
Settings</span></a></li>
@endif
@if($profile->leftbar->disbled==1)
  <?php $moduls2 = ['department.disabled', 'position.disabled']; ?>
  <li class="treeview @if(in_array($modul, $moduls2)) active @endif">
    <a href="#">
      <i class="fa fa-trash"></i><span>Disabled Data</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li @if($modul=='department.disabled') class="active" @endif><a href="{{ route('department.disabled') }}"><i class="fa fa-trash"></i> Departments</a></li>
      <li @if($modul=='position.disabled') class="active" @endif><a href="{{ route('position.disabled') }}"><i class="fa fa-trash"></i> Position</a></li>
    </ul>
  </li>
@endif