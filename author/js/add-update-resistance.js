// change the values of the modal form according to the element you wanna add
$('#addmodal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var type = button.data('type'); // get the type
    var title = button.data('title');// get the title
    var modal = $(this);
    modal.find('.modal-title').text(title);// set the form title
    modal.find('.modal-body input').attr('name',type); // set the input name 
});

function form_submit() {
    // check before submitting big form
    $("#form").submit(function(event){
        let flag = true;
        // if no pathotype is is selected
        if($('#pathotype').val() == '-1') {
            $('#pathotype').css({border: '1px solid red',color: 'red'});
            flag = false;
        }
        // if no resistance is selected
        if($('#resistance').val() == '-1') {
            $('#resistance').css({border: '1px solid red',color: 'red'});
            flag = false;
        }
        return flag;
    });
}        
// return select elements to their original state
$('select').change(function(event){
    // return to bootsrap style
    $(this).removeAttr('style');
});