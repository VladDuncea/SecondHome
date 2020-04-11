function add_animal() {
    var x
    var categorie = document.getElementById('inputCategorie').value
        // console.log(categorie)

    x = 6;
    const data = {
        pet_name: document.getElementById('inputName').value,
        pet_description: document.getElementById('inputDescription').value,
        pet_type: categorie,
        pet_breed: document.getElementById('inputRasa').value,
        pet_age: document.getElementById('inputVarsta').value
    }

    $.post('http://secondhome.fragmentedpixel.com/server/addanimal.php', data, function(result, status) {
            console.log(`${result} este ${status}`)
        }).done(function() {
            location.reload();
            console.log('S-a trimis');
        })
        .fail(function(jqxhr, settings, ex) { alert('failed, ' + ex); });
}