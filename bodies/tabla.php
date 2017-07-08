<?php

if(isset($_POST['idPer'])){

	include "../conexion.php";
	
	$cn = Conectarse();		

	$id=$_POST['idPer'];	
	$sql= "SELECT * FROM equipos where cod_equipo='$id'";
	$query = $cn->query($sql);
	$datos =$query->fetchAll();

	echo json_encode($datos);

}

else{

	include "conexion.php";
	$cn = Conectarse();	

	// $sql= "SELECT * FROM equipos";
	$sql= "CALL comp_resp";
	$query = $cn->query($sql);

 	if($query->rowCount()>0):?>
		<div class="col-md-10 col-md-offset-1">
			<div class="table-responsive">
				<table class="table table-sm table-bordered table-hover table-striped table-condensed">
					<thead class="thead-inverse">
						<th>Codigo</th>
						<th>Nombre</th>
						<th>Puesto</th>
						<th>Sucursal</th>
						<th>Planta / Depto</th>
						<th>Marca</th>
						<th>Modelo</th>
						<th>No. Serie</th>
						<th>No. Producto</th>
						<th>No. Factura</th>
						<th>Status</th>
						<th>Comentarios</th>
						<th width="12%">Acciones</th>
					</thead>
					<?php while ($r=$query->fetch()):
					?>
					<tr>
						<td><?php echo $r["cod_equipo"]; ?></td>
						<td><?php echo utf8_encode($r["nombre"]); ?></td>
						<td><?php echo $r["puesto"]; ?></td>
						<td><?php echo $r["sucursal"]; ?></td>
						<td><?php echo $r["planta_depto"]; ?></td>
						<td><?php echo $r["marca"]; ?></td>
						<td><?php echo $r["modelo"]; ?></td>
						<td><?php echo $r["numero_serie"]; ?></td>
						<td><?php echo $r["numero_producto"]; ?></td>
						<td><?php echo $r["numero_factura"]; ?></td>
						<td><?php echo $r["status"]; ?></td>
						<td><?php echo $r["comentarios"];?></td>
						<td>
							<a href="" id="<?php echo $r["cod_equipo"];?>" class="btn btn-sm btn-warning btn-editar" data-toggle="modal" data-target="#edt_Equipo"><i class="fa fa-pencil" aria-hidden="true"></i></a>
							<a href="" id="<?php echo $r["cod_equipo"];?>" class="btn btn-sm btn-danger btn-eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							<a href="<?php echo "bodies/reporte.php?clave=$r[cod_equipo]"?>" class="btn btn-sm btn-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
							<a href="<?php echo "bodies/checklist.php?clave=$r[cod_equipo]"?>" class="btn btn-sm btn-success"><i class="fa fa-address-card-o" aria-hidden="true"></i></a>
						</td>
					</tr>
				<?php endwhile;?>

			</table>
		</div>
	</div>

	<?php  include('modals/md_editarEquipo.php');
	// include('modals/md_registrarPersona.php');
	include('modals/modal_regEquipo.php');
	?>


<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>

<?php 

}

?>
