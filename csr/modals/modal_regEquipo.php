	<!-- Modal -->
	<div class="modal fade" id="nuevoEquipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class='fa fa-plus'></i> Nuevo equipo</h4>
				</div>
				<form class="form-horizontal" method="post" action="controlers/registrar_equipo.php">
					<div class="modal-body">
						<div class="panel panel-primary">
						<div class="panel-heading">Datos del encargado</div>
						<div class="panel-body">
							<!-- NOMBRE -->
							<div class="form-group">
								<div class="col-sm-6">
									<label for="p_nombre">Nombre</label>
									<input class="form-control" placeholder="Ingrese nombre" name="p_nombre" required>
								</div>
								<div class="col-sm-6">
									<label for="p_ape">Apellidos</label>
									<input type="text" class="form-control" placeholder="ingrese apellidos" name="p_ape" required>
								</div>
							</div>
							<!-- Puesto -->
							<div class="form-group">
								<div class="col-sm-6">
									<label for="p_puesto">Puesto</label>
									<input type="text" class="form-control" placeholder="Ingrese Puesto" name="p_puesto" required title="Completa este campo">
								</div>

								<div class="col-sm-6">
									<label for="p_correo">Correo</label>
									<input type="email" class="form-control" placeholder="Ingrese Email" name="p_correo" required>
								</div>
							</div>
							<!-- Sucursal -->
							<div class="form-group">
								<div class="col-sm-6">
									<label for="p_sucursal">Sucursal</label>
									<input type="text" class="form-control" placeholder="Ingrese Sucursal o Departamento" name="p_sucursal" required title="Ingresa sucursal o departamento" maxlength="15">
								</div>
								<div class="col-sm-6">
									<label for="p_depto">Planta/Depto</label>
									<input type="text" class="form-control" placeholder="Ingrese Planta o Departamento" name="p_depto" required title="Ingresa planta o departamento" maxlength="15">
								</div>
							</div>
						</div>
					</div>

					<div class="panel panel-primary">
					<div class="panel-heading">Datos del equipo</div>
					<div class="panel-body">
							<div class="form-group">
								<div class="col-sm-4">
									<label for="e_tipo">Tipo de equipo...</label>
									<select class="form-control" name="" id="e_tipo">
										<option value="PC">Desktop</option>
										<option value="LAPTOP">Laptop</option>
									</select>
								</div>

								<div class="col-sm-4">
									<label for="e_marca">Marca</label>
									<input type="text" class="form-control" placeholder="Marca" name="e_marca" maxlength="4" required>
								</div>

								<div class="col-sm-4">
									<label for="e_modelo">Modelo</label>
									<input type="text" class="form-control" placeholder="Modelo" name="e_modelo" maxlength="15" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-6">
									<label for="e_nserie">No. de serie</label>
									<input type="text" class="form-control" placeholder="No. serie" name="e_nserie" required>
								</div>

								<div class="col-sm-6">
									<label for="e_nproducto">No. de producto</label>
									<input type="text" class="form-control" placeholder="No. producto" name="e_nproducto" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-6">
									<label for="e_factura">No. de Factura</label>
									<input type="text" class="form-control" placeholder="No. factura" name="e_factura" required>
								</div>

								<div class="col-sm-6">
									<label for="e_fechaf">Fecha factura</label>
									<input type="date" class="form-control" placeholder="Fecha factura" name="e_fechaf" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-4">
									<label for="e_dduro">Disco Duro</label>
									<select class="form-control" name="" id="e_dduro">
										<option value="120GB">120 GB</option>
										<option value="160GB">160 GB</option>
										<option value="320GB">320 GB</option>
										<option value="500GB">500 GB</option>
										<option value="1TB">1 TB</option>
									</select>
								</div>

								<div class="col-sm-4">
									<label for="e_mram">RAM</label>
									<select class="form-control" name="" id="e_ram">
										<option value="1GB">1 GB</option>
										<option value="2GB">2 GB</option>
										<option value="4GB">4 GB</option>
										<option value="6GB">6 GB</option>
										<option value="8GB">8 TB</option>
									</select>
								</div>

								<div class="col-sm-4">
									<label for="e_os">SO</label>
									<select class="form-control" name="" id="e_os">
										<option value="wXP">Windows XP</option>
										<option value="w7">Windows 7</option>
										<option value="w8">Windows 8</option>
										<option value="w8.1">Windows 8.1</option>
										<option value="w10">Windows 10</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<label for="e_comentario">Comentarios</label>
									<textarea class="form-control" rows="3" id="e_comentario" name="e_comentario" placeholder="..."></textarea>
								</div>
							</div>
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
