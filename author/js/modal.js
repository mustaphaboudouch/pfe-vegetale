$('#verify_variete').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var nom_variete = button.data('nom_variete');// get the variety name
    var id_variete = button.data('id_variete');// get the variety name
    var modal = $(this);
    modal.find('.modal-title').text(nom_variete);// set the form title
    modal.find('.modal-body h6').text("voulez-vous supprimer la variete : " + nom_variete ); // set the body text
    modal.find('.modal-body input').val(id_variete);// set the hidden input value
});
 $('#verify_notation').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_notation = button.data('id_notation');
    var modal = $(this);
    modal.find('.modal-title').text("Confirmation");// set the form title
    modal.find('#modal_notation').val(id_notation);
    
});
$('#verify_resistance').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_resistance = button.data('id_resistance');// get the resistance id
    var modal = $(this);
    modal.find('.modal-title').text("Confirmation");// set the form title 
    modal.find('#modal_resistance').val(id_resistance);
});
