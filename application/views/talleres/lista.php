
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
					Ingresar el nombre del taller a buscar
				</p>
			</div>
			
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="<?php echo base_url('Talleres/index');?>"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO TALLER</a>
					</li>
					<li>
						<a class="active" href="<?php echo base_url('Talleres/lista');?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR TALLER</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
				<form class="form-neon" neme="frmBudcarTaller" action="<?php echo base_url('Talleres/buscar')?>" method="post">
					<div class="container-fluid">
						<div class="row justify-content-md-center">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="txtTaller" class="bmd-label-floating">¿Qué usuario estas buscando?</label>
									<input name="txtTaller" Id="txtTaller" type="search" class="form-control" list="talleres">
									<datalist id="talleres">
                                        <?php
                                            foreach ($ltaller as $key) {
                                                print '<option value="'.$key->IdExterno .' '. $key->Nombre .' '. $key->ApPaterno .' '. $key->ApMaterno.'"></option>';
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
								<th>DIRECCION</th>
								<th>TELÉFONO</th>
								<th>ACTUALIZAR</th>
								<th>ELIMINAR</th>
							</tr>
						</thead>
						<tbody>
							
							<?php 
                                $No=1;
                                foreach($taller as $value){
                                    
                            ?>
                                <tr class="text-center" >
                                    <td> <?php echo $No//$value->IdUsuario?> </td>
								    <th> <?php echo $value->Nombre.' '.$value->ApPaterno.' '.$value->ApMaterno ?> </th>
								    <th> <?php echo $value->Direccion?> </th>
								    <th> <?php echo $value->Telefono?> </th>
								    <td>
									    <a href="<?php echo base_url('Talleres/modificar/').$value->IdExterno; ?>" class="btn btn-success">
	  									    <i class="fas fa-sync-alt"></i>	
									    </a>
								    </td>
								    <td>
								         <a onclick="if(confirma() === false) return false" href="<?php echo base_url('Talleres/eliminar/').$value->IdExterno;?>" class="btn btn-warning"> <i class="far fa-trash-alt"></i>  </a>
									    
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
