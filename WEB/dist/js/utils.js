//grafice pagina de home
function homepage() {

    $.post('server/getstatistics.php', function(data, status) {
        var json_data = JSON.parse(data)
        if (json_data.status == 1) {
            var ctxD = document.getElementById("donutChart1").getContext('2d');
            var myLineChart = new Chart(ctxD, {
                type: 'doughnut',
                data: {
                    labels: ["Pisici", "Câini", "Rozătoare", "Păsări", "Reptile", "Acvatice"],
                    datasets: [{
                        data: [json_data['1'].nr_registered, json_data['2'].nr_registered, json_data['3'].nr_registered, json_data['4'].nr_registered, json_data['5'].nr_registered, json_data['6'].nr_registered],
                        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#800080"],
                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774", "#800080"]
                    }]
                },
                options: {
                    responsive: true
                }
            });
            var ctxD = document.getElementById("donutChart2").getContext('2d');
            var myLineChart = new Chart(ctxD, {
                type: 'doughnut',
                data: {
                    labels: ["Pisici", "Câini", "Rozătoare", "Păsări", "Reptile", "Acvatice"],
                    datasets: [{
                        data: [json_data['1'].nr_saved, json_data['2'].nr_saved, json_data['3'].nr_saved, json_data['4'].nr_saved, json_data['5'].nr_saved, json_data['6'].nr_saved],
                        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#800080"],
                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774", "#800080"]
                    }]
                },
                options: {
                    responsive: true
                }
            });
        } else { console.log("Eroaare server") }
    })
}

function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) { return pair[1]; }
    }
    return (false);
}
var pid = getQueryVariable('PID')

// functie pentru trimiterea cererii de resetare a parolei

function resetpass() {

    var email = document.getElementById("resetpass").value;

    $.post('server/resetpassword.php', { user_email: email }, function(data, status) {
        var json_data = JSON.parse(data)

        if (json_data.status == 1) {
            if (json_data.email_sent == 1) {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Succes!',
                    subtitle: '',
                    body: 'Instructiunile pentru resetarea parolei au fost trimise la adresa de email introdusa!'
                });
            } else if (json_data.registered_email == 0) {
                $(document).Toasts('create', {
                    class: 'bg-warning',
                    title: 'Atentie!',
                    subtitle: '',
                    body: 'Adresa de email introdusa nu este asociata unui cont!'
                });
            }
        } else {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Eroare!',
                subtitle: '',
                body: 'A aparut o eroare, va rugam reincercati!'
            });
        }
    })
}

//Functie pt introducerea unei noi parole 

function recoverpass() {

    // var new_pass = document.getElementById("recoverpass").value

    $.post('server/newpassword.php', { code: getQueryVariable("code"), user_password: new_pass }, function(data, status) {
        var json_data = JSON.parse(data)
        if (json_data.status == 1) {
            if (json_data.password_reset == 1) {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Succes!',
                    subtitle: '',
                    body: 'Parola a fost schimbata, veti fi redirectionat catre pagina de login!'
                });
                setTimeout(function() { window.location.href = '/login.php'; }, 3000);
            } else if (json_data.correct_code == 0) {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Eroare!',
                    subtitle: '',
                    body: 'Acest link de resetare a expirat sau este incorect!'
                });
            }
        } else {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Eroare!',
                subtitle: '',
                body: 'A aparut o eroare, va rugam reincercati!'
            });
        }
    })


}

// Functie pentru afisarea detaliilor despre un animal 

