<?php
	require_once '../config/Database.php';
	require_once 'includes/global.php';
	require './includes/all-variete-demande-func.php';
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
	//----------------------------//

	// search page
    function allEspeces(){
        global $db;
        $statement = $db->query('SELECT * from ESPECES');
        while ($item = $statement->fetch()) {
            echo '<option value="' . $item['ID_ESPECE'] . '">' . $item['NOM_ESPECE'] . '</option>';
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="../images/leaf.ico" type="image/x-icon"/>
	<title>Tous les Varietés</title>
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
					<li><a href="varietes.php"><i class="fa fa-pepper-hot"></i> Mes Varietés</a></li>
                    <li><a class="active"><i class="fa fa-pepper-hot"></i> Varietés</a></li>
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
							<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
								<h4><i class="fa fa-tasks"></i> Mes Varietés</h4>
								<p class="text-muted">Liste des varietés</p>
							</div>
						</div>

						<!-- SEARCH BAR  -->

						<div class="row">
                            <div class="col-12">
                                <form>
                                    <div class="form-row my-search-input">

                                        <!-- FILTER -->

                                        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                            <select class="custom-select" id="select-espece" onchange="selectEspece(); " >
                                                <option value="0" selected>Tous</option>

                                                <?php allEspeces(); ?>

                                            </select>
                                        </div>

                                        <!-- SEARCH INPUT -->

                                        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search for vegetable varieties" aria-describedby="search-btn" id="search" onkeyup="searchVariete();">
                                            </div>
                                        </div>
                                    </div>
                                </form>
							</div>
						</div>

						<!-- TABLE -->

						<div class="row my-table">
							<div class="col-12">
								<table class="table table-bordered" >
									<thead>
										<tr>
											<th scope="col">Varietés</th>
                                            <th scope="col">Espece</th>
											<th scope="col">Date de creation</th>
											<th scope="col">Actions</th>
										</tr>
									</thead>
									<tbody >

										<?php
											getAllVarietes($id);
								        ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

    <?php require 'includes/modal.php'; ?>

	<script src="js/search.js"></script>

	<?php $db = DatabaseUser::disconnect(); ?>

	<script src="js/toggle.js"></script>


	</body>
</html>
