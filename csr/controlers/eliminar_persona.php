<?php
include "../conexion.php";
$cn = Conectarse();	

if(isset($_GET['identificador'])){

$id=$_GET["identificador"];
			
	$sql = "DELETE FROM personas WHERE nPerCodigo='$id'";

	$query = $cn->query($sql);

	if($query!=null){
				
			header('Location: ../index.php');

			} else{
			
			echo('No se pudo eliminar el registro.');

			}
}
?>