function selectEspece(){
    const selectedEspece = $('#select-espece option:selected').text().toLowerCase();
    const especes = $('tbody tr td:nth-child(2)');// list of especes
    especes.each(function(i) {
        var allRows = $(this).parents(':eq(1)').children();
        var row = $(this).parent();
        var espece = $(this).text().toLowerCase();
        if(selectedEspece == "tous"){
            allRows.show();
        }
        else if(espece == selectedEspece){
            row.show();
        }else{
            row.hide();
        }
    });
}
function searchVariete(){
    const searchWord = $('#search').val().toLowerCase();
    const selectedEspece = $('#select-espece option:selected').text().toLowerCase();
    const varietes = $('tbody tr td:nth-child(1)');
    varietes.each(function(i) {
        var row = $(this).parent();
        var espece = $(this).next().text().toLowerCase();
        var variete = $(this).text().toLowerCase();
        if(espece == selectedEspece || selectedEspece == "tous"){
            if(variete.indexOf(searchWord) != -1){
                row.show();
            }else{
                row.hide();
            }
        }else{
            row.hide();
        }
        
    });
}