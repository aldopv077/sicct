
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
					<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO PRODUCTO
				</h3>
				<p class="text-justify">
					Los campos marcados con * son obligatorios
				</p>
			</div>
			
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a class="active" href="<?php echo base_url('Productos/index');?>"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO PRODUCTO</a>
					</li>
					<li>
						<a href="<?php echo base_url('Productos/lista');?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR PRODUCTO</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
				<form action="<?php echo base_url('Productos/ingresar'); ?>" method="post" class"form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="fas fa-tshirt"></i> &nbsp; Información general</legend>
						<div class="container-fluid">
							<div class="row">
								
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtClave" class="bmd-label-floating">* Clave del corte</label>
										<input type="text"  class="form-control" name="txtClave" id="txtClave" maxlength="20">
									</div>
								</div>
								
								<div class="col-12 col-md-6">
									<div class="form-group">
									    <label for="cmbCliente" class="bmd-label-floating">* Cliente</label>
										<select class="form-control" name="cmbCliente" id="cmbCliente">
										    <option value="0">Seleccione una opción</option>
											<?php 
                                                foreach ($clientes as $value){
                                            ?>
                                                <option value="<?php echo $value->IdCliente?>"><?php echo $value->Nombre?></option>
                                            <?php        
                                                }
                                            ?>
										</select>
									</div>
								</div>
								
								<div class="col-12 col-md-6">
									<div class="form-group">
									    <label for="cmbTProducto" class="bmd-label-floating">* Tipo de prenda</label>
									    
										<select class="form-control" name="cmbTProducto" id="cmbTProducto">
											<option value="0">Seleccione una opción</option>
											<?php 
                                                foreach ($tproducto as $value){
                                            ?>
                                                <option value="<?php echo $value->IdTproducto?>"><?php echo $value->TipoProducto?></option>
                                            <?php        
                                                }
                                            ?>
										</select>
									</div>
								</div>
								
								
								<div class="col-12 col-md-6">
									<div class="form-group">
									    <label for="cmbEstado" class="bmd-label-floating">* Estado del corte</label>
										<select class="form-control" name="cmbEstado" id="cmbEstado">
											<option value="0">Seleccione una opción</option>
											<?php 
                                                foreach ($estados as $value){
                                            ?>
                                                <option value="<?php echo $value->IdDepartamento?>"><?php echo $value->Departamento?></option>
                                            <?php        
                                                }
                                            ?>
										</select>
									</div>
								</div>
								
								
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtTPiezas" class="bmd-label-floating">* Total de piezas</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtTPiezas" id="txtTPiezas" maxlength="20">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtSesiones" class="bmd-label-floating">* Numero de sesiones</label>
										<input type="text" pattern="[a-zA-Z0-99áéíóúÁÉÍÓÚñÑ()# ]{1,190}" class="form-control" name="txtSesiones" id="txtSesiones" maxlength="190">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="dtIngreso" class="bmd-label-floating">* Fecha de ingreso</label>
										<input type="date" class="form-control" name="dtIngreso" id="dtIngreso" maxlength="190">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="dtEntrega" class="bmd-label-floating">* Fecha de entrega</label>
										<input type="date" class="form-control" name="dtEntrega" id="dtEntrega" maxlength="190">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="cmbPara" class="bmd-label-floating">* Prenda para</label>
										<select class="form-control" name="cmbPara" id="cmbPara">
											<option value="0">Seleccione una opción</option>
											<option value="Niño">Niño/Niña</option>
											<option value="Dama">Dama</option>
											<option value="Caballero">Cabellero</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<br><br><br>
					
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
				</form>
			</div>