@extends('layouts.view')
@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Home
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		</ol>
	</section>
	<section class="content">
		{!! scs() !!}
		<div class="row">
			<div class="col-md-4">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Last Activities</h3>
					</div>
					<div class="box-body" style="height: 400px; overflow-y: auto;">
						<ul class="products-list product-list-in-box">

							@foreach($activities as $a)
							<li class="item">
								<div class="product-img">
									<img src="{{ App\User::where('username', $a->username)->first()->avatar!=null?asset('storage').'/'.$a->avatar:asset('images/avatars/default.png') }}" alt="Product Image">
								</div>
								<div class="product-info">
									{{ $a->username.' '.time_elapsed_string($a->created_at) }}
									<span class="product-description">
										{{ $a->event }}
									</span>
								</div>
							</li>
							@endforeach
						</ul>
					</div>
					<div class="box-footer"></div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Announcements</h3>
					</div>
					<div class="box-body">
						@foreach($announcements as $a)
						
						<div class="callout {{ $a->color }}">
							<h4>{{ $a->title}}</h4>
							<p>
								{!! $a->content !!}
							</p>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection