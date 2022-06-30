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
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; AVANCE
				</h3>
				<p class="text-justify">
					Avance de la sección: <?php echo $sesion?>
				</p>
			</div>
			
			<!-- Content 
			<div class="container-fluid">
				<form name="FrmBusquedaSesiones" action="<?php echo base_url('Sesiones/busqueda')?>" method="post" class="form-neon">
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
			</div>-->


            
			<div class="container-fluid">
				<div class="table-responsive">

					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>CLAVE PRODUCTO</th>
								<th>NO. SESIÓN</th>
								<th>TABAJADOR EXTERNO</th>
								<th>PIEZAS</th>
								<th>FECHA DE ENTREGA</th>
							</tr>
						</thead>
						<tbody>
						    <?php
                                $No=1;
                                foreach($lista as $value){
                                
                            ?>
							       
							        <tr class="text-center" >
								        <td><?php echo $No?></td>
								        <th><?php echo $value->Clave?></th>
								        <th><?php echo $value->Sesion?></th>
								        <th><?php echo $value->Nombre.' '.$value->Paterno.' '.$value->Materno?></th>
								        <th><?php echo $value->Produccion?></th>
								        <th><?php echo $value->Fecha?></th> 
							        </tr>
							<?php
                                    $No++;
                                }?>
						</tbody>
						
					</table>
				</form>
				</div>
				
			</div>
