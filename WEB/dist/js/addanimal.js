var cropper;
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
            
            var image = document.querySelector('#blah');
            //document.querySelector('#cropper_container').style.height = "500px";
            image.style.display = "initial";
            if(cropper)
            {
                cropper.destroy();
            }
            cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3});
        };
        reader.readAsDataURL(input.files[0]);

    }
}

function add_animal() {

    var categorie = document.getElementById('inputCategorie').value;
    // console.log(categorie)
    var jform = new FormData();
    var canvas;
    if (cropper) {
        canvas = cropper.getCroppedCanvas({
        width: 128,
        height: 128,
        });
    }
    //jform.append('pet_image', $('#getFile')[0].files[0]);
    jform.append('imgbase64', canvas.toDataURL());
    jform.append('pet_name', document.getElementById('inputName').value);
    jform.append('pet_description', document.getElementById('inputDescription').value);
    jform.append('pet_type', categorie);
    jform.append('pet_breed', document.getElementById('inputRasa').value);
    jform.append('pet_age', document.getElementById('inputVarsta').value);
    if(cropper)
    {
        cropper.destroy();
        cropper= null;
    }
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
            //TODO use adminlte notification
            if (data['status'] == 1) {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Succes!',
                    subtitle: '',
                    body: 'Animalul dvs a fost adaugat cu succes, il puteti vedea si edita in pagina Animalele mele.'
                });
            } else {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Eroare',
                    subtitle: '',
                    body: 'Eroare la adaugare animal!'
                })
            }
        },
        error: function(jqXHR, status, error) {
            //TODO use adminlte notification
            alert('Eroare adaugare animal!');
        }
    });
}

var validator = $('#addanimal_form').validate({
    submitHandler: function(form) {
        add_animal();
        form.reset();
        document.getElementById("blah").style.display = "none";
        //document.querySelector('#cropper_container').style.height = "1";
    },
    rules: {
        animal_name: {
            maxlength: 10,
            required: true
        },
        animal_type: {
            required: true
        },
        animal_age: {
            required: true,
            range: [1, 100]
        },
        animal_breed: {
            maxlength: 10,
            required: true
        },
        animal_description: {
            required: true,
            minlength: 10
        },
        animal_image: {
            required: true
        },
    },
    messages: {
        animal_name: {
            maxlength: "Numele poate sa aiba maxim 10 caractere",
            required: "Campul este obligatoriu"
        },
        animal_type: {
            required: "Campul este obligatoriu"
        },
        animal_age: {
            required: "Campul este obligatoriu",
            range: "Valoare invalida"
        },
        animal_breed: {
            maxlength: "Rasa poate sa aiba maxim 10 caractere",
            required: "Campul este obligatoriu"
        },
        animal_description: {
            required: "Campul este obligatoriu",
            minlength: "Descrierea trebuie sa aiba minim 10 caractere"
        },
        animal_image: {
            required: "Campul este obligatoriu"
        },
    },
    errorElement: 'span',
    errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});