function detalii() {

    $.post('server/getanimalextended.php', { PID: getQueryVariable("PID") }, function(data) {
        var json_data = JSON.parse(data)
        if (json_data.status == 1) {
            var type_animal = ["Toate", "Pisici", "Câini", "Rozătoare", "Reptile", "Păsări", "Acvatice"]
            const contin = `
            <form role="form" id="addanimal_form" novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="nav-icon fas fa-paw"></i> Informații</h3>
                                </div>
                                <div class="card-body">
                                    <strong><i class="nav-icon fas fa-paw"></i> Nume</strong>
                                    <p class="text-muted">
                                        <span class="tag tag-danger"> ${json_data.name}</span>
                                    </p>
                                    <hr>
                                    <strong><i class="nav-icon fas fa-paw"></i> Rasă</strong>
                                    <p class="text-muted">
                                        <span class="tag tag-danger"> ${json_data.breed}</span>
                                    </p>
                                    <hr>
                                    <strong><i class="nav-icon fas fa-paw"></i> Categorie</strong>
                                    <p class="text-muted">
                                        <span class="tag tag-danger"> ${type_animal[json_data.type]}</span>
                                    </p>
                                    <hr>
                                    <strong><i class="nav-icon fas fa-paw"></i> Vârstă</strong>
                                    <p class="text-muted">
                                        <span class="tag tag-danger"> ${json_data.birthdate}</span>
                                    </p>
                                    <hr>
                                    <strong><i class="nav-icon fas fa-paw"></i> Descriere</strong>
                                    <p class="text-muted">
                                        <span class="tag tag-danger"> ${json_data.description}</span>
                                    </p>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-4">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="nav-icon fas fa-paw"></i> Poză</h3>
                                </div>

                                <div class="card-body" style="text-align: center">
                                    <img class=" img-circle img-fluid" style="height:200 ; width: 200px"
                                                        src="${json_data.image}"
                                                    alt="User profile picture">
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
              
            `

            if (document.getElementById('continut_pagina') != null) {
                document.getElementById('continut_pagina').innerHTML += contin;
            } else {
                console.log('Nu s-a gasit detalii_animal.php')
            }
        }

    })

}

// functie pentru detaliile profilului 

function detalii_user() {

    var uid = getQueryVariable('UID')

    // pentru detaliile utilizatorului curent
    if (uid == false) {
        $.post('server/getuser.php', function(data) {
            var json_data = JSON.parse(data)
            if (json_data.status == 1) {
                var type_user = ["Utilizator", "Angajat"]
                const contin = `
            <div  class="centered card card-success card-outline" >
                    <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user.png" alt="User profile picture">
                      </div>
      
                      <h3 class="profile-username text-center">${json_data.first_name} ${json_data.last_name}</h3>
      
                      <p class="text-muted text-center">${type_user[json_data.user_type]}</p>
      
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Email</b> <a class="float-right">${json_data.user_email}</a>
                        </li>
                       `

                if (json_data.user_type == 0) {
                    caseta = contin + `<li class="list-group-item">
                        <b>Număr de animale adăugate</b> <a class="float-right">${json_data.nr_owned_pets}</a>
                    </li>
                </ul>
                     <a href="animalele_mele.php" class="btn btn-success btn-block"><b>Animalele mele</b></a>
                 </div>
                <!-- /.card-body -->
            </div>`
                } else
                if (json_data.user_type == 1) {
                    caseta = contin + `</ul>
                </div>
                <!-- /.card-body -->
              </div>`
                }

                if (document.getElementById('continut_pag') != null) {
                    document.getElementById('continut_pag').innerHTML += caseta;
                } else {
                    console.log('Nu s-a gasit detalii_user.php')
                }
            }
        })
    } else
    // pentru angajatul care vrea sa vada contul unui utilizator
    {
        $.post('server/getuser.php', { WantedUID: uid },

            function(data) {
                var json_data = JSON.parse(data)
                if (json_data.status == 1) {
                    var type_user = ["Utilizator", "Angajat"]
                    const contin = `
            <div  class="centered card card-success card-outline" >
                    <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user.png" alt="User profile picture">
                      </div>
      
                      <h3 class="profile-username text-center">${json_data.first_name} ${json_data.last_name}</h3>
      
                      <p class="text-muted text-center">${type_user[json_data.user_type]}</p>
      
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Email</b> <a class="float-right">${json_data.user_email}</a>
                        </li>
                       `

                    if (json_data.user_type == 0) {
                        caseta = contin + `<li class="list-group-item">
                        <b>Număr de animale adăugate</b> <a class="float-right">${json_data.nr_owned_pets}</a>
                    </li>
                </ul>
                 </div>
                <!-- /.card-body -->
            </div>`
                    } else
                    if (json_data.user_type == 1) {
                        caseta = contin + `</ul>
                </div>
                <!-- /.card-body -->
              </div>`
                    }

                    if (document.getElementById('continut_pag') != null) {
                        document.getElementById('continut_pag').innerHTML += caseta;
                    } else {
                        console.log('Nu s-a gasit detalii_user.php')
                    }
                }
            })

    }
}


//functie pentru editarea animalelor

