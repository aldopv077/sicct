<!-- Page content -->
<?php foreach($taller as $value){?>
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
					<i class="fas fa-plus fa-fw"></i> &nbsp; MODIFICAR TALLER
				</h3>
				<p class="text-justify">
				    Los campos marcados con (*) son obligatorios 
				</p>
			</div>

			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="<?php echo base_url('Talleres/index')?>"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR TALLER</a>
					</li>
					<li>
						<a href="<?php echo base_url('Talleres/lista')?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR TALLER</a>
				</ul>	
			</div>
			
			<!-- Content here-->
			<div class="container-fluid">
				<form name="frmAgregarTaller" action="<?php echo base_url('Talleres/update')?>" method="post" class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
						<div class="container-fluid">
							<div class="row">
								<input type="hidden" name="txtId" Id="txtId" value="<?php echo $value->IdExterno?>">
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtNombre" class="bmd-label-floating">* Nombre</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="txtNombre" id="txtNombre" maxlength="40" value="<?php echo $value->Nombre?>" required>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="txtApPaterno" class="bmd-label-floating">* Primer Apellido</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="txtApPaterno" id="txtApPaterno" maxlength="40" value="<?php echo $value->ApPaterno?>"required>
									</div>
								</div>
								
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="txtApMaterno" class="bmd-label-floating">Segundo Apellido</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="txtApMaterno" id="txtApMaterno" maxlength="40" value="<?php echo $value->ApMaterno?>">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="txtTelefono" class="bmd-label-floating">Teléfono</label>
										<input type="text" class="form-control" name="txtTelefono" id="txtTelefono" maxlength="20" value="<?php echo $value->Telefono?>">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="txtDireccion" class="bmd-label-floating">* Dirección</label>
										<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ#- ]{1,150}" class="form-control" name="txtDireccion" id="txtDireccion" maxlength="150" required value="<?php echo $value->Direccion?>">
									</div>
								</div>
							</div>
						</div>
					</fieldset>
<?php }?>
					<br><br><br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
				</form>
			</div>	
