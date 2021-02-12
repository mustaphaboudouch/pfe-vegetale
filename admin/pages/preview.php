<?php
    require '../../config/Database.php';
    require '../includes/functions.php';

    $id = checkConnection();

    if(isset($_POST['preview'])){
        $account = getAccount($_POST['id']);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="../../images/leaf.ico" type="image/x-icon"/>
	<title>Preview</title>
	<!-- META tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSS Files -->
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../font-awesome/css/all.min.css">
	<!-- JS Files -->
	<script type="text/javascript" src="../../js/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
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
				<li><a href="../dashboard.php"><i class="fas fa-columns"></i> Dashboard</a></li>
				<li><a href="../admins.php"><i class="fa fa-users"></i> Admins</a></li>
				<li><a href="../correctors.php"><i class="fa fa-users"></i> Correcteurs</a></li>
				<li><a href="../authors.php"><i class="fa fa-users"></i> Auteurs</a></li>
				<li><a href="../users.php"><i class="fa fa-users"></i> Utilisateurs</a></li>
				<li><a href="../profile.php"><i class="fas fa-address-card"></i> Profile</a></li>
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
							<img src="../../images/<?php echo $account['IMAGE_UTILISATEUR']; ?>" height="80px">
							<h5><?php echo $account['PRENOM'] . ' ' . $account['NOM']; ?></h5>
							<p class="text-muted"><?php echo ucfirst(strtolower($account['TYPE_COMPTE'])); ?></p>
						</div>
					</div>

					<!-- PROFILE INFOS -->

					<div class="row my-profile-infos">
						<div class="col-12">
							<ul class="list-group">
								<li class="list-group-item"><span>Nom :</span> <?php echo $account['PRENOM'] . ' ' . $account['NOM']; ?></li>
								<li class="list-group-item"><span>Identifiant :</span> <?php echo $account['IDENTIFIANT']; ?></li>
								<li class="list-group-item"><span>Mot de passe :</span> <?php echo $account['MOT_DE_PASSE']; ?></li>
								<li class="list-group-item"><span>Type de compte :</span> <?php echo $account['TYPE_COMPTE']; ?></li>
							</ul>
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
