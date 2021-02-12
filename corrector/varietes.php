<?php
    require_once '../config/Database.php';
	require_once './includes/global.php';
	require_once './includes/functions.php';
	$id = checkConnection();

	if(isset($_POST['delete_variete'])){
		deleteVariete();
	}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="../images/leaf.ico" type="image/x-icon"/>
	<title>Varietés</title>
	<!-- META tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSS Files -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/all.min.css">
	<!-- JS Files -->
	<script type="text/javascript" src="../js/jquery.min.js"></script>
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
					<li><a href="dashboard.php"><i class="fas fa-columns"></i> Dashboard</a></li>
					<li><a href="varietes.php" class="active"><i class="fa fa-pepper-hot"></i> Varietés</a></li>
					<li><a href="demandes.php"><i class="fa fa-pepper-hot"></i> Demandes</a></li>
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

						<!-- HEADER -->

						<div class="row my-header">
							<div class="col-12">
								<h4><i class="fa fa-tasks"></i> Varietés</h4>
								<p class="text-muted">Liste des varietés</p>
							</div>
						</div>

						<!-- Search Form  -->

						<div class="row">
						    <div class="col-12">
							<form>
								<div class="form-row my-search-input">

									<!-- FILTER -->

									<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
										<select class="custom-select" id="select-espece" onchange="selectEspece(); " >
											<option value="0" selected>Tous</option>
											<?php
                                                allEspeces();
                                            ?>
										</select>
									</div>

									<!-- SEARCH INPUT -->

									<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
								        <input type="text" class="form-control" placeholder="Search for vegetable varieties" aria-describedby="search-btn" id="search" onkeyup="searchVariete();">
									</div>
								</div>
							</form>
							</div>
						</div>

						<!-- TABLE -->

						<div class="row my-table">
							<div class="col-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">Varietés</th>
                                            <th scope="col">Espece</th>
											<th scope="col">Auteur</th>
											<th scope="col">Date de creation</th>
											<th scope="col">Actions</th>
										</tr>
									</thead>
									<tbody>

										<?php getVarietes(); ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php include_once('includes/modal.php'); ?>

	<script src="js/search.js"></script>
	<script src="js/modal.js"></script>

	<?php $db = DatabaseUser::disconnect(); ?>

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


	</body>
</html>
