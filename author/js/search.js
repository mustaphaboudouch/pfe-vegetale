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
function selectEtat(){
    const selectedEtat= $('#select-etat option:selected').val();
    const etats = $('tbody tr td:nth-child(4)');// list of etats
    etats.each(function(i) {
        var allRows = $(this).parents(':eq(1)').children();
        var row = $(this).parent();
        var etat = $(this).text().toLowerCase();
        if(selectedEtat == -1){
            allRows.show();
        }else if(selectedEtat == 0){
            if(etat == "en attente") row.show();
            else row.hide();
        }else if(selectedEtat == 1){
            if(etat == "approuvé") row.show();
            else row.hide();
        }
    });
}

function searchVarieteEtat(){
    const searchWord = $('#my-search').val().toLowerCase();
    const selectedEtat = $('#select-etat option:selected').text().toLowerCase();
    const varietes = $('tbody tr td:nth-child(1)');
    varietes.each(function(i) {
        var row = $(this).parent();
        var etat = $(this).nextAll(":eq(2)").text().toLowerCase();
        console.log(etat);
        var variete = $(this).text().toLowerCase();
        console.log(variete);
        if(etat == selectedEtat || selectedEtat == "tous"){
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