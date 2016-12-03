	<!-- Modal -->
	<div class="modal fade" id="edt_Persona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class='fa fa-pencil'></i> Modificar Persona</h4>
				</div>
				<form class="form-horizontal" method="post" action="controlers/editar_persona.php">
					<div class="modal-body">
						<!-- NOMBRE -->
						<div class="form-group">
							<label for="nomPersona" class="col-sm-3 control-label">Nombre</label>
							<div class="col-sm-8">
								<input class="form-control" placeholder="Ingrese nombre" id="nomPersona" name="nomPersona" required>
								 <input type="hidden" value="" id="codPersona" name="codPersona">
							</div>
						</div>
						<!-- APELLIDOS -->
						<div class="form-group">
							<label for="apePersona" class="col-sm-3 control-label">Apellidos</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" placeholder="ingrese nombre" id="apePersona" name="apePersona" required>
							</div>
						</div>
						<!-- DNI -->
						<div class="form-group">
							<label for="dniPersona" class="col-sm-3 control-label">Dni</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" placeholder="Ingrese Dni" id="dniPersona" name="dniPersona" required  maxlength="8">
							</div>
						</div>
						<!-- EMAIL -->
						<div class="form-group">
							<label for="emaPersona" class="col-sm-3 control-label">E-mail</label>
							<div class="col-sm-7">
								<input type="email" class="form-control" placeholder="Ingrese Email" id="emaPersona" name="emaPersona" required>
							</div>
						</div>
						<!-- TELEFONO -->
						<div class="form-group">
							<label for="telPersona" class="col-sm-3 control-label">Telefono</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" placeholder="Ingrese telefono" id="telPersona" name="telPersona"  maxlength="9">
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
