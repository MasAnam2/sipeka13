<div class="row">
	<div class="col-md-6">
		{{ input_text('name', '', $d->name, '') }}
	</div>
	<div class="col-md-6">
		{{ input_text('contact', '', $d->contact, '') }}
	</div>
	<div class="col-md-6">
		{{ input_text('email', '', $d->email, '') }}
	</div>
	<div class="col-md-6">
		{{ input_text('fb_link', '', $d->fb_link, '') }}
	</div>
	<div class="col-md-12">
		{{ textarea('address', '', $d->address) }}
	</div>
	<div class="col-md-6">
		{{ input_file('logo_export', '') }}
	</div>
</div>