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
					<i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR CLIENTE
				</h3>
				<p class="text-justify">
					Los campos marcados con * son obligatorios
				</p>
			</div>

			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="<?php echo base_url('Clientes/index'); ?>"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR CLIENTE</a>
					</li>
					<li>
						<a href="<?php echo base_url('Clientes/lista'); ?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CLIENTE</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content here-->
			<div class="container-fluid">
				<form action="<?php echo base_url('Clientes/update'); ?>" method="post" class="form-neon" autocomplete="off">
				<?php foreach($clientes as $value){ ?>
				
				    <input type="hidden" pattern="[a-zA-Z0-9-]{1,27}" class="form-control" name="txtIdCliente" id="txtIdCliente" maxlength="27" value="<?php echo $value->IdCliente; ?>">
					    <fieldset>
						    <legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
						    <div class="container-fluid">
							    <div class="row">
								    <div class="col-12 col-md-6">
									    <div class="form-group">
										    <label for="txtNombre" class="bmd-label-floating">* Nombre</label>
										    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="txtNombre" id="txtNombre" maxlength="40" value="<?php echo $value->Nombre; ?>">
									    </div>
								    </div>
								    <div class="col-12 col-md-4">
									    <div class="form-group">
										    <label for="txtRFC" class="bmd-label-floating">* RFC</label>
										    <input type="text"  class="form-control" name="txtRFC" id="txtRFC" maxlength="40" value="<?php echo $value->RFC?>">
									    </div>
								    </div>
								    <div class="col-12 col-md-4">
									    <div class="form-group">
										    <label for="txtDireccion" class="bmd-label-floating">* Dirección</label>
										    <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ#- ]{1,150}" class="form-control" name="txtDireccion" id="txtDireccion" maxlength="150" value="<?php echo $value->Direccion;?>">
									    </div>
								    </div>
								    <div class="col-12 col-md-4">
									    <div class="form-group">
										    <label for="txtTelefono" class="bmd-label-floating">* Teléfono</label>
										    <input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtTelefono" id="txtTelefono" maxlength="20" value="<?php echo $value->Telefono;?>">
									    </div>
								    </div>
								    
								    <div class="col-12 col-md-4">
									    <div class="form-group">
										    <label for="txtEmail" class="bmd-label-floating">* Email</label>
										    <input type="email"  class="form-control" name="txtEmail" id="txtEmail" maxlength="30" value="<?php echo $value->Correo;?>">
									    </div>
								    </div>
							    </div>
							
							    <legend><i class="fas fa-user"></i> &nbsp; Información del contacto</legend>
							    <div class="row">

								    <div class="col-12 col-md-6">
									    <div class="form-group">
										    <label for="txtNombreContacto" class="bmd-label-floating">* Nombre</label>
										    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="txtNombreContacto" id="txtNombreContacto" maxlength="40" value="<?php echo $value->Nombrecontacto;?>">
									    </div>
								    </div>
								    <div class="col-12 col-md-4">
									    <div class="form-group">
										    <label for="txtTelefonoContacto" class="bmd-label-floating">Teléfono</label>
										    <input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtTelefonoContacto" id="txtTelefonoContacto" maxlength="20" value="<?php echo $value->TelefonoContacto; ?>">
									    </div>
								    </div>
								
							    </div>
						    </div>
				        </fieldset>
				    <?php
                    }
                    ?>
					<br><br><br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
					 </p>
				</form>
			</div>	