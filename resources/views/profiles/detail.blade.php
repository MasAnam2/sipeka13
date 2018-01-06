<div class="tab-content">
	<div class="tab-pane active" id="profile_detail">
		<div class="row">
			<div class="col-sm-3">
				<div class="image-container rounded handing ani padding10">
					<img id="avatar-image" src="@if(Auth::user()->avatar){{ asset('storage/'.Auth::user()->avatar) }}@else{{ asset('images/avatars/default.png') }}@endif" class="bordered" style="border-radius: 50%; max-height: 100px; max-width: 100px;" >
				</div>
				<br>
				<div class="padding10">
					<a href="#edit_avatar" data-toggle="tab">
						Edit Avatar
					</a>
					
				</div>
			</div>
			<div class="col-sm-8">
				<table class="table">
					<?php 
					$active_user = App\Models\Employee::find(Auth::id()); 
					$sub_dept = App\Models\SubDepartment::find($active_user->department);
					$dept = Department::find($sub_dept->department);
					$pos = App\Position::find($active_user->position);
					?>
					@if(Auth::id()!=1)
					<tr>
						<td><strong>Name</strong></td>
						<td>{{ $active_user->name }}</td>
					</tr>
					@endif
					<tr>
						<td><strong>Username</strong></td>
						<td>
							{{ Auth::user()->username }} 
							<a href="#edit_username" data-toggle="tab">
								Edit
							</a>
						</td>
					</tr>
					<tr>
						<td><strong>Level</strong></td>
						<td>{{ level(Auth::user()->level) }}</td>
					</tr>
					@if(Auth::id()!=1)
					<tr>
						<td><strong>Department</strong></td>
						<td>{{ $dept->name }}</td>
					</tr>
					<tr>
						<td><strong>Sub Department</strong></td>
						<td>{{ $sub_dept->name }}</td>
					</tr>
					<tr>
						<td><strong>Position</strong></td>
						<td>{{ $pos->name }}</td>
					</tr>
					@endif
				</table>
			</div>
		</div>
	</div>
	<div class="tab-pane" id="edit_avatar">
		<form action="{{ route('avatar.update') }}" onsubmit="avatarSave(this, event)" id="avatar-update" method="post">
			<div class="row">
				<div class="col-sm-12">
					<a href="#profile_detail" data-toggle="tab"><span class="mif-arrow-left"></span> Back</a>
				</div>
				<div class="col-sm-12">
					{!! inp_file('avatar') !!}
				</div>
				<div class="col-sm-12">
					<div class="alert bg-blue fg-white">
						<h4><i class="icon mif-info"></i> Please read!</h4>
						Max Dimension Size 512px*512px. <br>
						Min Dimension Size 300px*300px. <br>
						Max Size 300kb
					</div>
				</div>
				<div class="col-sm-12 padding10">
					<button onclick="avatarSave(getElementById('avatar-update'), event)" type="submit" class="button small-button primary loading-pulse black-shadow-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
	<div class="tab-pane" id="edit_username">
		<form action="{{ route('username.update') }}" onsubmit="usernameSave(this, event)" id="username-update" method="post">
			<div class="row">
				<div class="col-sm-12">
					<a href="#profile_detail" data-toggle="tab"><span class="mif-arrow-left"></span> Back</a>
				</div>
				<div class="col-sm-12">
					{!! ed_inp_txt(Auth::user()->username, 'username') !!}
				</div>
				<div class="col-sm-12">
					{!! inp_pass() !!}
				</div>
				<div class="col-sm-12">
					{!! inp_pass_conf() !!}
				</div>
				<div class="col-sm-12 padding10">
					<button onclick="usernameSave(getElementById('username-update'), event)" type="submit" class="button small-button primary loading-pulse black-shadow-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
	<div class="tab-pane" id="edit_password">
		<form action="{{ route('password.update') }}" onsubmit="passwordSave(this, event)" id="password-update" method="post">
			<div class="row">
				<div class="col-sm-12">
					<a href="#profile_detail" data-toggle="tab"><span class="mif-arrow-left"></span> Back</a>
				</div>
				<div class="col-sm-12">
					{!! ed_inp_txt(Auth::user()->username, 'username') !!}
				</div>
				<div class="col-sm-12">
					{!! inp_pass() !!}
				</div>
				<div class="col-sm-12">
					{!! inp_pass_conf() !!}
				</div>
				<div class="col-sm-12 padding10">
					<button onclick="passwordSave(getElementById('password-update'), event)" type="submit" class="button small-button primary loading-pulse black-shadow-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	function avatarSave(el, e)
	{
		e.preventDefault();
		var form = $(el);
		var file = form.find('#avatar')[0].files;
		if(file.length==0){
			$.Notify({keepOpen: true, type: 'alert', caption: 'Failed', content: 'Avatar field is required'});
			return;
		}
		var data = new FormData();
		data.append('_token', '{{ csrf_token() }}');
		data.append('_method', 'PUT');
		data.append('avatar', file[0]);
		form.find('button').addClass('loading-cube lighten').html('Saving');
		setTimeout(function(){
			$.ajax({
				url: form.attr('action'),
				type: 'POST',
				data: data,
				cache: false,
				dataType: 'json',
				processData: false,
				contentType: false,
				success: function(data, textStatus, jqXHR)
				{
					$.Notify({type: 'success', caption: 'Success', content: data.success});
					console.log(data);
					form.find('#avatar').val('');
					$('#avatar-image').attr('src', data.avatar)
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					if(jqXHR.status==422){
						var er = jqXHR.responseJSON.avatar;
						var erMsg = '';
						for(var e of er)
							erMsg += e+'<br>';
						$.Notify({keepOpen: true, type: 'alert', caption: 'Failed', content: erMsg });
					}
				}
			});	
			form.find('button').removeClass('loading-cube lighten').html('Save');
		},2000);
		
	}
</script>