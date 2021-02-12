$('#verify_valider').on('show.bs.modal',function(e){
    var button = $(e.relatedTarget);
    var id_variete = button.data('id_variete');
    var nom_variete = button.data('nom_variete');
    modal = $(this);
    modal.find('.modal-title').text(nom_variete);// set the form title
    modal.find('.modal-body h6').text("voulez-vous valider variete : " + nom_variete);
    modal.find('.modal-body input').val(id_variete);
});
$('#verify_variete').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var nom_variete = button.data('nom_variete');// get the variety name
    var id_variete = button.data('id_variete');// get the variety name
    var modal = $(this);
    modal.find('.modal-title').text(nom_variete);// set the form title
    modal.find('.modal-body h6').text("voulez-vous supprimer la variete : " + nom_variete ); // set the body text
    modal.find('.modal-body input').val(id_variete);// set the hidden input value
});
