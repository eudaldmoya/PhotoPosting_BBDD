<?php
session_start();
//if((!isset($_SESSION["usuari"])) || ($_SESSION["usuari"]<0)){
if(!isset($_SESSION["usuari"])){
	header("location:index.php");
}
?>