<?php 

include "../conexion.php";
$cn = Conectarse();	

$id=$_POST['cod_equipo_POST'];
$Emodelo=$_POST['Edit_modelo'];
$Enserie=$_POST['Edit_nserie'];
$Enproducto=$_POST['Edit_nproducto'];
$Efactura=$_POST['Edit_factura'];
	
 	$sql="UPDATE equipos SET modelo='$Emodelo',numero_serie='$Enserie',numero_producto='$Enproducto',numero_factura='$Efactura' WHERE cod_equipo='$id'";

$query = $cn->query($sql);

if ($query!=null) {
	
	header('Location: ../principal.php');


}else{

	echo "<script>alert('Hubo error al momento de modificar el registro.');</script>";
}
?>