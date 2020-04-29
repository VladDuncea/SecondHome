//doughnut
function homepage() {
    var ctxD = document.getElementById("donutChart1").getContext('2d');
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["Pisici", "Caini", "Rozatoare", "Pasari", "Reptile", "Acvatice"],
            datasets: [{
                data: [300, 50, 100, 40, 120, 50],
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
            labels: ["Pisici", "Caini", "Rozatoare", "Pasari", "Reptile", "Acvatice"],
            datasets: [{
                data: [1, 1, 1, 0, 1, 0],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#800080"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774", "#800080"]
            }]
        },
        options: {
            responsive: true
        }
    });
}

function resetpass() {

    var email = document.getElementById("resetpass").value;
    
    $.post('server/resetpassword.php', { user_email: email }, function(data, status) {
        var json_data = JSON.parse(data)
        
        if(json_data.status == 1)
        {
            if (json_data.email_sent == 1)
            {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Succes!',
                    subtitle: '',
                    body: 'Instructiunile pentru resetarea parolei au fost trimise la adresa de email introdusa!'
                });
            }
            else if(json_data.registered_email == 0)
            {
                $(document).Toasts('create', {
                    class: 'bg-warning',
                    title: 'Atentie!',
                    subtitle: '',
                    body: 'Adresa de email introdusa nu este asociata unui cont!'
                });
            }
        }
        else
        {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Eroare!',
                subtitle: '',
                body: 'A aparut o eroare, va rugam reincercati!'
            });
        }
    })
}

function recoverpass() {

    var new_pass = document.getElementById("recoverpass").value

    function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) { return pair[1]; }
        }
        return (false);
    }

    $.post('server/newpassword.php', { code: getQueryVariable("code"), user_password: new_pass }, function(data, status) {
        var json_data = JSON.parse(data)
        if(json_data.status == 1)
        {
            if (json_data.password_reset == 1)
            {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Succes!',
                    subtitle: '',
                    body: 'Parola a fost schimbata, veti fi redirectionat catre pagina de login!'
                });
                setTimeout(function(){ window.location.href = '/login.php';}, 3000);
            }
            else if(json_data.correct_code == 0)
            {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Eroare!',
                    subtitle: '',
                    body: 'Acest link de resetare a expirat sau este incorect!'
                });
            }
        }
        else
        {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Eroare!',
                subtitle: '',
                body: 'A aparut o eroare, va rugam reincercati!'
            });
        }
    })


}