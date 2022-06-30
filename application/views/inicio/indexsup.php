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
				<input type="button" value="graficar" onclick="verInfoGraf()">
				<canvas id="myChart" width="200" height="100"></canvas>
			</div>
			
			<script>

				async function verInfoGraf(){
					const response = await fetch("<?php echo base_url('Inicio/grafica')?>");
					const json = await response.json();

					var Claves = [];
					var Sesiones = [];

					json.productos.forEach((elemento) => {
						Claves.push(elemento.Clave);
					});

					json.sesiones.forEach((elemento) => {
						Sesiones.push(elemento);
					});

					//alert("Claves de cortes: " + Claves);
					//alert("Sesiones terminadas: " + Sesiones);


					const ctx = document.getElementById('myChart').getContext('2d');
					const myChart = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: Claves,
							datasets: [{
								label: 'Sesiones Terminadas: ',
								data: Sesiones,
								backgroundColor: [
									'rgba(255, 99, 132, 0.2)',
									'rgba(54, 162, 235, 0.2)',
									'rgba(255, 206, 86, 0.2)',
									'rgba(75, 192, 192, 0.2)',
									'rgba(153, 102, 255, 0.2)',
									'rgba(255, 159, 64, 0.2)'
								],
								borderColor: [
									'rgba(255, 99, 132, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)'
								],
								borderWidth: 1
							}]
						},
						options: {
							scales: {
								y: {
									beginAtZero: true
								}
							}
						}
					});
				}
					
			</script>
<script type="text/javascript">
    var baseurl="<?php echo base_url(); ?>";
</script>