function edit_animal() {

    var pid = getQueryVariable('PID')

    $.post('server/getanimalextended.php', { PID: pid }, function(data) {
        var json_data = JSON.parse(data)
        if (json_data.status == 1) {
            const formular = `
            <div class="row">
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fas fa-paw"></i> Adăugare animăluț</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName"> Nume animăluț</label>
                            <input type="text" id="inputNameEdit" name="animal_name" class="form-control" value="${json_data.name}">
                        </div>
                        <div class="form-group">
                            <label for="inputVarsta">Vârstă</label>
                            <input type="number" name="animal_age" class="form-control" id="inputVarstaEdit" value="${json_data.birthdate}">
                        </div>
                        <div class="form-group">
                            <label for="inputRasa">Rasă</label>
                            <input type="text" class="form-control" name="animal_breed" id="inputRasaEdit" value="${json_data.breed}" >
                        </div>
                        <div class="form-group">
                            <label for="inputDescription"> Descriere animăluț</label>
                            <textarea id="inputDescriptionEdit" name="animal_description" class="form-control" rows="4">${json_data.description}</textarea>
                        </div>
    
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fas fa-paw"></i> Poza</h3>
                    </div>
                    
                    <div class="card-body">
                        <div class="form-group" style="margin: 0">
                            <button type="button" class="btn btn-success" style="margin: 5px" onclick="document.getElementById('getFile').click()"><i class="nav-icon fas fa-paw"></i> Încarcă o imagine</button>
                            <input type='file' id="getFile" name="animal_image" style="visibility:hidden;" onchange="readURL(this);"/><br>
                            <div id="cropper_container" class="container">
                                <img id="blah_edit" style="display: none; width:100%" src="#" alt="Imagine încărcată" class="cropper-hidden"/>
                            </div>
                            <img id="img_veche" style="height:200 ; width: 200px" src="${json_data.image}"  alt="Imagine animal">
                        </div>
                    </div>
                    
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="index.php" class="btn btn-secondary"><i class="nav-icon fas fa-paw"></i> Anulare</a>
                    <button type="submit" value="Editare animăluț" class="btn btn-success float-right"><i class="nav-icon fas fa-paw"></i> Editare animăluț</button>
                </div>
            </div>`
            if (document.getElementById('continut_form') != null) {
                document.getElementById('continut_form').innerHTML += formular;
            } else {
                console.log('Nu s-a gasit edit_animal.php')
            }

        }
    })
}

var cropper;

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah_edit').attr('src', e.target.result);
            document.querySelector('#img_veche').style.display = "none";
            var image = document.querySelector('#blah_edit');
            //document.querySelector('#cropper_container').style.height = "500px";
            image.style.display = "initial";
            if (cropper) {
                cropper.destroy();
            }
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3
            });
        };
        reader.readAsDataURL(input.files[0]);

    }
}

// functie pentru trimiterea noilor date

function add_animal_edit() {

    var pid = getQueryVariable('PID')
        // console.log(categorie)
    var jform = new FormData();
    var canvas;
    if (cropper) {
        canvas = cropper.getCroppedCanvas({
            width: 128,
            height: 128,
        });
        jform.append('imgbase64', canvas.toDataURL());
    } else {
        canvas = document.getElementById("img_veche").src
        jform.append('imgbase64', canvas);
    }
    jform.append('PID', pid)
    jform.append('pet_name', document.getElementById('inputNameEdit').value);
    jform.append('pet_description', document.getElementById('inputDescriptionEdit').value);
    jform.append('pet_breed', document.getElementById('inputRasaEdit').value);
    jform.append('pet_age', document.getElementById('inputVarstaEdit').value);
    if (cropper) {
        cropper.destroy();
        cropper = null;
    }
    $.ajax({
        url: '/server/updateanimal.php',
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
                    body: 'Animalul dvs a fost editat cu succes.'
                });
            } else if (data['status'] == 0) {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Eroare',
                    subtitle: '',
                    body: 'Eroare la editarea animal!'
                })
            } else
            if (data['status'] == -1) {
                console.log("eroare server")
            }
        },
        error: function(jqXHR, status, error) {
            //TODO use adminlte notification
            alert('Eroare editarea animal!');
        }
    });
}



var validator = $('.edit_animal_form').validate({

    submitHandler: function(form) {
        add_animal_edit();
        // form.reset();
        window.location = '/detalii_animal.php?PID=' + getQueryVariable("PID");
        document.getElementById("blah_edit").style.display = "none";
        //document.querySelector('#cropper_container').style.height = "1";
    },
    rules: {
        animal_name: {
            maxlength: 10,
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
        // animal_image: {
        //     required: true
        // },
    },
    messages: {
        animal_name: {
            maxlength: "Numele poate sa aiba maxim 10 caractere",
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
        // animal_image: {
        //     required: "Campul este obligatoriu"
        // },
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