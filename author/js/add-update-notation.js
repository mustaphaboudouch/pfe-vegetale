// change the values of the modal form according to the element you wanna add
$('#addmodal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var type = button.data('type'); // get the type
    var title = button.data('title');// get the title
    var modal = $(this);
    modal.find('.modal-title').text(title);// set the form title
    modal.find('.modal-body input').attr('name',type); // set the input name 
});
// submitting modal form (small form)
function small_form_submit() {
    $("#small_form").submit();
}

function big_form_submit() {
    // check before submitting big form
    $("#big_form").submit(function(event){
        let flag = true;
        // if no organe is is selected
        if($('#organe').val() == '-1') {
            $('#organe').css({border: '1px solid red',color: 'red'});
            flag = false;
        }
        // if no caractere is selected
        if($('#caractere').val() == '-1') {
            $('#caractere').css({border: '1px solid red',color: 'red'});
            flag = false;
        }
        // if no viveau d'expression is selected
        if($('#niveau').val() == '-1') {
            $('#niveau').css({border: '1px solid red',color: 'red'});
            flag = false;
        }
        // if notation is empty or is not a number or not disabled
        if(!$('#notation').prop('disabled') && ( !$.isNumeric($('#notation').val()) || $('#notation').val() == '')) {
            $('#notation').css({border: '1px solid red',color: 'red'});
            $('#notation').val('');
            $('#notation').attr('placeholder',"valeur doit être un nombre");
            flag = false;
        }
        return flag;
    });
}
// return notation input to its original state
$('#notation').keypress(function(event){
    // return to bootsrap style
    $(this).removeAttr('style');
    // change the value of placeholder to variete
    $(this).attr('placeholder',"Notation");
});
// return select elements to their original state
$('select').change(function(event){
    // return to bootsrap style
    $(this).removeAttr('style');
});
$('#niveau').change(function(event){
    // disable or enable notation field when 'A mesure' is selected
    // !!important trim()
    if($('#niveau option:selected').text().trim() !== "A mesurer"){
        $('#notation').prop('disabled',true);
    }else{
        $('#notation').prop('disabled',false); 
    } 
    // return to bootsrap style
    $(this).removeAttr('style');
    $('#notation').removeAttr('style');
});