<?php
    require '../config/Database.php';
    require './includes/functions.php';
    include './includes/chart.php';

    $id = checkConnection();
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
				<li><a href="admins.php"><i class="fa fa-users"></i> Admins</a></li>
				<li><a href="correctors.php"><i class="fa fa-users"></i> Correcteurs</a></li>
				<li><a href="authors.php"><i class="fa fa-users"></i> Auteurs</a></li>
				<li><a href="users.php"><i class="fa fa-users"></i> Utilisateurs</a></li>
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
								Bonjour, <?php getNom($id); ?>
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
											<h1 class="card-title"><img src="../images/admins.png" width="40px"></h1>
										</div>
										<div class="col-7">
											<h2 class="card-title">

												<?php countUser('admin'); ?>

											</h2>
											<p class="card-text text-muted">Admins</p>
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
											<h1 class="card-title"><img src="../images/admins.png" width="40px"></h1></h1>
										</div>
										<div class="col-7">
											<h2 class="card-title">

												<?php countUser('correcteur'); ?>

											</h2>
											<p class="card-text text-muted">Correcteurs</p>
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
											<h1 class="card-title"><img src="../images/users.png" width="40px"></h1>
										</div>
										<div class="col-7">
											<h2 class="card-title">

												<?php countUser('auteur'); ?>

											</h2>
											<p class="card-text text-muted">Auteurs</p>
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
											<h1 class="card-title"><img src="../images/users.png" width="40px"></h1>
										</div>
										<div class="col-7">
											<h2 class="card-title">

												<?php countUser('utilisateur'); ?>

											</h2>
											<p class="card-text text-muted">Utilisateurs</p>
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
								    <div class="row align-items-center">
								        <div class="col-lg-9 col-md-8 col-sm-6 col-xs-6">
								            <h4 class="card-title"><i class="fa fa-chart-area"></i> Graphe des comptes</h4>
                                            <p class="card-subtitle text-muted">Utilisateurs inscrits par unité du temps.</p>
								        </div>
								        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
								            <select id="select-chart" class="custom-select">
								                <option value="0" selected>Tous</option>
								                <option value="1">Admins</option>
								                <option value="2">Correcteurs</option>
								                <option value="3">Auteurs</option>
								                <option value="4">Utilisateurs</option>
								            </select>
								        </div>
								    </div>

									<div class="row justify-content-center my-chart-canvas">
                                        <div class="col-11">
                                            <canvas ></canvas>
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

	<!-- TOGGLE -->

	<script>
        $("#content-wrapper").css('paddingLeft', '250px');
        $('#toggle-menu').html('<i class="fa fa-chevron-left"></i>');
        $('#toggle-menu').click(function() {
            if($('#sidebar-wrapper').width() == 0) {
                $("#sidebar-wrapper").animate({width: "250px"});
                $("#content-wrapper").animate({paddingLeft: "250px"});
                $("#sidebar-wrapper .my-logo").fadeIn(1000);
                $("#sidebar-wrapper .my-menu").fadeIn(1000);
                $('#toggle-menu').html('<i class="fa fa-chevron-left"></i>');
            } else {
                $("#sidebar-wrapper").animate({width: "0px"});
                $("#content-wrapper").animate({paddingLeft: "0px"});
                $("#sidebar-wrapper .my-logo").hide();
                $("#sidebar-wrapper .my-menu").hide();
                $('#toggle-menu').html('<i class="fa fa-chevron-right"></i>');
            }
        });
    </script>

    <!-- CHANGE CHART -->

    <script>
      var myChart;
      var months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"]
      var admins = {
                    label: "Admins",
                    backgroundColor: "rgba(255, 99, 132, 0.7)",
                    data: <?php monthUserCount('admin'); ?>
                  };
      var users = {
                    label: "Utilisateurs",
                    backgroundColor: "rgba(75, 192, 192, 0.7)",
                    data: <?php monthUserCount('utilisateur'); ?>
                  };
      var correctors = {
                    label: "Correcteurs",
                    backgroundColor: "rgba(54, 162, 235, 0.7)",
                    data: <?php monthUserCount('correcteur'); ?>
                  };
      var authors = {
                    label: "Auteurs",
                    backgroundColor: "rgba(255, 206, 86, 0.7)",
                    data: <?php monthUserCount('auteur'); ?>
				  };

      function showChart(element,dataset){
        Chart.defaults.global.defaultFontFamily = 'Lato';
        Chart.defaults.global.defaultFontSize = 14;
        if (myChart) {
          myChart.destroy();// first you need to destroy old chart so you wouldn't hovering problems
        }
        myChart = new Chart(document.getElementById(element), {
            type: 'bar',
            data: {
              labels: months , // months
              datasets: dataset // dataset is array of what you want to display
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
      }

      $(document).ready(function(){
        $('.my-chart-canvas div canvas').attr("id","myChart0");
        showChart("myChart0",[admins,correctors,authors,users]);//show default chart on page load
      });

      $('#select-chart').change(function() {
        if ($(this).val() == 0) {
            $('.my-chart-canvas div canvas').attr("id","myChart0");
            showChart("myChart0",[admins,correctors,authors,users]);
        }
        else if ($(this).val() == 1) {
            $('.my-chart-canvas div canvas').attr("id","myChart1");
            showChart("myChart1",[admins]);
        }
        else if ($(this).val() == 2) {
            $('.my-chart-canvas div canvas').attr("id","myChart2");
            showChart("myChart2",[correctors]);
        }
        else if ($(this).val() == 3) {
            $('.my-chart-canvas div canvas').attr("id","myChart3");
            showChart("myChart3",[authors]);
        }
        else if ($(this).val() == 4) {
            $('.my-chart-canvas div canvas').attr("id","myChart4");
            showChart("myChart4",[users]);
        }
    });
  </script>

</body>
</html>
