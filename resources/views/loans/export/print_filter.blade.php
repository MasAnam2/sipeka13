@extends('loans.export.print')
@section('filter')
	<strong>Month :</strong> {{ english_month_name($month) }} <strong>Year :</strong> {{ $year }} <br>
@endsection