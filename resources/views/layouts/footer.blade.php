<footer class="main-footer">
	<div class="pull-right hidden-xs">
		This system created by {{ appCreator() }}
		<b>Version</b> {{ appVersion() }}
	</div>
	<strong>Copyright &copy; @if(date('Y')==appYearBuild()) {{ appYearBuild() }} @else {{ appYearBuild() }} - {{ date('Y') }} @endif <a href="#">{{ appName() }}</a>.</strong> All rights
	reserved.
</footer>