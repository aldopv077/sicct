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
					<i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CLIENTE
				</h3>
				<p class="text-justify">
					Lista de los clientes agregados en el sistema
				</p>
			</div>

			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="<?php echo base_url('Clientes/index'); ?>"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR CLIENTE</a>
					</li>
					<!--<li>
						<a href="client-list.html"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CLIENTES</a>
					</li>-->
					<li>
						<a class="active" href="<?php echo base_url('Clientes/lista'); ?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CLIENTE</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content here-->
			<div class="container-fluid">
				<form name="FrmBuscarCliente" class="form-neon" action="<?php echo base_url('Clientes/busqueda')?>" method="post">
					<div class="container-fluid">
						<div class="row justify-content-md-center">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="txtCliente" class="bmd-label-floating">¿Qué usuario estas buscando?</label>
									<input name="txtCliente" Id="txtCliente" type="search" class="form-control" list="clientes">
									<datalist id="clientes">
                                        <?php
                                            foreach ($lcliente as $key) {
                                                print '<option value="'.$key->IdCliente .' '. $key->Nombre.'"></option>';
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
					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>NOMBRE</th>
								<th>RFC</th>
								<th>DIRECCIÓN</th>
								<th>CORREO</th>
								<th>TELÉFONO</th>
								<th>CONTACTO</th>
								<th>ACTUALIZAR</th>
								<th>ELIMINAR</th>
							</tr>
						</thead>
						<tbody>
							<?php 
                                $No=1;
                                foreach($clientes as $value){
                                    
                            ?>
                                <tr class="text-center" >
                                    <td> <?php echo $No?> </td>
								    <th> <?php echo $value->Nombre ?> </th>
								    <th> <?php echo $value->RFC?> </th>
								    <th> <?php echo $value->Direccion?> </th>
								    <th> <?php echo $value->Correo?> </th>
								    <th> <?php echo $value->Telefono?> </th>
								    <th> <?php echo $value->Nombrecontacto?> </th>
								    <td>
									    <a href="<?php echo base_url('Clientes/modificar/').$value->IdCliente; ?>" class="btn btn-success">
	  									    <i class="fas fa-sync-alt"></i>	
									    </a>
								    </td>
								    <td>
								         <a onclick="if(confirma() === false) return false" href="<?php echo base_url('Clientes/eliminar/').$value->IdCliente;?>" class="btn btn-warning"> <i class="far fa-trash-alt"></i>  </a>
									    

								    </td>
							    </tr>
                                
                            <?php
                                    $No=$No+1;
                                }
                            ?>
						</tbody>
					</table>
				</div>
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						<li class="page-item disabled">
							<a class="page-link" href="#" tabindex="-1">Previous</a>
						</li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item">
							<a class="page-link" href="#">Next</a>
						</li>
					</ul>
				</nav>
			</div>
