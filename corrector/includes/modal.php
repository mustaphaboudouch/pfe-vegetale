    <!--Add Modal Form-->
    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-belledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form role="form" id="small_form" action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
                        <button  type="submit"  class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
   	<!-- modal notation delete notation-->
	<div class="modal fade" id="verify_notation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form role="form" action="" method="post" id="modal-form">
				<div class="modal-body">
                    <h6>voulez-vous supprimmer la notation </h6>
					<input type="text" name="id_notation" id="modal_notation" hidden >
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
					<button type="submit" name="delete_notation"  class="btn btn-primary">Oui</button>
				</div>
			</form>
			</div>
		</div>
	</div>

	<!-- modal verify delete variete-->
	<div class="modal fade" id="verify_variete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form role="form" action="" method="post" id="modal-form">
				<div class="modal-body">
					<h6></h6>
					<input type="text" name="id_variete" hidden>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
					<button type="submit" name="delete_variete"  class="btn btn-primary">Oui</button>
				</div>
			</form>
			</div>
		</div>
	</div>

	<!-- modal verify delete resistance -->
	<div class="modal fade" id="verify_resistance" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form role="form" action="" method="post" id="modal-form">
				<div class="modal-body">
                    <h6>voulez-vous supprimmer la resistance </h6>
                    <input type="text" name="id_resistance" id="modal_resistance" hidden>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
					<button type="submit" name="delete_resistance"  class="btn btn-primary">Oui</button>
				</div>
			</form>
			</div>
		</div>
	</div>

		
	
	<!--Valider Variete State Form-->
	<div class="modal fade" id="verify_valider" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<form role="form" action="" method="post" id="modal-form">
					<div class="modal-body">
						<h6></h6>
						<input type="text" name="id_variete" id="modal_variete" hidden>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
						<button type="submit" name="valider_variete"  class="btn btn-primary">Oui</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!--Refuser Variete State Form-->
	<div class="modal fade" id="refuser_variete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<form role="form" action="" method="post" id="modal-form">
					<div class="modal-body">
						<h6></h6>
						<input type="text" name="id_variete" id="modal_variete" hidden>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
						<button type="submit" name="refuser"  class="btn btn-primary">Oui</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
