
			<nav class="full-box navbar-info">
				<a href="#" class="float-left show-nav-lateral">
					<i class="fas fa-exchange-alt"></i>
				</a>
				<a href="user-update.html">
					<i class="fas fa-user-cog"></i>
				</a>
				<a href="<?php echo base_url('Login/cerrar_sesion')?>" class="btn-exit-system">
					<i class="fas fa-power-off"></i>
				</a>
			</nav>

			<!-- Page header -->
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO USUARIO
				</h3>
				<p class="text-justify">
					Los campos marcados con * son obligatorios
				</p>
			</div>
			
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a class="active" href="<?php echo base_url('Usuarios/index');?>"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO USUARIO</a>
					</li>
					<li>
						<a href="<?php echo base_url('Usuarios/lista');?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR USUARIO</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
				<form action="<?php echo base_url('Usuarios/ingresar');?>" method="post" class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="txtNombre" class="bmd-label-floating">* Nombres</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="txtNombre" id="txtNombre" maxlength="35">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="Paterno" class="bmd-label-floating">* Primer Apellido</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="txtPaterno" id="txtPaterno" maxlength="35">
									</div>
								</div>
								
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="txtMaterno" class="bmd-label-floating">Segundo Apellido</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="txtMaterno" id="txtMaterno" maxlength="35">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtTelefono" class="bmd-label-floating">* Teléfono</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtTelefono" id="txtTelefono" maxlength="20">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtDireccion" class="bmd-label-floating">* Dirección</label>
										<input type="text" class="form-control" name="txtDireccion" id="txtDireccion" maxlength="190">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
									    <label for="cmbPuesto" class="bmd-label-floating">* Puesto asignado</label>
										<select class="form-control" name="cmbPuesto" id="cmbPuesto">
											<option value="" selected="" disabled="">Seleccione una opción</option>
											<?php 
                                                foreach ($puestos as $value){
                                            ?>
                                                <option value="<?php echo $value->IdPuesto?>"><?php echo $value->Puesto?></option>
                                            <?php        
                                                }
                                            ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<fieldset>
						<legend><i class="fas fa-user-lock"></i> &nbsp; Información de la cuenta</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtUsuario" class="bmd-label-floating">* Nombre de usuario</label>
										<input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="txtUsuario" id="txtUsuario" maxlength="35">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtEmail" class="bmd-label-floating">* Email</label>
										<input type="email" class="form-control" name="txtEmail" id="txtEmail" maxlength="70">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtpass1" class="bmd-label-floating">* Contraseña</label>
										<input type="password" class="form-control" name="txtpass1" id="txtpass1" maxlength="200">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtpass2" class="bmd-label-floating">* Repetir contraseña</label>
										<input type="password" class="form-control" name="txtpass2" id="txtpass2" maxlength="200">
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<fieldset>
						<legend><i class="fas fa-medal"></i> &nbsp; * Nivel de privilegio</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12">
									<p><span class="badge badge-info">Control total</span> Permisos para registrar, actualizar y eliminar</p>
									<p><span class="badge badge-success">Edición</span> Permisos para registrar y actualizar</p>
									<p><span class="badge badge-dark">Registrar</span> Solo permisos para registrar</p>
									<div class="form-group">
										<select class="form-control" name="cmbRol">
											<option value="0" selected="" disabled="">Seleccione una opción</option>
											<?php
                                                foreach ($perfil as $value){
													if($this->session->userdata('rol') != "SuperAdmin"){
														if($value->IdRol == 1){
															$value->IdRol = 0;
															$value->Rol = "";
														}
													}
													?>	
														<option value="<?php echo $value->IdRol ?>"><?php echo $value->Rol?></option>   
													<?php
                                                }
                                            ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
				</form>
			</div>