<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create Trabajador</title>
</head>
<body>
<form method="POST" action="/trabajador">
@csrf
 name:<br>
  <input type="text" name="name" value="Agustin">
  <br>
  Last name:<br>
  <input type="text" name="apellido" value="rod">
  <br><br>

    Legajo:<br>
  <input type="number" name="legajo" value="5004">
  <br><br>

    Seudonimo:<br>
  <input type="text" name="seudonimo" value="agu">
  <br><br>
  <input type="submit" value="Submit">
  
</form>
</body>
</html>
