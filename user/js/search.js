function selectEspece(){
    const selectedEspece = $('#select-espece option:selected').text().toLowerCase();
    const especes = $('#search-result  h6');// list of especes
    especes.each(function(i) {
        var card = $(this).parents(':eq(2)');
        var espece = $(this).text().toLowerCase();
        if(selectedEspece == "tous" || espece == selectedEspece){
            card.show();
        }else{
            card.hide();
        }
    });
}
function searchVariete(){
    const searchWord = $('#search').val().toLowerCase();
    const selectedEspece = $('#select-espece option:selected').text().toLowerCase();
    const varietes = $('#search-result h5');// list of variete
    varietes.each(function(i) {
        var card = $(this).parents(':eq(2)');
        var espece = $(this).next().text().toLowerCase();
        var variete = $(this).text().toLowerCase();
        if(espece == selectedEspece || selectedEspece == "tous"){
            if(variete.indexOf(searchWord) != -1){
                card.show();
            }else{
                card.hide();
            }
        }else{
            card.hide();
        }                
    });
}