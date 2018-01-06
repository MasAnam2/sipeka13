<div class="form-group">
	<label for="filter-attendances">Filter</label>
	<select id="filter-attendances" onchange="filterAttendance(this)" class="form-control select2">
		@php
		$options = [
			'today'      => 'Today',
			'yesterday'  => 'Yesterday',
			'this_week'  => 'This Week',
			'this_month' => 'This Month',
			// 'this_year'  => 'This Year',
			// 'all'        => 'All'
		]
		@endphp
		@foreach ($options as $k => $op)
		<option value="{{ $k }}" @if ($k == $time) selected="selected" @endif>{{ $op }}</option>
		@endforeach
	</select>
</div>