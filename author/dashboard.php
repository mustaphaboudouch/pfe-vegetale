<?php
	require_once '../config/Database.php';
	require_once 'includes/global.php';
	require_once 'includes/dashboard-func.php';
    include './includes/chart.php';

	$id = checkConnection();

	// unset not needed variables
	if(isset($_SESSION['id_variete'])){
		unset($_SESSION['id_variete']);
	}
	if(isset($_SESSION['id_notation'])){
		unset($_SESSION['id_notation']);
	}
	if(isset($_SESSION['id_resistance'])){
		unset($_SESSION['id_resistance']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="../images/leaf.ico" type="image/x-icon"/>
	<title>Dashboard</title>
	<!-- META tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSS Files -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/all.min.css">
	<!-- JS Files -->
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/chart.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>
<body>

	<div id="wrapper">

		<!-- SIDEBAR -->

		<div id="sidebar-wrapper">

			<!-- SIDEBAR : LOGO -->

			<div class="my-logo">
				<h3><i class="fa fa-leaf"></i> PFE</h3>
				<small class="text-muted">Projet de fin d'étude</small>
			</div>

			<!-- SIDEBAR : MENU -->

			<ul class="my-menu">
				<li><a class="active"><i class="fas fa-columns"></i> Dashboard</a></li>
				<li><a href="varietes.php"><i class="fa fa-pepper-hot"></i> Mes Varietés</a></li>
				<li><a href="allvarietes.php"><i class="fa fa-pepper-hot"></i> Varietés</a></li>
				<li><a href="profile.php"><i class="fas fa-address-card"></i> Profile</a></li>
			</ul>
		</div>

		<!-- CONTENT -->

		<div id="content-wrapper">
			<div class="container-fluid">

				<!-- TOP MENU -->

				<div class="row my-top-menu">

					<!-- TOGGLE BUTTON -->

					<div class="col-2 my-toggle-btn">
						<nav class="nav">
							<a class="nav-link" href="#" id="toggle-menu"></a>
						</nav>
					</div>

					<!-- LOGOUT -->

					<div class="col-10">
						<ul class="nav justify-content-end">
							<span class="navbar-text">
								Bonjour, <?php getNom($id); // this function is defined in global.php ?>
							</span>
							<li class="nav-item">
								<a class="nav-link" href="includes/logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
							</li>
						</ul>
					</div>
				</div>

				<!-- MAIN CONTENT -->

				<div class="container my-content">

					<!-- STATISTICS -->

					<div class="row my-statistics">

						<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<div class="card text-center">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-5">
											<h1 class="card-title"><img src="../images/vegetable.png" width="40px"></h1>
										</div>
										<div class="col-7">
											<h2 class="card-title">

											    <?php countMyVariete($id); ?>

											</h2>
											<p class="card-text text-muted">Mes Varietés</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<div class="card text-center">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-5">
											<h1 class="card-title"><img src="../images/vegetable.png" width="40px"></h1>
										</div>
										<div class="col-7">
											<h2 class="card-title">

											    <?php countMyDemande($id); ?>

											</h2>
											<p class="card-text text-muted">Demandes</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<div class="card text-center">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-5">
											<h1 class="card-title"><img src="../images/vegetable.png" width="40px"></h1>
										</div>
										<div class="col-7">
											<h2 class="card-title">

											    <?php countEspece(); ?>

											</h2>
											<p class="card-text text-muted">Especes</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<div class="card text-center">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-5">
											<h1 class="card-title"><img src="../images/vegetable.png" width="40px"></h1>
										</div>
										<div class="col-7">
											<h2 class="card-title">

											     <?php countVariete(); ?>

											</h2>
											<p class="card-text text-muted">Varietés</p>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

					<!-- CHART -->

					<div class="row my-chart">

						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title"><i class="fa fa-chart-area"></i> Graphe des variétés</h4>
									<p class="card-subtitle text-muted">Variétés ajoutées par unité du temps.</p>

									<div class="row justify-content-center my-chart-canvas">
                                        <div class="col-11">
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>

								</div>
							</div>
						</div>
					</div>
					<div class="row my-chart">

						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title"><i class="fa fa-chart-area"></i> Graphe des variétés</h4>
									<p class="card-subtitle text-muted">Variétés ajoutées par espèce.</p>

									<div class="row justify-content-center my-chart-canvas">
                                        <div class="col-11">
                                            <canvas id="myChart2"></canvas>
                                        </div>
                                    </div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php $db = DatabaseUser::disconnect(); ?>

	<script src="js/toggle.js"></script>

        <!-- CHART -->

        <script>
            Chart.defaults.global.defaultFontFamily = 'Lato';
            Chart.defaults.global.defaultFontSize = 14;

            new Chart(document.getElementById("myChart"), {
                type: 'bar',
                data: {
                  labels: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                  datasets: [
                    {
                      label: "Mes Varietés",
                      backgroundColor: "rgba(255, 99, 132, 0.7)",
                      data: <?php monthMyVarieteCount($id); ?>
                    }
                  ]
                },
                options: {
									scales: {
										yAxes: [{
											ticks: {
												beginAtZero: true,
												callback: function(value) {if (value % 1 === 0) {return value;}}
											}
										}]
									}
								}
			});
			new Chart(document.getElementById("myChart2"), {
                type: 'bar',
                data: {
                  labels: <?php especesArray(); ?>,// list of especes
                  datasets: [
                    {
                      label: "Mes Varietés",
                      backgroundColor: "rgba(0, 255, 40, 0.7)",
                      data: <?php countVarieteEspece($id); ?> ,// reuslts of varietes count
                    }
                  ]
                },
                options: {
									scales: {
										yAxes: [{
											ticks: {
												beginAtZero: true,
												callback: function(value) {if (value % 1 === 0) {return value;}}
											}
										}]
									}
								}
			});
        </script>

</body>
</html>
