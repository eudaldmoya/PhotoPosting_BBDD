<?php
include "protege.php";
?>
<html>
    <HEAD>
        <a href="principal.php" class="bot2">Volver a Inicio</a>
         <meta charset="utf-8">
<TITLE>Insertar Foto</TITLE>
<link href="css/estils.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
    <div class="container">
    <br><br>
    <h1 class="tit">Introduzca los siguientes campos:</h1>
    <br><br>

<form action="subirfoto.php" method="post" enctype="multipart/form-data" class="formc">
<label for="userfile" class="t2">Nombre del archivo:</label><br><br>
<input type="file" name="userfile" id="userfile" /><br><br>

<label for="titol" class="t2" >Titulo:</label><br><br>
<input type="text" name="titol" id="titol" maxlength="100"/><br><br>

<label for="descripcio" class="t2" >Descripcion:</label><br><br>
<input type="text" name="descripcio" id="descripcio" maxlength="50"/><br><br>
<br />
<input type="submit" name="submit" value="Submit" />
</form><br><br>
        </div>
</body>
</html> 