	<!--Confirm Delete User Form-->
	<div class="modal fade" id="verify_user" tabindex="-1" role="dialog" aria-belledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form role="form" action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash-alt"></i> Supprimer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="body">
						<p></p>
						<input type="text" name="id_user" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                        <button  type="submit"  name="delete_user" class="btn btn-primary">Oui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Change Account Type Form-->
	<div class="modal fade" id="change_type" tabindex="-1" role="dialog" aria-belledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form role="form" action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Modifier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="body">
						<div class="form-group">
							<label>Type : </label>
							<span></span>
						</div>
                        <div class="form-group">
                            <select class="custom-select" name="user_type" id="user_type">
                                <option value="">Selectionner nouveau type</option>
								<?php selectedUserType($_SESSION['type']); ?>
							</select>
							<input type="text" name="id_user" hidden>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
                        <button  type="submit"  name="changer" class="btn btn-primary">Changer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>