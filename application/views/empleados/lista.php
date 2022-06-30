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
					<i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR USUARIO
				</h3>
				<p class="text-justify">
					Ingresar el nombre del usuario a buscar
				</p>
			</div>
			
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="<?php echo base_url('Empleados/index');?>"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO USUARIO</a>
					</li>
					<li>
						<a class="active" href="<?php echo base_url('Empleados/lista');?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR USUARIO</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
				<form name="FrmBuscarUsuario" class="form-neon" action="<?php echo base_url('Empleados/buscar')?>" method="post">
					<div class="container-fluid">
						<div class="row justify-content-md-center">
							<div class="col-6 col-md-6">
								<div class="form-group">
									<label for="txtEmpleados" class="bmd-label-floating">¿Qué empleado estas buscando?</label>
									<input name="txtEmpleados" Id="txtEmpleados" type="search" class="form-control" list="Empleados">
									<datalist id="Empleados">
                                        <?php
                                            foreach ($empleados as $key) {
                                                print '<option value="'.$key->IdEmpleado .' '. $key->Nombre .' '. $key->Paterno .' '. $key->Materno.'"></option>';
                                            }
                                        ?>
                                    </datalist>
								</div>
							</div>
							<div class="col-6 col-md-6">
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
							<div class="col-12">
								<p class="text-center" style="margin-top: 40px;">
									<button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
								</p>
							</div>
						</div>
					</div>
				</form>
			</div>



			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm" Id="TblUsuarios">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>NOMBRE</th>
								<th>DIRECCIÓN</th>
								<th>TELÉFONO</th>
								<th>OPERACIÓN</th>
								<th>ACTUALIZAR</th>
								<th>ELIMINAR</th>
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
									<td><?php echo $value->Direccion?></td>
									<td><?php echo $value->Telefono?></td>
									<td><?php echo $value->Operacion?></td>

                                    <td>
									    <a href="<?php echo base_url('Empleados/modificar/').$value->IdEmpleado; ?>" class="btn btn-success">
	  									    <i class="fas fa-sync-alt"></i>	
									    </a>
								    </td>
								    <td>
								         <a onclick="if(confirma() === false) return false" href="<?php echo base_url('Empleados/eliminar/').$value->IdEmpleado;?>" class="btn btn-warning"> <i class="far fa-trash-alt"></i>  </a>
									    
									    <!-- <form action="">
										    <button type="button" class="btn btn-warning">
		  									    <i class="far fa-trash-alt"></i>
										    </button>
									    </form>-->
								    </td>
							    </tr>
                                
                            <?php
                                    $No=$No+1;
                                }
                            ?>
						</tbody>
					</table>
				</div>
			</div>
