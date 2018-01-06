@stack('modal')
<div class="modal fade" role="dialog" id="profileModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-widget widget-user-2">
							<div class="widget-user-header bg-blue">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<div class="widget-user-image">
									<img class="img-circle" src="{{ active_avatar() }}" alt="User Avatar">
								</div>
								<h3 class="widget-user-username">{{ Auth::user()->username }}</h3>
								<h5 class="widget-user-desc">{{ level(Auth::user()->level) }}</h5>
							</div>
							<div class="box-body no-padding">
								<table class="table">
									<tbody>
									@if(Auth::id()==1)
									@php
										$user = App\Models\AdminBio::find(1);
									@endphp
									@else
									@php
										$user = Auth::user()->emp()->first();
									@endphp
									@endif
										<tr>
											<td><strong>Name</strong></td>
											<td>{{ $user->name }}</td>
										</tr>
										<tr>
											<td><strong>Gender</strong></td>
											<td>{{ gender($user->gender) }}</td>
										</tr>
										<tr>
											<td><strong>City, Birthdate</strong></td>
											<td>{{ $user->born_in }}, {!! invalidDate($user->birthdate) ? merah('INVALID') : english_date($user->birthdate) !!}</td>
										</tr>
										<tr>
											<td><strong>Address</strong></td>
											<td>{{ $user->address }}</td>
										</tr>
										@if(Auth::id()!=1)
										<tr>
											<td><strong>Department</strong></td>
											<td>{!! $user->dep ? $user->dep->name : merah('NOT SET') !!}</td>
										</tr>
										<tr>
											<td><strong>Position</strong></td>
											<td>{!! $user->pos ? $user->pos->name : merah('NOT SET') !!}</td>
										</tr>
										@endif
										<tr>
											<td><strong>Username</strong></td>
											<td>{{ Auth::user()->username }}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="box-footer">
								<button class="btn btn-primary btn-sm" onclick="editAvatar(event)">Edit Avatar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
</div>
<div class="modal fade" role="dialog" id="avatarModal">
	<div class="modal-dialog">
		<form action="{{ route('avatar.update') }}" id="change-avatar-form" onsubmit="updateAvatar(event, this)">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="PUT">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Change Avatar</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="avatar">Avatar</label>
								<input type="file" class="form-control" name="avatar" id="avatar" onchange="checkimage(this.value)" required>
								<span class="help-block"><strong></strong></span>
							</div>
						</div>
					</div>
					<div class="alert alert-info alert-dismissible">
						<h4><i class="icon fa fa-info"></i> Please read!</h4>
						No more than 300kb. <br>
						Min dimension 150x150 and max 512x512 <br>
						Allowed Extension are PNG and JPG.
					</div>
				</div>
				<div class="modal-footer">
					<div class="pull-left btn-group">
						{{ simpanBtn('Save changes') }}
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
{{-- <div class="modal fade" role="dialog" id="passwordModal">
	<div class="modal-dialog">
		<form action="{{ route('password.update') }}" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="PUT">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Change Password</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" min="6" name="password" id="password" placeholder="Insert password" required class="form-control">
					</div>
					<div class="form-group">
						<label for="password_confirmation">Password Confirmation</label>
						<input type="password" min="6" name="password_confirmation" id="password_confirmation" placeholder="Insert password confirmation" required class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<div class="pull-left btn-group">
						{{ save_button() }}
					</div>
				</div>
			</div>
		</form>
	</div>
</div> --}}

<!--This is Free Modal-->
<div class="modal fade" role="dialog" id="freeModal">
	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm btn-flat pull-left" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>