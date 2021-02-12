<?php
	require_once '../config/Database.php';
	require_once 'includes/functions.php';

	$id = checkConnection();
?>

<?php include_once "includes/header.php";?>


	<!-- CONTENT -->

	<div class="container">

		<!-- SEARCH BAR -->

		<div class="form-row my-search-input">

			<!-- FILTER -->

			<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
				<select class="custom-select" id="select-espece" onchange="selectEspece();">
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

		<!-- SEARCH RESULTS -->

		<div class="row my-search-result" id="search-result">

			<?php listOfVarietes(); ?>

		</div>
	</div>

    <script src="js/common.js"></script>
    <script src="js/search.js"> </script>

    <?php $db = DatabaseUser::disconnect(); ?>

</body>
</html>
