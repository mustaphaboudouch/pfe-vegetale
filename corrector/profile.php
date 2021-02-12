<?php
    require_once '../config/Database.php';
	require_once 'includes/global.php';
	require_once 'includes/profile-func.php';

	$id = checkConnection();

	if (isset($_POST['update_user'])) {
		updateUser($id);
	}

	userInfo($id);

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
	<title>Profile</title>
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
					<li><a href="varietes.php"><i class="fa fa-pepper-hot"></i> Varietés</a></li>
				    <li><a href="demandes.php"><i class="fa fa-pepper-hot"></i> Demandes</a></li>
					<li><a class="active"><i class="fas fa-address-card"></i> Profile</a></li>
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

							<!-- PROFILE -->

							<div class="row my-profile" align="center">
								<div class="col-12">
									<img src="../images/<?php echo $image_user; ?>" height="80px">
									<h5><?php echo $prenom . ' ' . $nom; ?></h5>
									<p class="text-muted"><?php echo ucfirst($type) ; ?></p>
								</div>
							</div>

							<!-- PROFILE UPDATE -->

							<div class="row my-profile-update">
								<div class="col-12">
									<form method="POST" action="profile.php">
										<div class="form-row">
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<label for="prenom">Prénom</label>
												<input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" value="<?php echo $prenom ?>" required>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<label for="nom">Nom</label>
												<input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" value="<?php echo $nom ?>" required>
											</div>
										</div>
										<div class="form-row">
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<label for="identifiant">Identifiant</label>
												<input type="text" name="identifiant" id="identifiant" class="form-control" placeholder="Identifiant" value="<?php echo $identifiant ?>" required>
												<small class="form-text text-muted" style="color:red!important;"><?php echo $message_error; ?></small>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<label for="motdepasse">Mot de passe</label>
												<input type="password" name="motdepasse" id="motdepasse" class="form-control" placeholder="Mot de passe" value="<?php echo $motdepasse ?>" required>
											</div>
										</div>
										<div class="form-row">
											<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
												<button type="submit" name="update_user" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Modifier</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>

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
