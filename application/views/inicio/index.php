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
					<i class="fab fa-dashcube fa-fw"></i> &nbsp; Nombre de la empresa
				</h3>
				<p class="text-justify">
					
			</div>
			
			<!-- Content -->
			<div class="full-box tile-container">

                <?php
                    foreach($user as $value){
                        $usuario = $value->Usuarios;
                    }
                    foreach($client as $numc){
                        $cliente = $numc->Clientes;
                    }
                                       
                    foreach($producto as $prod){
                        $Prod = $prod->Producto;
                    }
                   
                    foreach($taller as $tall){
                        $Taller = $tall->Taller;
                    }
                   
                    foreach($accesorio as $acc){
                        $Accesorio = $acc->Accesorio;
                    }
                ?>
				<a href="<?php echo base_url('Usuarios/index');?>" class="tile">
					<div class="tile-tittle">Usuarios</div>
					<div class="tile-icon">
						<i class="fas fa-user-secret fa-fw"></i>
						<p><?php echo $usuario.' registrados'?></p>
					</div>
				</a>

				<a href="<?php echo base_url('Clientes/index'); ?>" class="tile">
					<div class="tile-tittle">Clientes</div>
					<div class="tile-icon">
						<i class="fas fa-users fa-fw"></i>
						<p><?php echo $cliente.' Registrados'?></p>
					</div>
				</a>

				<!--<a href="item-list.html" class="tile">
					<div class="tile-tittle">Departamentos</div>
					<div class="tile-icon">
						<i class="fas fa-sitemap fa-fw"></i>
						<p>9 Registrados</p>
					</div>
				</a>

				<a href="item-list.html" class="tile">
					<div class="tile-tittle">Puestos</div>
					<div class="tile-icon">
						<i class="fas fa-archive fa-fw"></i>
						<p>9 Registrados</p>
					</div>
				</a> -->
                            
				<a href="<?php echo base_url('Productos/index'); ?>" class="tile">
					<div class="tile-tittle">Producto</div>
					<div class="tile-icon">
						<i class="fas fa-tshirt fa-fw"></i>
						<p><?php echo $Prod.' En producción'?></p>
					</div>
				</a>
                            
				<a href="<?php echo base_url('Talleres/index'); ?>" class="tile">
					<div class="tile-tittle">Trabajadores Externos</div>
					<div class="tile-icon">
						<i class="fas fa-user-clock fa-fw"></i>
						<p><?php echo $Taller.' registrados'?></p>
					</div>
				</a>
                            
				<a href="<?php echo base_url('Accesorios/index');?>" class="tile">
					<div class="tile-tittle">Accesorios</div>
					<div class="tile-icon">
						<i class="fas fa-clipboard-list fa-fw"></i>
						<p><?php echo $Accesorio.' registrados'?></p>
					</div>
				</a>
                            
				<a href="<?php echo base_url('Produccion/index')?>" class="tile">
					<div class="tile-tittle">Producción</div>
					<div class="tile-icon">
						<i class="fas fa-cogs fa-fw"></i>
						<p> Registrar producción </p>
					</div>
				</a>
								
			</div>
			
<script type="text/javascript">
    var baseurl="<?php echo base_url(); ?>";
</script>