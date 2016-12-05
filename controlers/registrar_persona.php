<?php 
include "../conexion.php";
$cn = Conectarse();	

if(isset($_POST['nomPersona'])){

$nombre=$_POST['nomPersona'];
$apellido=$_POST['apePersona'];
$dni=$_POST['dniPersona'];
$email=$_POST['emaPersona'];
$telefono=$_POST['telPersona'];


 $sql = "INSERT INTO personas (cPerNombre, cPerApellido, cPerTelefono, cPerDni,cPerEmail)
    			        	VALUES ('$nombre', '$apellido', '$telefono','$dni','$email')";

$query = $cn->query($sql);

if ($query!=null) {

	echo "<script>alert('Registro exitoso!');</script>";
	header('Location: ../index.php');

}else{

	echo "<script>alert('Hubo un error al momento de registrar.');</script>";
}

}

?>