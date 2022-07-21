<?php
include "protege.php";
?>
<HTML>
<HEAD>
<TITLE>Imagenes</TITLE>
    <meta charset="utf-8">
<link href="css/estils.css" rel="stylesheet" type="text/css" />
</HEAD>
<BODY>
    <br>
    <div class="precontainer2">
        <a href="logout.php" class="bot2">Log out</a>
        <div class="precontainer">
            <h1 class="t1">Bienvenido a la aplicación de imágenes</h1>
        </div>
    </div>
    <div class="cards2">
<h1 class="t2">Hola <? echo $_SESSION["nom"];?></h1>
    <?php 
    print("<p><a href=\"perfilusuario.php?idusuario=".$fila["propietario"]."\" class=\"bot3\">Perfil Usuario</a></p>\n");
    ?>
        </div>
    <div class="precontainer">
    
<form name="busqueda" action="buscarfoto.php" method="GET">
	<label for="exprbusqueda"></label>
	<input type="search" name="exprbusqueda" id="exprbusqueda" placeholder="Introduce una palabra"><br><br>
	<input type="submit" value="Enviar" class="bot">
</form><br><br>
            
            <a href="anadirfoto.php" class="bot">Insertar Foto</a>
            
        </div>

<?php
require("conexion_pdo.php");
$ses=$_SESSION["nom"];
//Obertura de connexió
$db = new Conexion();
$consulta="SELECT * FROM p04imagenes WHERE propietario!= \"".$_SESSION["usuari"]."\"";
$result = $db->query($consulta);
    
if (!$result){
print "<p> Error en la consulta. </p>\n";
}else{
    $j=0;
   
    //print("\t<div class=\"flex-container mt-2\">\n");
      foreach($result as $fila){
      if($j<6){
	  
          
		
			//Print column de 4, per situar-hi card
			//print("\t<div class=\"col-sm-4\">\n");			
				print("<div class=\"container\">");
				//Print card amb dades anunci
				print("\t\t<div class=\"cards\">\n");
                print("<a href=\"fichafoto.php?idfoto=".$fila["id"]."\"><img src=\"".$fila["nombrearchivo"]."\" class=\"img\">\n</a>");
                print("<h2 class=\"t2\">".$fila["titulo"]."</h2><br><h3 class=\"t3\">".$fila["descripcion"]."</h3>");
				
				print("\t\t</div>\n");
                print("\t\t</div>\n");
				//print("\t\t</div>\n");
			
			//Tancament de column
			//print("\t</div>\n");
		$j++;
		
			
	}
     }
    //print("</div>\n"); 
}
?>

</BODY>
</HTML>