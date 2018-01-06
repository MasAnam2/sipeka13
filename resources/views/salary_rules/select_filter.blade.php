Department : 
<select onchange="filterSalaryRules(this)" class="form-control select2">
	@foreach (department()->departments_select()+['all' => 'All'] as $k => $dep)
	<option value="{{ $k }}" @if ($k == $department) selected="selected" @endif>{{ $dep }}</option>
	@endforeach
</select>

<script>
	function filterSalaryRules(selector){
		let dept = $(selector).val();
		// if(dept!='all')
			moveModul('/salary_rules/department/'+dept, 'Salary Rules Department '+selector.options[selector.selectedIndex].text);
		// else
		// 	$('[href="'+base_url('/salary_rules')+'"]').trigger('click');
	}
</script>