<div class="form-group">
	<label for="filter-over-time">Filter</label>
	<select id="filter-over-time" onchange="filterOverTime(this)" class="form-control select2">
		@php
		$options = [
			'today'      => 'Today',
			'yesterday'  => 'Yesterday',
			'this_week'  => 'This Week',
			'this_month' => 'This Month'
		]
		@endphp
		@foreach ($options as $k => $op)
		<option value="{{ $k }}" @if ($k == $time) selected="selected" @endif>{{ $op }}</option>
		@endforeach
	</select>
</div>