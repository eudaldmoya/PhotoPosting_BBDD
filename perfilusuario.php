<?php
include "protege.php";
?>
<HTML>
<HEAD>
    <meta charset="utf-8">
<TITLE>Perfil Usuario</TITLE>
<link href="css/estils.css" rel="stylesheet" type="text/css" />
</HEAD>
<BODY>
    <a href="principal.php" class="bot2">Volver a Inicio</a>

<?php
require("conexion_pdo.php");
//Obertura de connexió
$db = new Conexion();

$nombreusuario = $_SESSION["nom"];
$emailusuario = $_SESSION["usuari"];
    
$consulta="SELECT id, titulo, nombrearchivo, propietario, descripcion FROM p04imagenes WHERE propietario=:u ORDER BY fechahora DESC";
$result = $db->prepare($consulta);
$result->execute(array(":u" => $emailusuario));

if (!$result){
print "<p> Error en la consulta. </p>\n";
}else{
      print("<div><br><br>");
      print("<h1 class=\"t1\">Perfil de ".$nombreusuario."</h1>");
      print("</div><br><br>");
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
?>
</BODY>
</HTML>