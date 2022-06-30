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
					<i class="fas fa-search fa-fw"></i> &nbsp; PRODUCCIÓN INTERNA
				</h3>
				<p class="text-justify">
					Seleccionar la operación que desea supervisar
				</p>
			</div>
			
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="<?php echo base_url('ProduccionInt/index');?>"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO AVANCE</a>
					</li>
					<li>
						<a class="active" href="<?php echo base_url('ProduccionInt/lista');?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR AVANCE</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
				<form name="FrmBuscarUsuario" class="form-neon" action="<?php echo base_url('ProduccionInt/consulta')?>" method="post">
					<div class="container-fluid">
						<div class="row justify-content-md-center">
							<div class="col-4 col-md-4">
								<div class="form-group">
									<label for="txtOperaciones" class="bmd-label-floating">¿Qué operación estas buscando?</label>
									<input name="txtOperaciones" Id="txtOperaciones" type="search" class="form-control" list="Operaciones">
									<datalist id="Operaciones">
                                        <?php
                                            foreach ($operaciones as $key) {
                                                print '<option value="'.$key->IdOperacion .' '. $key->Operacion.'"></option>';
                                            }
                                        ?>
                                    </datalist>
								</div>
							</div>

                            <div class="col-4 col-md-4">
                                <div class="form-group">
                                    <label for="txtProducto" class="bmd-label-floating">¿Qué corte está supervisando?</label>
                                    <input name="txtProducto" Id="txtProducto" type="search" class="form-control" list="Producto">
                                        <datalist id="Producto">
                                            <?php
                                                foreach ($cortes as $key) {
                                                    print '<option value="'.$key->IdProducto .' '. $key->Clave.'"></option>';
                                                }
                                            ?>
                                        </datalist>
                                </div>
                            </div>
                                                        
							<div class="col-12">
								<p class="text-center" style="margin-top: 40px;">
									<button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
								</p>
							</div>
                        </div>
					</div>
				</form>
			</div>
        
            <!-- Tabla de empleados -->
            <?php if(isset($empleados)){?>
                <div class="container-fluid">
				<div class="table-responsive">
				<form name="FrmAvance" Id="FrmAvance" action="<?php echo base_url('ProduccionInt/consulta')?>" method="post">
					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>NOMBRE</th>
								<th>PIEZAS HECHAS</th>
								<th>FECHA</th>
								<th>HORA</th>
							</tr>
						</thead>
						<tbody>
						    <?php
                                $No=1;
                                foreach($empleados as $value){
                            ?>
							        <tr class="text-center" >
								        <td><?php echo $No?></td>
								        <td><?php echo $value->Nombre.' '.$value->Paterno.' '.$value->Materno?></td>
								        <td><?php echo $value->Cantidad?></td>
								        <td><?php echo $value->Fecha?></td>
								        <td><?php echo $value->Hora?></td>
                                         
							        </tr>
							<?php
                                    $No++;
                                }?>
						</tbody>
						
					</table>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
				</form>
				</div>
				
			</div>

            <?php }?>