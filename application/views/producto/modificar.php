
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
					<i class="fas fa-plus fa-fw"></i> &nbsp; ACTUALIZAR PRODUCTO
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
					
						<a href="<?php echo base_url('Productos/lista');?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR PRODUCTO</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
				<form action="<?php echo base_url('Productos/update')?>" method="post" class="form-neon" autocomplete="off">
				<?php foreach($producto as $value){?>
				<input type="hidden" name="txtIdCorte" id="txtIdCorte" maxlength="20" value="<?php echo $value->IdProducto?>">
					<fieldset>
						<legend><i class="fas fa-tshirt"></i> &nbsp; Información general</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-6">
									<div class="form-group">
									    <label for="cmbCliente" class="bmd-label-floating">* Cliente</label>
										<div class="form-group">
                                            <?php
                                                $lista = array();
                                                foreach ($clientes as $registro) {
                                                    $lista[$registro->IdCliente] = $registro->Nombre;
                                                }
                                
                                                echo form_dropdown('cmbCliente',$lista,$value->IdCliente, 'class="form-control"', 'id="cmbCliente"');
                                            ?>
                                        </div>
									</div>
								</div>
								
								<div class="col-12 col-md-6">
									<div class="form-group">
									    <label for="cmbTProducto" class="bmd-label-floating">* Tipo de producto</label>
                                            <?php
                                                $lista = array();
                                                foreach ($tproducto as $registro) {
                                                    $lista[$registro->IdTProducto] = $registro->TipoProducto;
                                                }
                                
                                                echo form_dropdown('cmbTProducto',$lista,$value->IdTProducto, 'class="form-control"', 'id="cmbTProducto"');
                                            ?>
									</div>
								</div>
								
								<div class="col-12 col-md-6">
									<div class="form-group">
									    <label for="cmbEstado" class="bmd-label-floating">* Estado del producto</label>
                                            <?php
                                                $lista = array();
                                                foreach ($estados as $registro) {
                                                    $lista[$registro->IdDepartamento] = $registro->Departamento;
                                                }
                                
                                                echo form_dropdown('cmbEstado',$lista,$value->Estado, 'class="form-control"', 'id="cmbEstado"');
                                            ?>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtTPiezas" class="bmd-label-floating">* Total de piezas</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtTPiezas" id="txtTPiezas" maxlength="20" value="<?php echo $value->Totalpiezas;?>">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="txtSesiones" class="bmd-label-floating">* Numero de sesiones</label>
										<input type="text" pattern="[a-zA-Z0-99áéíóúÁÉÍÓÚñÑ()# ]{1,190}" class="form-control" name="txtSesiones" id="txtSesiones" maxlength="190" value="<?php echo $value->NumeroSesiones;?>">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="dtIngreso" class="bmd-label-floating">* Fecha de ingreso</label>
										<input type="date" class="form-control" name="dtIngreso" id="dtIngreso" maxlength="190" value="<?php echo $value->Fechaingreso;?>">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="dtEntrega" class="bmd-label-floating">* Fecha de entrega</label>
										<input type="date" class="form-control" name="dtEntrega" id="dtEntrega" maxlength="190" value="<?php echo $value->Fechasalida;?>">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="cmbPara" class="bmd-label-floating">* Producto para</label>
										<select class="form-control" name="cmbPara" id="cmbPara">
											<option value="0">Seleccione una opción</option>
											<option value="Niño" <?php if($value->Clasificacion === "Niño"){ echo 'selected'; }?>>Niño/Niña</option>
											<option value="Dama" <?php if($value->Clasificacion === "Dama"){ echo 'selected'; }?>>Dama</option>
											<option value="Caballero" <?php if($value->Clasificacion === "Caballero"){ echo 'selected'; }?>>Cabellero</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<?php }?>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
				</form>
			</div>