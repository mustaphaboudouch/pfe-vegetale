<?php
	require_once '../config/Database.php';
	require_once 'includes/functions.php';

	$id = checkConnection();
		
	if (isset($_POST['update_user'])) {
		updateUser($id);
	}

	userInfo($id);
	

?>

<?php include_once "includes/header.php";?>


	<!-- CONTENT -->

	<div class="container">

		<!-- PROFILE HEADER -->

		<div class="row my-profile-header" align="center">
			<div class="col-12">
				<img width="80px" src="../images/<?php echo $image_user; ?>">
				<h4><?php echo $nom . " " . $prenom; ?></h4>
				<h6 class="text-muted">Utilisateur</h6>
			</div>
		</div>

		<!-- EDIT USER -->
		
		<div class="row my-profile-update justify-content-center">
			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
				<?php echo $message_error; ?>
				<form action="" method="POST">
				    <div class="form-row">
				        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				            <div class="form-group">
                                <label for="prenom">Prénom</label>
                                <input name="prenom" type="text" class="form-control" placeholder="Prénom" value="<?php echo $prenom; ?>">
                            </div>
				        </div>
				        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input name="nom" type="text" class="form-control" placeholder="Nom" value="<?php echo $nom; ?>">
                            </div>
				        </div>
				    </div>
				    <div class="form-row">
				        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				            <div class="form-group">
                                <label for="identifiant">Identifiant</label>
                                <input name="identifiant" type="text" class="form-control" placeholder="Identifiant" value="<?php echo $identifiant; ?>">
                            </div>
				        </div>
				        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				            <div class="form-group">
                                <label for="motdepasse">Mot de passe</label>
                                <input name="motdepasse" type="password" class="form-control" placeholder="Mot de passe" value="<?php echo $motdepasse; ?>">
                            </div>
				        </div>
				    </div>
				    <div class="form-row">
				        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <button  type="submit" name="update_user" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Modifier</button>
				        </div>
				    </div>			
				</form>
			</div>
		</div>		
	</div>

	<script src="js/common.js">
	</script>	

	<?php $db = DatabaseUser::disconnect(); ?>
	
</body>
</html>