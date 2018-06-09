@if (!empty($success))
	<div class="alert alert-success">
	  <strong>{{ $success }}</strong>
	</div>

@endif
<!-- 
@if (!empty($danges))
	<div class="alert alert-danger">
	  <strong>{{ $danger }}</strong>
	</div>

@endif
-->
@if (!empty($info))
	<div class="alert alert alert-info">
	  <strong>{{ $info }}</strong>
	</div>

@endif
@if (!empty($warning))
	<div class="alert alert-warning">
	  <strong>{{ $warning }}</strong>
	</div>

@endif