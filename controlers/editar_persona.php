<?php 
include "../conexion.php";
$cn = Conectarse();	

$id=$_POST['codPersona'];
$nombre=$_POST['nomPersona'];
$apellido=$_POST['apePersona'];
$dni=$_POST['dniPersona'];
$email=$_POST['emaPersona'];
$telefono=$_POST['telPersona'];

 	$sql="UPDATE personas SET cPerNombre = '$nombre',cPerApellido='$apellido',cPerTelefono='$telefono',cPerDni='$dni',cPerEmail='$email' WHERE nPerCodigo='$id'";

$query = $cn->query($sql);

if ($query!=null) {

	header('Location: ../index.php');


}else{

	echo "<script>alert('Hubo error al momento de modificar el registro.');</script>";
}

?>