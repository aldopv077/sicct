            <script type="text/javascript">
                window.addEventListener('load', function () {

                    document.getElementById("tallasnum").style.display="none";
                    document.getElementById("tallasletras").style.display="none";

                    
                    document.getElementById("txtPiezasEch").disabled=true;
                    document.getElementById("txtPiezasCh").disabled=true;
                    document.getElementById("txtPiezasM").disabled=true;
                    document.getElementById("txtPiezasG").disabled=true;
                    document.getElementById("txtPiezasEg").disabled=true;
                    document.getElementById("txtPiezasJ").disabled=true;
                    
                    document.getElementById("txtPiezasXL").disabled=true;
                    document.getElementById("txtPiezas1XL").disabled=true;
                    document.getElementById("txtPiezas2XL").disabled=true;
                    document.getElementById("txtPiezas3XL").disabled=true;
                });

                
            </script>
            <?php foreach ($productos as $prod){?> 
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
                    <i class="fas fa-plus fa-fw"></i> &nbsp;<b> NUEVA SECCIÓN PARA EL CORTE: </b><?php echo ' '. $prod->Clave?>
				</h3>
				<p class="text-justify">
					De la prenda <?php echo $prod->Prenda?>
				</p>
				
				<p class="text-justify">
					Los campos marcados con * son obligatorios
				</p>
			</div>
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="<?php echo base_url('Sesiones/lista/'.$prod->Clave);?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR SECCIÓN</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
				<form name="FrmSesiones" Id="FrmSesiones" action="<?php echo base_url('Sesiones/ingresar')?>" method="post" class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="fa fa-info-circle"></i> &nbsp; Información general</legend>
						<div class="container-fluid">
							<div class="row">
                                <input type="hidden" class="form-control" name="txtId" id="txtId"  value="<?php echo $prod->IdProducto?>">
                                <input type="hidden" class="form-control" name="txtClasificacion" id="txtClasificacion" value="<?php echo $prod->Clasificacion?>">
								
								<div class="container-fluid">
						            <div class=row>
                                        <div class="form-group radio">    
                                           <!--<input type="checkbox" name="chbSesion1" id="chbSesion1" value="Sesion1" onchange="Letras();">
                                           <label for="chbSesion1"> Por letra </label>-->
                                           <?php
                                                $y=$prod->NumeroSesiones;
                                                $x=0;
                                                while($x<$y){
                                                    $z=$x+1;
                                                    echo '<input type="radio" name="rbSesion" id="rb'.$z.'" value="'.$z.'">';
                                                    echo'<label for="rb'.$z.'"> '.$z.' </label>';
                                                    $x++;
                                                }
                                            ?>
                                        </div>  
						            </div>
				                </div>
				                
								<div class="col-12 col-md-6">
									<div class="form-group">
									    <label for="cmbEstado" class="bmd-label-floating">* Estado de la sesion</label>
										<select class="form-control" name="cmbEstado" id="cmbEstado">
											<option value="" selected="" disabled="">Seleccione una opción</option>
											<option value="en espera">en espera</option>
											<option value="Iniciado">Iniciando</option>
											<option value="En Proceso">En producción</option>
											<option value="Terminado">Terminado</option>
                                        </select>
									</div>
								</div>
								
                               <div class="col-12 col-md-6">
									<div class="form-group">
									    <label for="txtTaller" class="bmd-label-floating">Taller a asignar</label>
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
                               
                                <div class="col-12 col-md-6"> 
								    <div class="form-group">
									    <label for="txtTPiezas" class="bmd-label-floating">* Piezas </label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtTPiezas" id="txtTotalPiezas" maxlength="20">
								    </div>
                                </div>
                               
                                <div class="col-12 col-md-6"> 
								    <div class="form-group">
									    <label for="dtEntrega" class="bmd-label-floating">* Fecha Programada </label>
										<input type="date" pattern="[0-9()+]{1,20}" class="form-control" name="dtEntrega" id="dtEntrega" maxlength="20">
								    </div>
                                </div>
							</div>
							
						</div>
					</fieldset>
					<br><br><br>
					<fieldset>
						<legend><i class="fa fa-check-square"></i> &nbsp; Accesorios que tendrá ésta sección</legend>
						<div class="container-fluid">
							<div class="row">
                                <div class="col-12 col-md-6">
                                   <div class="form-group check">
                                       <?php 
                                            foreach($accesorios as $value){
                                               
                                                echo '<input type="checkbox" name="chbAccesorios[]" id="'.$value->IdAccesorio.'" class="form-control" value="'.$value->IdAccesorio.'">';
                                                echo '<label for="'.$value->IdAccesorio.'"> '.$value->Accesorio.'</label>';
                                            }
                                       ?>
                                    </div>
                                </div>
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<fieldset>
						<legend><i class="fas fa-balance-scale"></i> &nbsp; Tallas que tendrá ésta sección</legend>
						<div class="container-fluid">
						    <div class=row>
                                <div class="form-group radio">    
                                   <input type="radio" name="rbTipoTalla" id="rbLetra" value="Letra" onchange="Letras();">
                                   <label for="rbLetra"> Por clasificación </label>
                                </div>
                                
                                <div class="form-group radio">        
                                    <input type="radio" name="rbTipoTalla" id="rbNumeracion" value="Numeracion" onchange="Numeros();">
                                    <label for="rbNumeracion">Por numeración </label>
                                </div>   
						    </div>
				        </div>
				        
				        <div class="tallasnum" Id="tallasnum">
				            <div class="container-fluid">
							    <div class="row">
								    <?php
                                        foreach($tallas as $select){
                                    ?>
                                         <div class="col-3 col-md-4">
	                                        <div class="form-group check">
	                                            <?php
                                                    echo '<input type="checkbox" name="chbTallas[]" id="'.$select->IdTalla.'A" class="form-control" value="'.$select->IdTalla.'">';
                                                    echo '<label for="'.$select->IdTalla.'A"> '.$select->Talla.'</label>';
                                                ?> 
                                             </div> 
                                         </div> 
                                         
                                         <div class="col-9 col-md-8">   
                                             <div class="form-group"> 
                                                 <label for="txtCantidadN" class="bmd-label-floating">* No. de piezas</label>
                                                 
                                                 <input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtCantidadN[]" id="txtCantidadN" maxlength="20">
                                             </div>
                                         </div>
                                    <?php
                                        }
                                    ?>
							    </div>
                            </div>
				        </div>
                          
				        
						<div class="tallasletras" Id="tallasletras">
						    <div class="container-fluid">
							<div class="row">
                               <div class="col-3 col-md-4">  
                                   <div class="form-group check">     
                                        <input type="checkbox" name="chbTallaL[]" id="chbExChica" value="1" onchange="habilitar();"> 
                                        <label for="chbExChica"> EXTRA CHICA (ECH) </label> 
                                    </div> 
                                </div>
                                <div class="col-9 col-md-8"> 
								    <div class="form-group">
									    <label for="txtPiezasEch" class="bmd-label-floating">* No. de piezas</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtCantidad[]" id="txtPiezasEch" maxlength="20">
								    </div>
                                </div>
                                
                                <div class="col-3 col-md-4">  
                                   <div class="form-group check">     
                                        <input type="checkbox" name="chbTallaL[]" id="chbChica"  value="2"  onchange="habilitar();"> 
                                        <label for="chbChica"> CHICA (CH) </label> 
                                    </div> 
                                </div>
                                <div class="col-9 col-md-8"> 
								    <div class="form-group">
									    <label for="txtPiezasCh" class="bmd-label-floating">* No. de piezas</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtCantidad[]" id="txtPiezasCh" maxlength="20">
								    </div>
                                </div>
                                    
                                <div class="col-3 col-md-4">      
                                    <div class="form-group check">     
                                        <input type="checkbox" name="chbTallaL[]" id="chbMediana" value="3"  onchange="habilitar();">
                                        <label for="chbMediana"> MEDIANA (M) </label>
                                        
                                    </div> 
                                </div>
                                <div class="col-9 col-md-8"> 
								    <div class="form-group">
									    <label for="txtPiezasM" class="bmd-label-floating">* No. de piezas</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtCantidad[]" id="txtPiezasM" maxlength="20">
								    </div>
                                </div>
                                <div class="col-3 col-md-4">   
                                    <div class="form-group check">
                                        <input type="checkbox" name="chbTallaL[]" id="chbGrande" value="4"  onchange="habilitar();">
                                        <label for="chbGrande"> GRANDE (G) </label>  
                                
                                    </div> 
                                </div>
                                
                                
                                <div class="col-9 col-md-8"> 
								    <div class="form-group">
									    <label for="txtPiezasG" class="bmd-label-floating">* No. de piezas</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtCantidad[]" id="txtPiezasG" maxlength="20">
								    </div>
                                </div>
                                
                                <div class="col-3 col-md-4">   
                                    <div class="form-group check">   
                                        <input type="checkbox" name="chbTallaL[]" id="chbExGrande" value="5"  onchange="habilitar();">
                                        <label for="chbExGrande"> EXTRA GRANDE (EG) </label>  
                                    </div>
                                </div>
                                <div class="col-9 col-md-8"> 
								    <div class="form-group">
									    <label for="txtPiezasEg" class="bmd-label-floating">* No. de piezas</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtCantidad[]" id="txtPiezasEg" maxlength="20">
								    </div>
                                </div>
                                <div class="col-3 col-md-4">   
                                    <div class="form-group check">   
                                        <input type="checkbox" name="chbTallaL[]" id="chbJumbo" value="6"  onchange="habilitar();">
                                        <label for="chbJumbo"> JUMBO (J) </label>  
                                    </div>
                                </div>
                                <div class="col-9 col-md-8"> 
								    <div class="form-group">
									    <label for="txtPiezasJ" class="bmd-label-floating">* No. de piezas</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtCantidad[]" id="txtPiezasJ" maxlength="20">
								    </div>
                                </div>
                                
                                
                                
                                <legend><i class="fas fa-balance-scale"></i> &nbsp; Solo para exportación</legend>
                                
                                
                                <div class="col-3 col-md-4">   
                                    <div class="form-group check">   
                                        <input type="checkbox" name="chbTallaL[]" id="chbEXL" value="7" onchange="habilitar();">
                                        <label for="chbEXL"> EXTRA GRANDE (XL) </label>  
                                    </div>
                                </div>
                                <div class="col-9 col-md-8"> 
								    <div class="form-group">
									    <label for="txtPiezasXL" class="bmd-label-floating">* No. de piezas</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtCantidad[]" id="txtPiezasXL" maxlength="20">
								    </div>
                                </div>
                                <div class="col-3 col-md-4">   
                                    <div class="form-group check">   
                                        <input type="checkbox" name="chbTallaL[]" id="chbE1XL" value="8" onchange="habilitar();">
                                        <label for="chbE1XL"> EXTRA GRANDE (1XL) </label>  
                                    </div>
                                </div>
                                <div class="col-9 col-md-8"> 
								    <div class="form-group">
									    <label for="txtPiezas1XL" class="bmd-label-floating">* No. de piezas</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtCantidad[]" id="txtPiezas1XL" maxlength="20">
								    </div>
                                </div><div class="col-3 col-md-4">   
                                    <div class="form-group check">   
                                        <input type="checkbox" name="chbTallaL[]" id="chbE2XL" value="9" onchange="habilitar();">
                                        <label for="chbE2XL"> EXTRA GRANDE (2XL) </label>  
                                    </div>
                                </div>
                                <div class="col-9 col-md-8"> 
								    <div class="form-group">
									    <label for="txtPiezas2XL" class="bmd-label-floating">* No. de piezas</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtCantidad[]" id="txtPiezas2XL" maxlength="20">
								    </div>
                                </div><div class="col-3 col-md-4">   
                                    <div class="form-group check">   
                                        <input type="checkbox" name="chbTallaL[]" id="chbE3XL" value="10" onchange="habilitar();">
                                        <label for="chbE3XL"> EXTRA GRANDE (3XL) </label>  
                                    </div>
                                </div>
                                <div class="col-9 col-md-8"> 
								    <div class="form-group">
									    <label for="txtPiezas3XL" class="bmd-label-floating">* No. de piezas</label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtCantidad[]" id="txtPiezas3XL" maxlength="20">
								    </div>
                                </div>
                            </div>
                          </div>
						</div>

						
                    <?php }?>      
					</fieldset>
					<br><br><br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
					
				</form>
           
			</div>
			
		<script src="<?php echo base_url('public/js/personalizado.js'); ?>"></script>