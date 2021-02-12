<?php
    require '../config/Database.php';
    require './includes/functions.php';

    $id = checkConnection();

    if(isset($_POST['changer'])){
        changeUserType();
    }

    if(isset($_POST['delete_user'])){
        deleteUser();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="../images/leaf.ico" type="image/x-icon"/>
	<title>Auteurs</title>
	<!-- META tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- JS Files -->
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<!-- CSS Files -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/all.min.css">

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
					<li><a href="admins.php"><i class="fa fa-users"></i> Admins</a></li>
					<li><a href="correctors.php"><i class="fa fa-users"></i> Correcteurs</a></li>
					<li><a class="active"><i class="fa fa-users"></i> Auteurs</a></li>
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

						<!-- HEADER -->

						<div class="row my-header">
							<div class="col-12">
								<h4><i class="fa fa-tasks"></i> Auteurs</h4>
								<p class="text-muted">Liste des auteurs</p>
							</div>
						</div>

						<!-- TABLE -->

						<div class="row my-table">
							<div class="col-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">Prénom</th>
											<th scope="col">Nom</th>
											<th scope="col">Date d'inscription</th>
											<th scope="col">Actions</th>
										</tr>
									</thead>
									<tbody>

										<?php
											getUser($id,'auteur');
										?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include_once('includes/modal.php'); ?>

		<script src="js/change-delete-user.js"></script>

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
