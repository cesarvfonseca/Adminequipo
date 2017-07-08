<?php 
include "libs/qrcode-lib/qrlib.php";
 ?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Registro de equipos</title>
	<link rel="shortcut icon" href="img/csr.ico"> 
	<link rel="stylesheet" href="libs/css/font-awesome.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div  class="page-header">
			<h1>Registro de equipos<small>&nbsp;<i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;MEXQ</small></h1>
		</div>

		<div class="row">
			<div class="col-md-12 col-md-offset-1">
				<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#nuevoEquipo">
					Agregar
					<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
				</button>
			</div><!-- /.span -->
		</div>
		<div style="padding-top: 10px" class="row">
			<?php 
				include('bodies/tabla.php');
			?>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="libs/general.js"></script>
</body>
</html>