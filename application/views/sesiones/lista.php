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
					<i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR SESIÓN
				</h3>
				<p class="text-justify">
					Ingresar la clave de la sesión a buscar
				</p>
			</div>
			
			<!-- Content -->
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
			</div>


            
			<div class="container-fluid">
				<div class="table-responsive">
				<form name="FrmAvance" Id="FrmAvance" action="<?php echo base_url('Sesiones/Avance')?>" method="post">
					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>CLAVE PRODUCTO</th>
								<th>NO. SESIÓN</th>
								<th>ESTADO</th>
								<th>TALLER ASIGNADO</th>
								<!-- <th>CLIENTE</th> -->
								<th>PRODUCTO</th>
								<th>PIEZAS</th>
								<th>AVANCE</th>
								<th>PZAS HECHAS</th>
								<!-- <th>CLASIFICACIÓN</th>-->
								<th>F. INICIO</th>
								<th>F. PROGRAMADA</th>
								<th>ACTUALIZAR</th>
								<!--<th>VER AVANCE</th>-->
								<th>TERMINADO</th>
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
								        <th><?php echo $value->Id?></th>
								        <th><?php echo $value->Estado?></th>
								        <th><?php echo $value->Nombre.' '.$value->Paterno.' '.$value->Materno?></th>
								        <!--<th><?php //echo $value->Cliente?></th> -->
								        <th><?php echo $value->Producto?></th>
								        <th><?php echo $value->Piezas?></th>
								        <th><?php echo $value->Avance?></th>
								        <th>
								            <?php
                                                if($value->Estado == "Iniciado" || $value->Estado == "En Proceso")
                                                    echo '<input type="text" name="txtavance[]" id="txtavance" required>';
                                                else
                                                    echo '<input type="text" name="txtavance[]" id="txtavance" disabled>';
                                            ?>
								        </th>
								       <!-- <th><?php //echo $value->Clasificacion?></th> -->
								        <th><?php echo $value->Inicio?></th>
								        <th><?php echo $value->Fin?></th>
								        <td>
									        <a href="<?php echo base_url('Sesiones/modificar/'.$value->Id.'/'.$value->IdProducto); ?>" class="btn btn-success">
	  									        <i class="fas fa-sync-alt"></i>	
									        </a>
								        </td>
								        <!--<td>
									        <a href="<?php //echo base_url('public/grafica/3d-pie/index.php?Id=').$value->Id; ?>" class="btn btn-success">
	  									        <i class="fa fa-search"></i>	
									        </a>
								        </td>-->
								        <td>
									        <a onclick="if(confirma() === false) return false" href="<?php echo base_url('Sesiones/eliminar/').$value->Id;?>" class="btn btn-warning"> <i class="fas fa-check"></i>  </a>
								        </td>
								        <td>
								        <?php 
                                            if($value->Estado == 'Iniciado' || $value->Estado == 'En Proceso'){
                                                echo '<input type="hidden" name="txtSesion[]" id="txtSesion" value="'.$value->Id.'">';
                                                echo '<input type="hidden" name="txtEstado[]" id="txtEstado" value="'.$value->Estado.'">';
                                                echo '<input type="hidden" name="txtTaller[]" id="txtTaller" value="'.$value->Taller.'">';
                                                echo '<input type="hidden" name="txtProducto[]" id="txtProducto" value="'.$value->IdProducto.'">';
                                                echo '<input type="hidden" name="txtHechas[]" id="txtHechas" value="'.$value->Avance.'">';
                                                echo '<input type="hidden" name="txtEntrega[]" id="txtEntrega" value="'.$value->Fin.'">';
                                                echo '<input type="hidden" name="txtTPiezas[]" id="txtEntrega" value="'.$value->Piezas.'">';
                                            }else{
                                                echo '<input type="hidden" name="txtSesion[]" id="txtsesion" value="'.$value->Id.'" disabled>';
                                                echo '<input type="hidden" name="txtEstado[]" id="txtsesion" value="'.$value->Estado.'" disabled>';
                                                echo '<input type="hidden" name="txtTaller[]" id="txtsesion" value="'.$value->Taller.'" disabled>';
                                                echo '<input type="hidden" name="txtProducto[]" id="txtProducto" value="'.$value->IdProducto.'" disabled>';
                                                echo '<input type="hidden" name="txtHechas[]" id="txtHechas" value="'.$value->Avance.'" disabled>';
                                                echo '<input type="hidden" name="txtEntrega[]" id="txtEntrega" value="'.$value->Fin.'" disabled>';
                                                echo '<input type="hidden" name="txtTPiezas[]" id="txtEntrega" value="'.$value->Piezas.'" disabled>';
                                            }
                                                
                                        ?> 
                                        </td> 
                                        <td>
                                            <input type="hidden" name="txtClave" id="txtClave" value="<?php echo $value->Clave?>">
                                        </td> 
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
