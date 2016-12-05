<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro de equipos</title>
	<link rel="shortcut icon" href="img/csr.ico"> 
	<link rel="stylesheet" href="libs/css/font-awesome.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>
<body>
	<div class="container-fluid">
		<div  class="page-header">
			<h1>Registro de equipos<small>&nbsp;<i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;MEXQ</small></h1>
		</div>

		<div class="row">
			<div class="col-md-2 col-md-offset-10">
				<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#nuevoEquipo">
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
