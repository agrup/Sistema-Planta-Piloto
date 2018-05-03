<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lotes</title>
</head>
<body>
	<h2>Lotes Por vencer</h2>
</body>@foreach ($lotes as $lote)
	<ul>
		
	<li>	
	<a href="/lotes/{{ $lote->id}}">
		
	{{ $lote->fechaInicio }}
	</a>
	</li>

	</ul>
@endforeach
</html>