<?PHP
	$mail = $_POST["email"];
	$pas = $_POST["pass"];

	require_once("conexion_pdo.php");
	// Creamos el objeto 
	$db = new Conexion();
	
	$dbTabla='p04usuarios'; 

	//$consulta = "SELECT COUNT(*) FROM $dbTabla WHERE email=:log AND password=:pas"; 
	$consulta = "SELECT COUNT(*) FROM $dbTabla WHERE email=:log AND contrasena=:pas"; 
	$result = $db->prepare($consulta);
	$result->execute(array(":log" => $mail, ":pas" => md5($pas)));
	$total = $result->fetchColumn();


	if($total==1){

			//$consulta = "SELECT * FROM $dbTabla WHERE email=:log AND password=:pas";
			$consulta = "SELECT * FROM $dbTabla WHERE email=:log AND contrasena=:pas"; 			
			$result = $db->prepare($consulta);
			$result->execute(array(":log" => $mail, ":pas" => md5($pas)));
			
			if (!$result) { 
				print "<p>Error en la consulta.</p>\n";
				//header("location:login.php");
			}else{
				session_start();
				$fila=$result->fetchObject();
				
				$_SESSION["usuari"] = $fila->email;
				$_SESSION["nom"] = $fila->nombreusuario;
				header("location:principal.php");
			}
	}else{
		header("location:index.php");
	}
	
?>