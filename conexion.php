<?php

/* CONFIGURACION DE LA BD */

function Conectarse(){

	$db_host		= 'localhost';
	$db_user		= 'root';
	$db_pass		= '';
	$db_database	= 'mqcomp'; 

	try{

		$cn = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);

		$cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	}catch(PDOException $e){

		echo "ERROR: " . $e->getMessage();

	}

	return $cn;
}

	//PARA MODIFICAR DESDE LA TABLA DIRECTAMENTE LA BASE DE DATOS
	define('DB','mqcomp');
	define('USER','root');
	define('PWD','');
	$dbh = new PDO('mysql:host=localhost;dbname='.DB,USER,PWD);

   function conectar()
   {
	$servidor="localhost";
	$usuario="root";
	$password="";
	$bd="mqcomp";
	$conexion=mysql_connect($servidor,$usuario,$password);
	if (!$conexion)
	{
		echo"ERROR AL CONECTARCE CON EL SERVIDOR";
		exit();
	}

	$coneccion=mysql_select_db($bd,$conexion);

	if (!$coneccion)
	{
		echo"ERROR AL ABRIR LA BASE DE DATOS";
		exit();
	}
     	return ($conexion);
   }
?>
