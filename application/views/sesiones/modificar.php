            <script type="text/javascript">
                window.addEventListener('load', function () {

                    document.getElementById("tallasnum").style.display="none";
                    document.getElementById("tallasletras").style.display="none";
                    document.getElementById("Accesorios").style.display="none";
                    document.getElementById("Tallas").style.display="none";

                    
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
                    <i class="fas fa-plus fa-fw"></i> &nbsp;<b> MODIFICACIÓN DE LA SECCIÓN:</b> <?php echo $prod->IdSesion?> <b>  PARA EL CORTE: </b><?php echo ' '. $prod->Clave?>
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
						<a href="<?php echo base_url('Sesiones/lista/').$prod->Clave;?>"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR SECCIÓN</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
				<form name="FrmModSesiones" Id="FrmModSesiones" action="<?php echo base_url('Sesiones/update')?>" method="post" class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="fa fa-info-circle"></i> &nbsp; Información general</legend>
						<div class="container-fluid">
							<div class="row">
                                <input type="hidden" class="form-control" name="txtId" id="txtId"  value="<?php echo $prod->IdProducto?>">
                                <input type="hidden" class="form-control" name="txtHechas" id="txtHechas"  value="<?php echo $prod->Hechas?>">
                                <input type="hidden" class="form-control" name="txtClave" id="txtClave" value="<?php echo $prod->Clave?>">
                                <input type="hidden" class="form-control" name="txtIdSeccion" id="txtIdSeccion"  value="<?php echo $prod->IdSesion?>">
				                
								<div class="col-12 col-md-6">
									<div class="form-group">
									    <label for="cmbEstado" class="bmd-label-floating">* Estado de la sesion</label>
										<select class="form-control" name="cmbEstado" id="cmbEstado">
											<option value="0">Seleccione una opción</option>
											<option value="en espera" <?php if($prod->Estado === "en espera"){ echo 'selected'; }?>>en espera</option>
											<option value="Iniciado" <?php if($prod->Estado === "Iniciado"){echo 'selected';}?>>Iniciando</option>
											<option value="En Proceso" <?php if($prod->Estado === "En Proceso"){echo 'selected';}?>>En producción</option>
											<option value="Terminado" <?php if($prod->Estado === "Terminado"){echo 'selected';}?>>Terminado</option>
                                        </select>
									</div>
								</div>
								
                               <div class="col-12 col-md-6">
									<div class="form-group">
                                        <label for="txtTaller" class="bmd-label-floating"> *Puesto asignado </label>
                                        <?php
                                            $lista = array();
                                            foreach ($ltaller as $registro) {
                                                $lista[$registro->IdExterno] = $registro->Nombre.' '. $registro->ApPaterno.' '.$registro->ApMaterno;
                                            }
                                
                                            echo form_dropdown('txtTaller',$lista,$prod->Taller, 'class="form-control"', 'id="txtTaller"');
                                        ?>
									</div>
								</div>
                               
                                <div class="col-12 col-md-6"> 
								    <div class="form-group">
									    <label for="txtTPiezas" class="bmd-label-floating">* Piezas </label>
										<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="txtTPiezas" id="txtTotalPiezas"  value="<?php echo $prod->Cantidad?>" maxlength="20" required>
								    </div>
                                </div>
                                
                                <div class="col-12 col-md-6"> 
								    <div class="form-group">
									    <label for="dtEntrega" class="bmd-label-floating">* Fecha Programada </label>
										<input type="date" pattern="[0-9()+]{1,20}" class="form-control" name="dtEntrega" id="dtEntrega" maxlength="20" value="<?php echo $prod->Programada?>" required>
								    </div>
                                </div>
							</div>
							
						</div>
					</fieldset>
					<br><br><br>
					<legend><i class="fas fa-balance-scale"></i> &nbsp; ¿Desea cambiar los accesorios de ésta sección?</legend>
						<div class="container-fluid">
						    <div class=row>
                                <div class="form-group radio">    
                                   <input type="radio" name="rbAccesorios" id="rbAccesorios" value="Si" onchange="AccesoriosS();">
                                   <label for="rbAccesorios"> Si </label>
                                </div>
                                
                                <div class="form-group radio">        
                                    <input type="radio" name="rbAccesorios" id="rbAccesorion" value="No" onchange="AccesoriosN();">
                                    <label for="rbAccesorion"> No </label>
                                </div>   
						    </div>
				        </div>
					<br><br><br>
					<div class="Accesorios" Id="Accesorios">
					<fieldset>
						<legend><i class="fa fa-check-square"></i> &nbsp; Accesorios seleccionados anteriormente</legend>
						<div class="container-fluid">
							<div class="row">
                                <div class="col-12 col-md-6">
                                   <div class="form-group">
                                       <?php 
                                            
                                            foreach($accesorioselect as $acce){
                                        ?>
                                                <li><?php echo $acce->Accesorio?></li>
                                        <?php
                                                
                                            }
                                       ?>
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
                                        ?>
                                                <input type="checkbox" name="chbAccesorios[]" id="<?php echo $value->IdAccesorio?>" value="<?php  echo $value->IdAccesorio?>">
                                                <label for="<?php echo $value->IdAccesorio?>"><?php echo $value->Accesorio?></label>
                                        <?php
                                                
                                            }
                                       ?>
                                    </div>
                                </div>
							</div>
						</div>
					</fieldset>	
					</div>
					<br><br><br>
					<legend><i class="fas fa-balance-scale"></i> &nbsp; ¿Desea cambiar las tallas de ésta sección?</legend>
						<div class="container-fluid">
						    <div class=row>
                                <div class="form-group radio">    
                                   <input type="radio" name="rbTallas" id="rbTallass" value="Si" onchange="TallasS();">
                                   <label for="rbTallass"> Si </label>
                                </div>
                                
                                <div class="form-group radio">        
                                    <input type="radio" name="rbTallas" id="rbTallasn" value="No" onchange="TallasN();">
                                    <label for="rbTallasn"> No </label>
                                </div>   
						    </div>
				        </div>
					<br><br><br>
					<div class="Tallas" Id="Tallas">
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
                    </div>
					<br><br><br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
					
				</form>
           
			</div>
			
		<script src="<?php echo base_url('public/js/personalizado.js'); ?>"></script>