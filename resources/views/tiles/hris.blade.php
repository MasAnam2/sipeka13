@extends('layouts.view')
@section('module')
<div class="menu-body"> 
    <div class="tile-area">
        <div class="single-tile-group"> 
            <div href="#" class="tile-large" data-title="Departments" data-role="tile" data-datatable="{{ route('department.dt') }}" data-url="{{ route('departments') }}">
                <div class="tile-content iconic">
                    <i class="icon fa fa-university mif-ani-flash mif-ani-slow" data-icon="fa fa-university"></i>
                </div>
                <span class="tile-label">Departments</span>
            </div>
            <div class="tile tile-square-x" data-title="Positions" data-datatable="{{ route('position.dt') }}" data-role="tile" data-url="{{ route('positions') }}">
                <div class="tile-content iconic">
                    <i class="icon fa fa-group mif-ani-heartbeat" data-icon="fa fa-group"></i>
                </div>
                <span class="tile-label">Positions</span>
            </div>
            <div class="tile" data-title="Employees" data-role="tile" data-datatable="{{ route('employee.dt') }}" data-url="{{ route('employees') }}">
                <div class="tile-content iconic">
                    <i class="icon fa fa-address-book-o mif-ani-shuttle" data-icon="fa fa-address-book-o"></i>
                </div>
                <span class="tile-label">Employees</span>
            </div>
        </div>
        <div class="single-tile-group"> 
            <div class="tile-wide" data-title="Manage Attendance" data-role="tile" data-datatable="{{ route('attendance.dt') }}" data-url="{{ route('attendances') }}">
                <div class="tile-content iconic" >
                    <i class="icon fa fa-bell-o mif-ani-ring mif-ani-slow" data-icon="fa fa-bell-o"></i>
                </div>
                <span class="tile-label">Manage Attendance</span>
            </div>
            <div class="tile-wide" data-title="Over Time" data-role="tile" data-datatable="{{ route('overtime.dt') }}" data-url="{{ route('overtimes') }}">
                <div class="tile-content iconic" >
                    <i class="icon fa fa-gavel mif-ani-spanner" data-icon="fa fa-gavel"></i>
                </div>
                <span class="tile-label">Over Time</span>
            </div>
            <div class="tile" data-title="Mutations" data-role="tile" data-datatable="{{ route('mutation.dt') }}" data-url="{{ route('mutations') }}">
                <div class="tile-content iconic" >
                    <i class="icon fa fa-handshake-o mif-ani-bounce" data-icon="fa fa-handshake-o"></i>
                </div>
                <span class="tile-label">Mutations</span>
            </div>
            <div class="tile" data-title="Payroll" data-role="tile" data-datatable="{{ route('payroll.dt') }}" data-url="{{ route('payroll') }}">
                <div class="tile-content iconic">
                    <i class="icon fa fa-money mif-ani-heartbeat" data-icon="fa fa-money"></i>

                </div>
                <span class="tile-label">Payroll</span>
            </div>
        </div>
        <div class="single-tile-group"> 
            <div class="tile" data-title="Special Day" data-role="tile" data-datatable="{{ route('special_day.dt') }}" data-url="{{ route('calendars') }}">
                <div class="tile-content iconic" >
                    <i class="icon fa fa-calendar-check-o mif-ani-flash" data-icon="fa fa-calendar-check-o"></i>
                </div>
                <span class="tile-label">Special Day</span>
            </div>
            <div class="tile" data-title="Accounts" data-role="tile" data-datatable="{{ route('account.dt') }}" data-url="{{ route('accounts') }}">
                <div class="tile-content iconic" >
                    <i class="icon fa fa-user-circle-o mif-ani-float" data-icon="fa fa-user-circle-o"></i>
                </div>
                <span class="tile-label">Accounts</span>
            </div>

            <div class="tile-wide" data-title="Official Travel" data-role="tile" data-datatable="{{ route('official_travel.dt') }}" data-url="{{ route('official_travels') }}">
                <div class="tile-content iconic">
                    <i class="icon fa fa-space-shuttle mif-ani-pass" data-icon="fa fa-space-shuttle"></i>
                </div>
                <span class="tile-label">Official Travel</span>
            </div>
            <div class="tile" data-title="Leave Period" data-role="tile" data-datatable="{{ route('leave_period.dt') }}" data-url="{{ route('leave_periods') }}">
                <div class="tile-content iconic" >
                    <i class="icon fa fa-hourglass-o fa-spin" data-icon="fa fa-hourglass-o"></i>
                </div>
                <span class="tile-label">Leave Period</span>
            </div>
            <div class="tile" data-title="Announcement" data-role="tile" data-datatable="{{ route('announcement.dt') }}" data-url="{{ route('announcement') }}">
                <div class="tile-content iconic">
                    <i class="icon fa fa-bullhorn mif-ani-horizontal mif-ani-slow" data-icon="fa fa-bullhorn"></i>
                </div>
                <span class="tile-label">Announcement</span>
            </div>
        </div>
    </div>
</div>
@endsection
@section('module-title')
HRIS
@endsection