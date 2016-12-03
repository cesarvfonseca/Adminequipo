	<!-- Modal -->
	<div class="modal fade" id="inst_Perso4na" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class='fa fa-plus'></i> Agregar nueva Persona</h4>
				</div>
				<form class="form-horizontal" method="post" action="controlers/registrar_persona.php">
					<div class="modal-body">
						<!-- NOMBRE -->
						<div class="form-group">
							<label for="nomPersona" class="col-sm-3 control-label">Nombre</label>
							<div class="col-sm-8">
								<input class="form-control" placeholder="Ingrese nombre" name="nomPersona" required>
							</div>
						</div>
						<!-- APELLIDOS -->
						<div class="form-group">
							<label for="apePersona" class="col-sm-3 control-label">Apellidos</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" placeholder="ingrese apellidos" name="apePersona" required>
							</div>
						</div>
						<!-- DNI -->
						<div class="form-group">
							<label for="dniPersona" class="col-sm-3 control-label">Dni</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" placeholder="Ingrese Dni" name="dniPersona" required title="Ingresa sólo números" maxlength="8">
							</div>
						</div>
						<!-- EMAIL -->
						<div class="form-group">
							<label for="emaPersona" class="col-sm-3 control-label">E-mail</label>
							<div class="col-sm-6">
								<input type="email" class="form-control" placeholder="Ingrese Email" name="emaPersona" required>
							</div>
						</div>
						<!-- TELEFONO -->
						<div class="form-group">
							<label for="telPersona" class="col-sm-3 control-label">Telefono</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" placeholder="Ingrese telefono" name="telPersona" required  maxlength="9">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
					</div>
				</form>
			</div>
		</div>
	</div>
