<?php
require_once '../../config/Database.php';
require_once '../includes/global.php';
require_once '../includes/preview-variete-func.php';

$id = checkConnection();

if(isset($_POST["id_variete_img"])){
    $_SESSION['id_variete'] = checkInput($_POST['id_variete_img']);
}

if(!isset($_SESSION['id_variete'])){
    dying();
}else{
    $variete = varieteInfo();
}


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="../../images/leaf.ico" type="image/x-icon"/>
	<title>Voir Varieté</title>
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
				<li><a href="../varietes.php"><i class="fa fa-pepper-hot"></i> Varietés</a></li>
				<li><a href="../demandes.php"><i class="fa fa-pepper-hot"></i> Demandes</a></li>
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
								<a class="nav-link" href="../includes/logout.php"><i class="fa fa-power-off"></i> Déconnecter</a>
							</li>
						</ul>
					</div>
				</div>

				<!-- MAIN CONTENT -->

				<div class="container my-content">

				    <!-- HEADER -->

					<div class="row my-header">
						<div class="col-6">
							<h4><i class="fa fa-eye"></i> Varieté : <?php echo $variete['NOM_VARIETE']; ?></h4>
							<p class="text-muted">Organes, caractères et notations</p>
						</div>
					</div>

					<!-- VARIETE PREVIEW -->

					<div class="row my-preview">

                        <!-- IMAGE -->

                        <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 my-image">
                            <div class="card" style="margin-top: 10px; border: 1px solid #eaedf6; border-radius: 5px;">
                                <img src="../../images/<?php echo $variete['IMAGE_VARIETE']; ?>" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $variete['NOM_VARIETE']; ?></h5>
                                    <p class="card-subtitle text-muted"><?php echo $variete['NOM_ESPECE']; ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- INFOS -->

                    <div class="col-lg-9 col-md-7 col-sm-12 col-xs-12 my-table">

                        <?php
                            $organes = organesOfVariete($variete['ID_VARIETE']);
                            $organesInfo = organeInfo($variete['ID_VARIETE']);
                            foreach($organes as $organe):
                        ?>

                        <div class="row">
                            <div class="my-table col-12">
                                <table class="table table-bordered table-hover">
                                    <thead class="my-organe-name">
                                        <tr>
                                            <th scope="col" colspan="4" class="text-center"><?php echo $organe['NOM_ORGANE']; ?></th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <th>Caractère</th>
                                            <th>Niveau d'expression</th>
                                            <th>Notation</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            printOrganeInfo($organe['ID_ORGANE'],$organesInfo,$id,$variete['ID_UTILISATEUR']);
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endforeach;?>

                        <!-- Pathotype -->
                        <?php if(hasResistance($variete['ID_VARIETE'])): ?>
                            <div class="row">
                                <div class="my-table col-12">
                                    <table class="table table-bordered table-hover">
                                        <thead class="my-organe-name">
                                            <tr>
                                                <th scope="col" colspan="4" class="text-center">Pathotypes</th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th>Pathotype</th>
                                                <th>Resistance</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                printPathotypeInfo($variete['ID_VARIETE'],$id,$variete['ID_UTILISATEUR']);
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php include_once "../includes/modal.php";?>

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
