<h3 class="text-center">Departments</h3>
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
  <th width="10px">#</th>
  <th>Name</th>
</tr>
</thead>
<tbody>
<?php $no = 1; ?>
@foreach($data as $d)
<tr>
  <td>{{ $no }}</td>
  <td>{{ $d->name }}</td>
</tr>
<?php $no++ ?>
@endforeach
</table>