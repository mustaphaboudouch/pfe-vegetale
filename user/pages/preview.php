<?php
    require_once '../../config/Database.php';
    require_once '../includes/functions.php';

    $id = checkConnection();


    if(isset($_GET["id_variete"])){
        $_SESSION['id_variete'] = checkInput($_GET['id_variete']);
    }

    if(!isset($_SESSION['id_variete'])){
        die();
    }else{
        $variete = varieteInfo();
    }
?>

<html>
<head>
    <link rel="icon" href="../../images/leaf.ico" type="image/x-icon"/>
	<title>Voir Varieté</title>
	<!-- META Tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale = 1">
	<!-- JS Files -->
	<script type="text/javascript" src="../../js/html2canvas.js"></script>
	<script type="text/javascript" src="../../js/jspdf.debug.js"></script>
	<script src="../../js/jquery.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<!-- CSS Files -->
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="../../font-awesome/css/all.css">
</head>
<body>

        <!-- TOP MENU -->

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">

                <!-- LOGO -->

                <a class="navbar-brand" href="../home.php"><i class="fa fa-leaf"></i> PFE</a>

                <!-- TOGGLE BUTTON -->

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- NAVIGATION BAR -->
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../home.php">Varietés</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../compare.php">Comparaison</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../includes/logout.php">Déconnecter</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

		<!-- CONTENT -->

		<div class="container my-content"><br>

			<!-- HEADER -->

			<div class="row my-header">
				<div class="col-lg-10 col-md-9 col-sm-8 col-xs-6">
					<h4><i class="fa fa-eye"></i> Varieté : <?php echo $variete['NOM_VARIETE']; ?></h4>
					<p class="text-muted">Organes, caractères et notations</p>
				</div>
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
					<button class="btn btn-primary btn-block btn-lg" id="pdfDownload"><i class="fa fa-download"></i> PDF</a>
				</div>
			</div>

			<!-- VARIETE PREVIEW -->

			<div class="row my-preview" id="pdfTables">

				<!-- IMAGE -->

				<div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 my-image mb-1">
					<div class="card">
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
								<thead class="my-organe-name" style="background-color: #FFFFFF;">
									<tr>
										<th scope="col" colspan="4" class="text-center"><?php echo $organe['NOM_ORGANE']; ?></th>
									</tr>
								</thead>
								<thead style="background-color: #FFFFFF;">
									<tr>
										<th>Caractère</th>
										<th>Niveau d'expression</th>
										<th>Notation</th>
									</tr>
								</thead>
								<tbody style="background-color: #FFFFFF;">

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
								<thead class="my-organe-name" style="background-color: #FFFFFF;">
									<tr>
										<th scope="col" colspan="4" class="text-center">Pathotypes</th>
									</tr>
								</thead>
								<thead style="background-color: #FFFFFF;">
									<tr>
										<th>Pathotype</th>
										<th>Resistance</th>
									</tr>
								</thead>
								<tbody style="background-color: #FFFFFF;">

									<?php

										printPathotypeInfo($variete['ID_VARIETE'],$id,$variete['ID_UTILISATEUR']);

									?>

								</tbody>
							</table>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<script src="../js/common.js"></script>

		<?php $db = DatabaseUser::disconnect(); ?>

		<script>

			$('#pdfDownload').click(function(e){
				const filename  = 'export.pdf';
				html2canvas(document.querySelector('#pdfTables')).then(canvas => {
					let pdf = new jsPDF("l","pt","a4");
					pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 35, 60,760,340);
					pdf.save(filename);
				});
			});

		</script>

	</body>
</html>
