<?php
include "protege.php";
?>
<html>
<head>
<meta charset="utf-8">
<title>Ficha foto</title>
<link rel="stylesheet" href="css/estils.css">
</head>

<body>
     <a href="principal.php" class="bot2">Volver a Inicio</a>
    <br><br>
    <h1 class="t1">Ficha de la Foto</h1>
    <br><br>
<?php 
require_once("conexion_pdo.php");
// Creamos el objeto 
$db = new Conexion();
    //obtencion de datos por GET o SERVER
$idfoto = $_GET['idfoto']; 
 
//consulta para obtener los datos que queremos mostrar
$consulta = "SELECT id, titulo, nombrearchivo, propietario, descripcion FROM p04imagenes WHERE id=:u";
$result = $db->prepare($consulta);
$result->execute(array(":u" => $idfoto));
if (!$result) { 
	print "<p>Error en la consulta.</p>\n";
}else{
    foreach($result as $fila){
      
			print("<div class=\"container\">");
				//Print card amb dades anunci
				print("\t\t<div class=\"cards\">\n");
                print("<a><img src=\"".$fila["nombrearchivo"]."\" class=\"img\">\n</a>");
                print("<h2 class=\"t2\">".$fila["titulo"]."</h2><br><h3 class=\"t3\">".$fila["descripcion"]."</h3>");
				
				print("\t\t</div>\n");
                print("\t\t</div>\n");
	
     }
       
}

//Cerramos conexión
$db=NULL;
?>
</body>
</html>