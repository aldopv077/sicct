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
					<i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR PRODUCTO
				</h3>
				<p class="text-justify">
					Ingresar la clave del producto a buscar
				</p>
			</div>
			
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="<?php echo base_url('Productos/index');?>"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO PRODUCTO</a>
					</li>
					<li>
						<a class="active" href="<?php echo base_url('Productos/lista');?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR PRODUCTO</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
				<form class="form-neon" action="">
					<div class="container-fluid">
						<div class="row justify-content-md-center">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="txtIdCorte" class="bmd-label-floating">¿Qué corte estas buscando?</label>
									<input type="text" class="form-control" name="txtIdCorte" id="txtIdCorte" maxlength="30">
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
				<form action="">
					<input type="hidden" name="eliminar-busqueda" value="eliminar">
					<div class="container-fluid">
						<div class="row justify-content-md-center">
							<div class="col-12 col-md-6">
								<p class="text-center" style="font-size: 20px;">
									Resultados de la busqueda <strong>“Buscar”</strong>
								</p>
							</div>
							<div class="col-12">
								<p class="text-center" style="margin-top: 20px;">
									<button type="submit" class="btn btn-raised btn-danger"><i class="far fa-trash-alt"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
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
								<th>CLAVE</th>
								<th>ESTADO</th>
								<th>CLIENTE</th>
								<th>PRODUCTO</th>
								<th>ENTRÓ</th>
								<th>ENTREGA COMPLETA</th>
								<th>TOTAL DE SESIONES</th>
								<th>SECCIONES ENTREGADAS</th>
								<th>SECCIONES FALTANTES</th>
								<th>ACTUALIZAR</th>
								<th>AGREGAR SECCIÓN</th>								
								<th>ELIMINAR</th>
							</tr>
						</thead>
						<tbody>
							<?php 
                                $No=1;
                                foreach($productos as $value){
                                    
                            ?>
                                <tr class="text-center" >
                                    <td> <?php echo $No?> </td>
								    <th> <?php echo $value->Clave ?> </th>
								    <th> <?php echo $value->Estado?> </th>
								    <th> <?php echo $value->Cliente?> </th>
								    <th> <?php echo $value->TipoProducto?> </th>
								    <th> <?php echo $value->Ingreso?> </th>
								    <th> <?php echo $value->Salida?> </th>
								    <th> <?php echo $value->Sesiones?> </th>
								    <th> 00 </th>
								    <th> 00 </th>
								    <td>
									    <a href="<?php echo base_url('Productos/modificar/').$value->Id; ?>" class="btn btn-success">
	  									    <i class="fas fa-sync-alt"></i>	
									    </a>
								    </td>
								    <td>
									    <a href="<?php echo base_url('Productos/redireccion/').$value->Id; ?>" class="btn btn-success">
	  									    <i class="fa fa-plus-square"></i>	
									    </a>
								    </td>
								    <td>
								         <a onclick="if(confirma() === false) return false" href="<?php echo base_url('Productos/eliminar/').$value->Id;?>" class="btn btn-warning"> <i class="far fa-trash-alt"></i>  </a>
									    

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
