<?php
require_once '../../config/Database.php';
require_once '../includes/global.php';
require_once '../includes/add-notation-func.php';

$id = checkConnection();

if(!isset($_SESSION['id_variete'])){
	die("variete not found");
}else{
	$id_variete = $_SESSION['id_variete'];
}

// unset not needed variables
if(isset($_SESSION['id_notation'])){
	unset($_SESSION['id_notation']);
}
if(isset($_SESSION['id_resistance'])){
	unset($_SESSION['id_resistance']);
}
//-------------------------------//
if(isset($_POST['new_organe'])){
	addOrgane();
}
if(isset($_POST['new_caractere'])){
	addCaractere();
}
if(isset($_POST['new_niveau'])){
	addNiveauExpression();
}

if(isset($_POST['insert_notation'])){
	addNotation();
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="../../images/leaf.ico" type="image/x-icon"/>
	<title>Ajouter Notation</title>
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
				<li><a href="../varietes.php"><i class="fa fa-pepper-hot"></i> Mes Varietés</a></li>
				<li><a href="../allvarietes.php"><i class="fa fa-pepper-hot"></i> Varietés</a></li>
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
				        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				            <h4><i class="fa fa-plus-circle"></i> Ajouter Notation</h4>
				            <p class="text-muted">Organes, caractères et notations</p>
				        </div>
				        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 mb-2">
				            <a href="add-resistance.php" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Pathotype</a>
				        </div>
				        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
				            <a href="preview-variete.php" class="btn btn-primary btn-block"><i class="fa fa-arrow-left"></i> Notations</a>
				        </div>
				    </div>

				    <!-- ADD NOTATION -->

				    <div class="row my-add-variete">
				        <div class="col-12">
                            <form action="" method="post" id="big_form">

                                <div class="form-row">
                                    <div class="col-lg-10 col-md-8 col-sm-12 col-xs-12">
                                        <select class="custom-select" id="organe" name="organe">
                                            <option value="-1">Selectionner l'organe</option>
                                            <?php allOrganes(); ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addmodal" data-title=" Nouvelle Organe" data-type="new_organe"><i class="fa fa-plus"></i> Nouveau</button>
                                    </div>
                                </div>
								<?php echo $message_error3; ?>
                                <div class="form-row">
                                    <div class="col-lg-10 col-md-8 col-sm-12 col-xs-12">
                                        <select class="custom-select" id="caractere" name="caractere">
                                            <option value="-1">Selectionner le caratère</option>
                                            <?php allCaracteres();  ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addmodal" data-title=" Nouvelle Caractere" data-type="new_caractere"><i class="fa fa-plus"></i> Nouveau</button>
                                    </div>
                                </div>
								<?php echo $message_error4; ?>
                                <div class="form-row">
                                    <div class="col-lg-10 col-md-8 col-sm-12 col-xs-12">
                                        <select class="custom-select" id="niveau" name="niveau">
                                            <option value="-1">Selectionner le niveau d'expression</option>
                                            <?php  allNiveauExpressions(); ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addmodal" data-title=" Nouvelle Niveau d'expression" data-type="new_niveau"><i class="fa fa-plus"></i> Nouveau</button>
                                    </div>
                                </div>
								<?php echo $message_error5; ?>
                                <div class="form-row">
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="notation" id="notation"  disabled placeholder="Notation">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-13">
                                        <button type="submit" class="btn btn-success btn-block" name="insert_notation" onclick="big_form_submit();">Enregistrer</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

				</div>
			</div>
		</div>
	</div>

	<?php include_once "../includes/modal.php";?>

    <!-- JS Files -->
    <script src="../js/add-update-notation.js"></script>

	<?php $db = DatabaseUser::disconnect(); ?>

	<!-- <script src="js/toggle.js"></script> -->
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
