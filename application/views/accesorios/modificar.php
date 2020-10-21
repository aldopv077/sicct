
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
					<i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR ACCESORIO
				</h3>
				<p class="text-justify">
					Los campos marcados con * son obligatorios
				</p>
			</div>

			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="<?php echo base_url('Accesorios/index'); ?>"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR ACCESORIO</a>
					</li>
					<li>
						<a href="<?php echo base_url('Accesorios/lista'); ?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR ACCESORIO</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content here-->
			<div class="container-fluid">
				<form action="<?php echo base_url('Accesorios/update')?>" method="post" class="form-neon" autocomplete="off">
				<?php foreach($accesorio as $value){ ?>
					<fieldset>
					<input type="hidden" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="txtIdAccesorio" id="txtIdAccesorio" maxlength="40" value="<?php echo $value->IdAccesorio; ?>">
						<legend><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Información básica</legend>
						<div class="container-fluid">
							<div class="row">

								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtAccesorio" class="bmd-label-floating">* Accesorio</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" name="txtAccesorio" id="txtAccesorio" maxlength="40" value="<?php echo $value->Accesorio; ?>">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="txtMedida" class="bmd-label-floating">* Medida</label>
										<input type="text" class="form-control" name="txtMedida" id="txtMedida" maxlength="40" value="<?php echo $value->Medida; ?>">
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

