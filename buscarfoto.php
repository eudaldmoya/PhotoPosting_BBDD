<?php
include "protege.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Resultados de búsqueda</title>
<link href="css/estils.css" rel="stylesheet" type="text/css" />
</head>

<body>
     <a href="principal.php" class="bot2">Volver a Inicio</a>
<?
$expresio=$_GET["exprbusqueda"];

require_once("conexion_pdo.php");


$db = new Conexion();

$dbTabla='p04imagenes';
$consulta = "SELECT COUNT(*) FROM $dbTabla WHERE MATCH(titulo,descripcion) AGAINST ('$expresio')";
//echo $consulta;
$result = $db->prepare($consulta);
$result->execute(); 
$total = $result->fetchColumn();
if ($total>0) { 
    print("<div class=\"precontainer\">");
	print "<h2 class=\"t2\">Hay $total resultados para <em>$expresio</em></h2>\n";
    print("</div>");
    
	$consulta = "SELECT * FROM $dbTabla WHERE MATCH(titulo,descripcion) AGAINST ('$expresio')";
	$result = $db->prepare($consulta); 
	$result->execute();
	
	if (!$result){ 
		print "<p> Error en la consulta. </p>\n";
	}else{ 
		foreach($result as $fila){
      
			print("<div class=\"container\">");
				//Print card amb dades anunci
				print("\t\t<div class=\"cards\">\n");
                print("<a href=\"fichafoto.php?idfoto=".$fila["id"]."\"><img src=\"".$fila["nombrearchivo"]."\" class=\"img\">\n</a>");
                print("<h2 class=\"t2\">".$fila["titulo"]."</h2><br><h3 class=\"t3\">".$fila["descripcion"]."</h3>");
				
				print("\t\t</div>\n");
                print("\t\t</div>\n");
	
     }
	}
}else{
	
	
	print "<h2 class=\"t2\">No hay resultados para <em>$expresio</em></h2>";
}
//Cerramos conexión
$db=NULL;
?>
    <br><br>
    <div class="precontainer">
<form name="busqueda" action="buscarfoto.php" method="GET">
	<label for="exprbusqueda"></label>
	<input type="search" name="exprbusqueda" id="exprbusqueda" placeholder="Introduce una palabra"><br><br>
	<input type="submit" value="Enviar" class="bot">
</form>
        </div>
</body>
</html>