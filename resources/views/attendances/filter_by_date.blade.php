<div class="col-md-2">
	{{ input_datepicker('filter-date', 'Filter By Date', $time!='this_month'&&$time!='this_week'&&$time!='yesterday'&&$time!='today' ? str_replace('-', '/', $time) : '') }}
</div>
<div class="col-md-2">
	<div class="form-group">
		<label for="filter-btn">Click to filter</label>
		<br>
		{!! primBtn('Filter', 'onclick="filterAttendance(\'#filter-date\')"') !!}
	</div>
</div>