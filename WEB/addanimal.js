function add_animal() {
    var x
    var categorie = document.getElementById('inputCategorie').value
    console.log(categorie)
    if (categorie == 'Pisici')
        x = 1;
    if (categorie == 'Câini')
        x = 2;
    if (categorie == 'Rozătoare')
        x = 3;
    if (categorie == 'Reptila')
        x = 4;
    if (categorie == 'Pasăre')
        x = 5;
    if (categorie == 'Acvatice')
        x = 6;
    const data = {
        pet_name: document.getElementById('inputName').value,
        pet_description: document.getElementById('inputDescription').value,
        pet_type: x,
        pet_breed: document.getElementById('inputRasa').value,
        UID: 'nuEste'
            // document.getElementById('user_name').firstChild.firstChild
    }

    $.post('http://secondhome.fragmentedpixel.com/server/addanimal.php', data, function(result, status) {
            console.log(`${result} este ${status}`)
        }).done(function() {
            console.log('S-a trimis');
            location.reload();
        })
        .fail(function(jqxhr, settings, ex) { alert('failed, ' + ex); });
}