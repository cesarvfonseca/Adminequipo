<?php 
include "../conexion.php";
$cn = Conectarse();	

if(isset($_POST['p_nombre'])){

// DATOS DEL RESPONSABLE
$rNombre= utf8_decode($_POST['p_nombre']);
$rApe= utf8_decode($_POST['p_ape']);
$rPuesto = utf8_decode($_POST['p_puesto']);
$rCorreo = utf8_decode($_POST['p_correo']);
$rSucursal = utf8_decode($_POST['p_sucursal']);
$rDepto = utf8_decode($_POST['p_depto']);

#Darle formato a las variables (Iniciales con mayusculas)
$rNombre=ucwords(strtolower($rNombre));
$rApe=ucwords(strtolower($rApe));
$rPuesto=ucwords(strtolower($rPuesto));
$rCorreo=strtolower($rCorreo);
$rSucursal=ucwords(strtolower($rSucursal));
$rDepto=ucwords(strtolower($rDepto));

#FECHA ACTUAL
$rFecha=date('Y-m-d');

#Obtener Codigo
$ultimoId="CALL ultimoidResponsable;";
$query = $cn->query($ultimoId);
while ($r=$query->fetch()):
	$idr=$r["id"];
endwhile;
$idr=$idr+1;
$rCodigo=substr($rNombre, 0,1).substr($rApe, 0,1).$idr;

//Inserta en la tabla Responsables
$sentencia = $dbh->prepare("CALL insertarResponsable(?,?,?,?,?,?,?,?);");
$sentencia->bindParam(1, $rCodigo);
$sentencia->bindParam(2, $rNombre);
$sentencia->bindParam(3, $rApe);
$sentencia->bindParam(4, $rPuesto);
$sentencia->bindParam(5, $rSucursal);
$sentencia->bindParam(6, $rDepto);
$sentencia->bindParam(7, $rCorreo);
$sentencia->bindParam(8, $rFecha);
$sentencia->execute();

// DATOS DEL EQUIPO
$eTipo=$_POST['e_tipo'];
$eMarca=$_POST['e_marca'];
$eModelo=$_POST['e_modelo'];
$eNSerie=$_POST['e_nserie'];
$eNProducto=$_POST['e_nproducto'];
$eFactura=$_POST['e_factura'];
$eFechaf=$_POST['e_fechaf'];
$eDduro=$_POST['e_dduro'];
$eRam=$_POST['e_ram'];
$eOs=$_POST['e_os'];
$eComentario=$_POST['e_comentario'];

#Decidir el tipo de equipo (Switch para mas opciones posteriores)
switch ($eTipo) {
	case 'LAP':
		$eTipo="MQ"
		break;
	case 'PC':
		$eTipo="PC"
		break;
	default:
		break;
}

$eCodifgo = $eTipo.

//Inserta en la tabla Responsables
$sentencia = $dbh->prepare("CALL insertarEquipo(e_codigo,e_tipo,e_marca,e_modelo,e_serie,e_nproducto,e_nfactura,e_ffactura,e_dduro,e_ram,e_os,e_comentarios,e_status,e_responsable);");
$sentencia->bindParam(1, $rCodigo);
$sentencia->bindParam(2, $rNombre);
$sentencia->bindParam(3, $rApe);
$sentencia->bindParam(4, $rPuesto);
$sentencia->bindParam(5, $rSucursal);
$sentencia->bindParam(6, $rDepto);
$sentencia->bindParam(7, $rCorreo);
$sentencia->bindParam(8, $rFecha);
$sentencia->execute();

//  $sql = "INSERT INTO personas (cPerNombre, cPerApellido, cPerTelefono, cPerDni,cPerEmail)
//     			        	VALUES ('$nombre', '$apellido', '$telefono','$dni','$email')";

// $query = $cn->query($sql);

if ($sentencia!=null) {

	echo "<script>alert('Registro exitoso!');</script>";
	header('Location: ../principal.php');

}else{

	echo "<script>alert('Hubo un error al momento de registrar.');</script>";
}

}

?>