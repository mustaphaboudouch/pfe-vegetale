$('#change_type').on('show.bs.modal', function(e){
	var button = $(e.relatedTarget);
	var type = button.data('usertype');
	var id = button.data('id_user');
	var modal = $(this);
	modal.find('.modal-body input').val(id);
	modal.find('.modal-body span').text(type);
	});
$('#verify_user').on('show.bs.modal', function(e){
	var button = $(e.relatedTarget);
	var id = button.data('id_user');
	var nom = button.data('nom');
	var modal = $(this);
	modal.find('.modal-body input').val(id);
	modal.find('.modal-body p').text("Vous êtes sûre de supprimer l'utilisateur: " +nom);
});
