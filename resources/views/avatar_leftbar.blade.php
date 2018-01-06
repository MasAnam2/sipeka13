<div class="pull-left image">
	<img src="{{ active_avatar() }}" class="img-circle" alt="User Image">
</div>
<div class="pull-left info">
	<p>{{ strlen(Auth::user()->username)>20?substr(Auth::user()->username, 0, 15).'...':Auth::user()->username }}</p>
	<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
</div>