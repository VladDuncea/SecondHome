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