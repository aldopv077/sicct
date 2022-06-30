<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo $this->session->userdata('NombreEmp')?></title>

	<!-- Normalize V8.0.1 -->
	 <link rel="stylesheet" href="<?php echo base_url('public/css/normalize.css'); ?>">  

	<!-- Bootstrap V4.3 -->
	<link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap.min.css'); ?>">  

	<!-- Bootstrap Material Design V4.0 -->
	<link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap-material-design.min.css'); ?>">  

	<!-- Font Awesome V5.9.0 
	<link rel="stylesheet" href="<?php //echo base_url('public/css/all.css'); ?>"> -->
	
    <!-- Font Awesome V5.13.0 -->
	<link rel="stylesheet" href="<?php echo base_url('public/css/all513.css'); ?>">  

	<!-- Sweet Alerts V8.13.0 CSS file -->
	<link rel="stylesheet" href="<?php echo base_url('public/css/sweetalert2.min.css'); ?>">  

	<!-- Sweet Alert V8.13.0 JS file-->
	<script src="<?php echo base_url('public/js/sweetalert2.min.js'); ?>" ></script>  
	
    <script type="text/javascript">
        window.history.forward();
        function sinVueltaAtras(){ window.history.forward(); }
    </script>

	<!-- jQuery Custom Content Scroller V3.1.5 -->
	<link rel="stylesheet" href="<?php echo base_url('public/css/jquery.mCustomScrollbar.css'); ?>">  
	
	<!-- General Styles -->
	<link rel="stylesheet" href="<?php echo base_url('public/css/style.css');?>">  
	
	<!-- General Styles -->
	<link rel="stylesheet" href="<?php echo base_url('public/css/personalizado.css');?>"> 
        <script>
            function confirma() {
                if (confirm("¿Realmente desea eliminarlo?")) {
                    alert("El registro ha sido eliminado");
                } else {
               return false;
                }
            }
        </script>
</head>
<!-- <body onload="sinVueltaAtras();" onpageshow="if (event.persisted) sinVueltaAtras();" onunload=""> -->
<body>
	<?php
        $Nombre = $this->session->userdata('nombre').' '. $this->session->userdata('paterno').' '. $this->session->userdata('materno');
        $Puesto = $this->session->userdata('pueston');
		$Rol = $this->session->userdata('rol');
    ?>
	<!-- Main container -->
	<main class="full-box main-container">
		<!-- Nav lateral -->
		<section class="full-box nav-lateral">
			<div class="full-box nav-lateral-bg show-nav-lateral"></div>
			<div class="full-box nav-lateral-content">
				<figure class="full-box nav-lateral-avatar">
					<i class="far fa-times-circle show-nav-lateral"></i>
					<img src="<?php echo base_url('public/assets/avatar/Avatar.png'); ?>" class="img-fluid" alt="Avatar">
					<figcaption class="roboto-medium text-center">
						<?php echo $Nombre; ?> <br><small class="roboto-condensed-light"><?php echo $Puesto; ?></small>
					</figcaption>
				</figure>
				<div class="full-box nav-lateral-bar"></div>
				<nav class="full-box nav-lateral-menu">
					<ul>
					
						<li>
							<a href="<?php echo base_url('Inicio/index'); ?>"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Inicio</a>
						</li>
						
						<?php if($Rol == 'Administrador'){?>
							<li>
								<a href="<?php echo base_url('Usuarios/index');?>" class="nav-btn-submenu"><i class="fas  fa-user-secret fa-fw"></i> &nbsp; Usuarios </a>
							</li>

							<?php if($this->session->userdata('rol') == 'Administrador' || $this->session->userdata('rol') == 'SuperAdmin'){?>
								<li>
									<a href="<?php echo base_url('Empleados/index');?>" class="nav-btn-submenu"><i class="fas fa-male"></i> &nbsp; Empleados </a>
								</li>
							<?php }?>
							<li>
								<a href="<?php echo base_url('Clientes/index'); ?>" class="nav-btn-submenu"><i class="fas fa-users fa-fw"></i> &nbsp; Clientes </a>
							</li>						
							
							<li>
								<a href="<?php echo base_url('Productos/index'); ?>" class="nav-btn-submenu"><i class="fas fa-tshirt fa-fw"></i> &nbsp; Producto </a>
							</li>
							
							<li>
								<a href="<?php echo base_url('Talleres/index'); ?>" class="nav-btn-submenu"><i class="fas fa-user-clock fa-fw"></i> &nbsp; Trabajadores Externos</a>
							</li>
							<li>
								<a href="<?php echo base_url('Accesorios/index');?>" class="nav-btn-submenu"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Accesorios</a>
							</li>
							
							<li>
								<a href="#" class="nav-btn-submenu1"><i class="fas fa-cogs fa-fw"></i> &nbsp; Producción <i class="fas fa-chevron-down"></i></a>
								<ul>
									<li>
										<a href="#"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar item</a>
									</li>
									<li>
										<a href="<?php echo base_url('Produccion/index'); ?>"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Productos en proceso</a>
									</li>
									<li>
										<a href="<?php echo base_url('Sesiones/lista'); ?>"><i class="fas fa-search fa-fw"></i> &nbsp; Secciones</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="<?php echo base_url('ProduccionInt/index'); ?>" class="nav-btn-submenu"><i class="far fa-object-group"></i> &nbsp; Producción Interna</a>
							</li>
						<?php }else{?>
							<li>
								<a href="<?php echo base_url('ProduccionInt/index'); ?>" class="nav-btn-submenu"><i class="far fa-object-group"></i> &nbsp; Producción Interna</a>
							</li>
						<?php }?>

						<?php if($Rol == 'SuperAdmin'){?>
							<li>
								<a href="<?php echo base_url('Empresas/index')?>"><i class="fas fa-store-alt fa-fw"></i> &nbsp; Empresa</a>
							</li>
						<?php }?>
					</ul>
				</nav>
			</div>
		</section>
       
        <section class="full-box page-content"> 
            <?php
                $this->load->view($contenido);//aqui se manda a llamar a la vista correspondiente de cada modulo
            ?>
        </section>   
		
	</main>
	
	
	<!--=============================================
	=            Include JavaScript files           =
	==============================================-->
	<!-- jQuery V3.4.1 -->
	<script src="<?php echo base_url('public/js/jquery-3.4.1.min.js'); ?>" ></script>

	<!-- popper -->
	<script src="<?php echo base_url('public/js/popper.min.js');?>" ></script>

	<!-- Bootstrap V4.3 -->
	<script src="<?php echo base_url('public/js/bootstrap.min.js'); ?>" ></script>

	<!-- jQuery Custom Content Scroller V3.1.5 -->
	<script src="<?php echo base_url('public/js/jquery.mCustomScrollbar.concat.min.js');?>" ></script>

	<!-- Bootstrap Material Design V4.0 -->
	<script src="<?php echo base_url('public/js/bootstrap-material-design.min.js'); ?>" ></script>
	<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

	<script src="<?php echo base_url('public/js/main.js'); ?>" ></script>
	
	<!-- Busqueda de usuarios en Tiempo Real -->
	<script src="<?php echo base_url('public/js/UsuariosTR.js') ?>"></script>
	
	<!-- Envía la base url en una variable de js -->
	<script type="text/javascript"> var baseurl="<?php echo base_url(); ?>"; </script>
</body>
</html>