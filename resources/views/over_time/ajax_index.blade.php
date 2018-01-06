<div class="content-wrapper">
	<section class="content-header">
		<h1>Over Time</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Over Time</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				{{ success_failed_alert().success_failed_alert_2() }}
			</div>
			<div class="col-md-10">
				<div class="box box-primary">
					<div class="box-body">
						<form action="{{ route('over_time.delete_selected') }}">
							<div class="row">
								<div class="col-md-12 margin-bottom">
									<div class="row">
										<div class="col-md-2">
											{{ export_delete_selected_button('over_time') }}
										</div>
										<div class="col-md-2">
											@include('over_time.select_filter')
										</div>
										@include('over_time.filter_by_date')
									</div>
								</div>
								<div class="col-md-12">
									<table data-url="{{ route('over_time.dt') }}" class="table table-bordered table-striped" id="datatable">
										<thead>
											<tr>
												<th width="10px">#</th>
												<th>Employee</th>
												<th>Created At</th>
												<th>Pay (Rp)</th>
												<th width="150px">Information</th>
												<th width="50px">Action</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				@include('over_time.set_time')
			</div>
		</div>
	</section>
</div>