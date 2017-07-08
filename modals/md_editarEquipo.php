	<!-- Modal -->
	<div class="modal fade" id="edt_Equipo" tabindex="-5" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class='fa fa-pencil'></i> Modificar Equipo MEXQ </h4>
				</div>
				<form class="form-horizontal" method="post" action="controlers/editar_equipo.php">
					<div class="modal-body">
						<!-- NOMBRE -->
						<div class="form-group">
							<label for="cod_equipo" class="col-sm-3 control-label">Codigo</label>
							<div class="col-sm-8">
								<input class="form-control" placeholder="Ingrese nombre" id="cod_equipo" name="cod_equipo" readonly>
								 <input type="hidden" value="" id="cod_equipo_POST" name="cod_equipo_POST">
							</div>
						</div>
						<!-- APELLIDOS -->
						<div class="form-group">
							<label for="Edit_modelo" class="col-sm-3 control-label">Modelo</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" placeholder="ingrese nombre" id="Edit_modelo" name="Edit_modelo" required>
							</div>
						</div>
						<!-- DNI -->
						<div class="form-group">
							<label for="Edit_nserie" class="col-sm-3 control-label">Numero de serie</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" placeholder="Ingrese serie" id="Edit_nserie" name="Edit_nserie" required>
							</div>
						</div>
						<!-- EMAIL -->
						<div class="form-group">
							<label for="Edit_nproducto" class="col-sm-3 control-label">Numero de producto</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" placeholder="Ingrese Email" id="Edit_nproducto" name="Edit_nproducto" required>
							</div>
						</div>
						<!-- TELEFONO -->
						<div class="form-group">
							<label for="Edit_factura" class="col-sm-3 control-label">Numero de factura</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" placeholder="Ingrese telefono" id="Edit_factura" name="Edit_factura"  maxlength="9">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary" id="guardar_datos">Actualizar datos</button>
					</div>
				</form>
			</div>
		</div>
	</div>
