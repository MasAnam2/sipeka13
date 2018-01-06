<form action="">
	<div class="row">
		<div class="col-md-4">
			{{ select('month', '', ['all' => 'All'] + getMonthArray(), '', $month) }}
		</div>
		<div class="col-md-4">
			{{ select('year', '', ['all' => 'All'] + getYearFromBuildArray(), '', $year) }}
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="cl">Click to filter</label>
				<a id="filterLoan" href="javascript:void(0)" class="btn btn-primary btn-sm btn-flat btn-block">Filter</a>
			</div>
		</div>
	</div>
</form>

<script>
	$('#filterLoan').on('click', function(e){
		e.preventDefault();
		let form  = $(this).parents('form');
		let month = form.find('#month').val();
		let year  = form.find('#year').val();
		if(month == 'all' && year == 'all')
			moveModul('/loans', 'Loan with filter');
		else	
			moveModul('/loan/filter/'+month+'/'+year, 'Loan with filter');
	});
</script>