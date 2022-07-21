<?php
include "protege.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php
require_once("conexion_pdo.php");

// Creamos el objeto 
$db = new Conexion();


if ((($_FILES["userfile"]["type"] == "image/gif") || ($_FILES["userfile"]["type"] == "image/jpeg") || ($_FILES["userfile"]["type"] == "image/pjpeg")|| ($_FILES["userfile"]["type"] == "image/png")) && ($_FILES["userfile"]["size"] < 900000))
  {
  if ($_FILES["userfile"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["userfile"]["error"] . "<br />";
    }
  else
    {
    //OK
    echo "Upload: " . $_FILES["userfile"]["name"] . "<br />";
    echo "Type: " . $_FILES["userfile"]["type"] . "<br />";
    echo "Size: " . ($_FILES["userfile"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["userfile"]["tmp_name"] . "<br />";
	
	//Per obtenir extensió
	$path_parts = pathinfo($_FILES["userfile"]["name"]);
	//echo "Dirname ",$path_parts['dirname'], "<br>";
	//echo "Base name ",$path_parts['basename'], "<br>";
	echo "Extension ",$path_parts['extension'], "<br>";
	//echo "Filename ",$path_parts['filename'], "<br>"; // since PHP 5.2.0
	
	$newname="upload/" . date("YmdHis") . "." . $path_parts['extension'];
	$i=0;
		while(file_exists($newname)==true){
			$newname="upload/" .  date("YmdHis") . $i . "." . $path_parts['extension'];
			$i++;
		}
		
		if(move_uploaded_file($_FILES["userfile"]["tmp_name"],$newname)){
		//if(move_uploaded_file($_FILES["userfile"]["tmp_name"],"upload/" . $_FILES["userfile"]["name"])){
			echo "Stored OK! " . $newname;
			
			//INSERT!
			$dbTabla='p04imagenes'; 

			$titol = $_POST["titol"];
			$descr = $_POST["descripcio"];

			$consulta = "INSERT INTO $dbTabla (titulo, descripcion, tipoMIME, tamano, nombrearchivo, fechahora, propietario) VALUES (:t, :d, :m, :s, :n, :f,  :e)"; 

			$result = $db->prepare($consulta);

			if ($result->execute(array(
			":t" => $titol, 
			":d" => $descr, 
			":m" =>$_FILES["userfile"]["type"], 
			":s" => $_FILES["userfile"]["size"] ,
			":n" => $newname, 
			":f" => date("Y-m-d H:i:s"), 
			":e" => $_SESSION["usuari"])))
			 { 
				print "<p>Registro insertado correctamente.</p>\n"; 
			 } else {
				print "<p>Error al insertar el registro.</p>\n"; 
				//Esborrat arxiu
				unlink($newname);
				//https://www.php.net/manual/es/function.unlink.php
			}
			
		}else{
			echo "File could not be stored"; 
		}

		
	}
  }
else
  {
  echo "Invalid file";
  }
  
$db=NULL;
?> 
<a href="principal.php">Inicio</a>
</body>
</html>