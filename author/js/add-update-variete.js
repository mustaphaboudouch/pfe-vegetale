// change the values of the modal form according to the element you wanna add
$('#addmodal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var type = button.data('type'); // get the type
    var title = button.data('title');// get the title
    var modal = $(this);
    modal.find('.modal-title').text(title);// set the form title
    modal.find('.modal-body input').attr('name',type); // set the input name 
});


function big_form_submit() {
    // check before submitting big form
    $("#big_form").submit(function(event){
        let flag = true;
        // if variete is empty
        if($('#variete').val() == '') {
            $('#variete').css({border: '1px solid red',color: 'red'});
            $('#variete').attr('placeholder',"Champ est vide");
            /*("<span style='text-align:center;'> champ est vide</span>").appendTo('.variete');*/
            flag = false;
        }
        // if no espece is selected
        if($('#espece').val() == '-1') {
            $('#espece').css({border: '1px solid red',color: 'red'});
            flag = false;
        }
        if($('#customFile').val() == '') {
            $('#customFile').next().css({border: '1px solid red',color: 'red'});
            flag = false;
        }
        return flag;
    });
}
// return variete input to its original state
$('#variete').keypress(function(event){
    // return to bootsrap style
    $(this).removeAttr('style');
    // change the value of placeholder to variete
    $(this).attr('placeholder',"Variete");
});
// return select element to its original state
$('select').change(function(event){
    // return to bootsrap style
    $(this).removeAttr('style');
});
// return image input to its original state
$('#customFile').change(function(event){
    // return to bootsrap style
    $('#customFile').next().removeAttr('style');
});