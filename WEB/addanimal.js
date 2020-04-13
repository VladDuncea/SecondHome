function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah')
                .attr('src', e.target.result)
                .width(160)
                .height(160);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function add_animal() {

    var categorie = document.getElementById('inputCategorie').value;
    // console.log(categorie)
    var jform = new FormData();
    jform.append('pet_image', $('#getFile')[0].files[0]);
    jform.append('pet_name', document.getElementById('inputName').value);
    jform.append('pet_description', document.getElementById('inputDescription').value);
    jform.append('pet_type', categorie);
    jform.append('pet_breed', document.getElementById('inputRasa').value);
    jform.append('pet_age', document.getElementById('inputVarsta').value);

    $.ajax({
        url: '/server/addanimal.php',
        type: 'POST',
        data: jform,
        dataType: 'json',
        mimeType: 'multipart/form-data', // this too
        contentType: false,
        cache: false,
        processData: false,
        success: function(data, status, jqXHR) {
            alert('Hooray! All is well.');
            console.log(data);
            console.log(status);
            console.log(jqXHR);

        },
        error: function(jqXHR, status, error) {
            // Hopefully we should never reach here
            console.log(jqXHR);
            console.log(status);
            console.log(error);
        }
    });
}