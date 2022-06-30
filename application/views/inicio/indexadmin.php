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
					<i class="fab fa-dashcube fa-fw"></i> &nbsp; <?php echo $this->session->userdata('NombreEmp')?>
				</h3>
				<p class="text-justify">
					
			</div>
			
			<!-- Content -->
			<div class="full-box tile-container">

                <?php
                    foreach($user as $value){
                        $usuario = $value->Usuarios;
                    }
                    foreach($empresas as $numc){
                        $empresa = $numc->Empresa;
                    }
                ?>
				<a href="<?php echo base_url('Usuarios/index');?>" class="tile">
					<div class="tile-tittle">Usuarios</div>
					<div class="tile-icon">
						<i class="fas fa-user-secret fa-fw"></i>
						<p><?php echo $usuario.' registrados'?></p>
					</div>
				</a>

				<a href="<?php echo base_url('Empresas/index'); ?>" class="tile">
					<div class="tile-tittle">Empresas</div>
					<div class="tile-icon">
						<i class="fas fa-store-alt fa-fw"></i>
						<p><?php echo $empresa.' Registradas'?></p>
					</div>
				</a>								
			</div>
			
<script type="text/javascript">
    var baseurl="<?php echo base_url(); ?>";
</script>