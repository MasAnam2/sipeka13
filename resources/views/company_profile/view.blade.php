<div class="row">
  <div class="col-md-12">
    <table class="table table-striped table-bordered">
      <tbody>
        <tr>
          <td>Name</td>
          <td>{!! $d->name ? $d->name : merah('NOT SET') !!}</td>
        </tr>
        <tr>
          <td>Contact</td>
          <td>{!! $d->contact ? $d->contact : merah('NOT SET') !!}</td>
        </tr>
        <tr>
          <td>Address</td>
          <td>{!! $d->address ? $d->address : merah('NOT SET') !!}</td>
        </tr>
        <tr>
          <td>Email</td>
          <td>{!! $d->email ? $d->email : merah('NOT SET') !!}</td>
        </tr>
        <tr>
          <td>Facebook Link</td>
          <td>{!! $d->fb_link ? '<a href="'.$d->fb_link.'" target="_blank">'.$d->fb_link.'</a>' : merah('NOT SET') !!}</td>
        </tr>
        <tr>
          <td>Logo Export</td>
          <td>{!! $d->logo_export ? '<img style="max-width: 120px; max-height: 120px;" src="'.asset('storage/'.$d->logo_export).'">' : merah('NOT SET') !!}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>