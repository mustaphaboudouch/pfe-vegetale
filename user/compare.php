<?php
	require_once '../config/Database.php';
	require_once 'includes/functions.php';

	$id = checkConnection();

	$id_espece = $id_variete1 = $id_variete2 = 0;

	if (isset($_POST['select_espece'])) {
			$id_espece = $_POST['select_espece'];
	}

	if (isset($_POST['compare'])) {
			$id_espece = $_POST['id_espece'];
			$id_variete1 = $_POST['variete1'];
			$id_variete2 = $_POST['variete2'];

			$data = compareVariete($id_variete1,$id_variete2);
			// get the variete array
			$variete1 = $data[$id_variete1];
			$variete2 = $data[$id_variete2];
			// get the variete name
			$nom_variete1 =$data[$id_variete1]['nom'];
			$nom_variete2 =$data[$id_variete2]['nom'];
	}
?>

<?php include_once "includes/header.php";?>


	<!-- CONTENT -->

	<div class="container"><br>

        <!-- HEADER -->

        <div class="row my-header">
        	<div class="col-lg-10 col-md-9 col-sm-8 col-xs-7">
        		<h4><i class="fas fa-exchange-alt"></i> Comparer les Varietés</h4>
        		<p class="text-muted">Comparaison des caractères communs</p>
        	</div>
			<div class="col-lg-2 col-md-3 col-sm-4 col-xs-5">
				<button class="btn btn-primary btn-block btn-lg" id="pdfDownload"><i class="fa fa-download"></i> PDF</a>
			</div>
        </div>

		<!-- SELECT ESPECE -->

		<form action="compare.php" method="POST" class="my-compare" id="form1">

			<!-- ESPECE -->

			<div class="row my-compare-espece">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<select type="submit" name="select_espece" class="custom-select custom-select-lg" id="select_espece" onchange="selectEspece();">
						<option value="0" selected disabled>Selectionner un Espece</option>

						<?php selectedEspece($id_espece); ?>

					</select>

				</div>
			</div>
		</form>

		<form action="compare.php" method="POST" class="my-compare" id="form2">

			<!-- VARIETES -->

			<div class="form-row my-compare-variete">

				<!-- VARIETE 1 -->

				<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
					<select class="custom-select custom-select-lg" name="variete1" id="variete1">
						<option value="0"  selected disabled>Selectionner une Varietés</option>

						<?php varieteOfEspece($id_espece);	?>

					</select>
				</div>

				<!-- VARIETE 2 -->

				<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
					<select class="custom-select custom-select-lg" name="variete2" id="variete2">
						<option value="0" selected disabled >Selectionner une Varietés</option>

						<?php varieteOfEspece($id_espece);	?>

					</select>
				</div>
				<input type="text" name="id_espece" value="<?php echo $id_espece;?>" hidden>
				<!-- COMPARE BUTTON -->

				<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
					<button name="compare" class="btn btn-primary btn-block btn-lg" type="submit"><i class="fas fa-exchange-alt"></i> Comparer</button>
				</div>

			</div>
		</form><br>

		<!-- SEARCH RESULTS -->

		<div class="row my-compare-result" id="pdfTables">
							<?php
							if(isset($variete1,$variete1)){
								foreach ($variete1['organes'] as $organe1 => $caracteres1){
									foreach ($variete2['organes'] as $organe2 => $caracteres2){
										if($organe1 == $organe2){
							?>
								<div class="col-12">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th scope="col" colspan="3">Organe : <?php echo $organe1; ?></th>
										</tr>
										<tr>
											<th scope="col">Caractère</th>
											<th scope="col"><?php echo $nom_variete1; ?></th>
											<th scope="col"><?php echo $nom_variete2; ?></th>
										</tr>
									</thead>
									  <?php
									  		foreach($caracteres1 as $char1){
												foreach($caracteres2 as $char2){
													if($char1['nom_caractere'] == $char2['nom_caractere']){
														if($char1['nom_niveau_expression'] == "A mesurer" && $char2['nom_niveau_expression'] == "A mesurer"){
										?>
														<tbody>
															<tr>
																<td scope="col"><?php echo $char1['nom_caractere']; ?></td>
																<td scope="col"><?php echo $char1['notation'];  ?></td>
																<td scope="col"><?php  echo $char2['notation']; ?></td>
															</tr>
												  <?php
														} else{
													?>
															<tr>
																<td scope="col"><?php  echo $char1['nom_caractere'];  ?></td>
																<td scope="col"><?php  echo $char1['nom_niveau_expression'];  ?></td>
																<td scope="col"><?php  echo $char2['nom_niveau_expression']; ?></td>
															</tr>
														</tbody>
											<?php			 }
													 		} 
													 } 
												}	
											?>
													</table>
												</div>
							<?php
										}
									}
								}
							}
			                ?>

		</div>
	</div>

	<script src="js/common.js">
	</script>
	<script type="text/javascript">

		function selectEspece() {
			$('#form1').submit();
		}

	</script>

	<?php $db = DatabaseUser::disconnect(); ?>

	<script>


			$('#pdfDownload').click(function(e){
				e.preventDefault();
				if($("table").length != 0){
					const filename  = 'export.pdf';
					html2canvas(document.querySelector('#pdfTables')).then(canvas => {
						let pdf = new jsPDF("l","pt","a4");
						pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 35, 60,760,340);
						pdf.save(filename);
					});
				}
			});

			$("#variete1").change(function(e){
					let variete1Value = $(this).val();
					let variete2Options = $("#variete2").children();
					variete2Options.each(function(i){
						let option = $(this);
						if(option.val() == variete1Value){
							option.prop('disabled',true);
						}else if(option.val() != 0) {
							option.prop('disabled',false);
						}
					});
			});
			$("#variete2").change(function(e){
					let variete2Value = $(this).val();
					let variete1Options = $("#variete1").children();
					variete1Options.each(function(i){
						let option = $(this);
						if(option.val() == variete2Value){
							option.prop('disabled',true);
						}else if(option.val() != 0) {
							option.prop('disabled',false);
						}
					});
			});
			$("#form2").submit(function(e){
				let selects = $("select");
				let flag = true;
				selects.each(function(i){
					let element = $(this);
					if(element.val() == null ){
						element.css({border: '1px solid red',color: 'red'});
						flag = false;
					}
				});
				return flag;
			});
			$("select").change(function(i){
					let element = $(this);
					element.removeAttr("style");
			});
		</script>

</body>
</html>
