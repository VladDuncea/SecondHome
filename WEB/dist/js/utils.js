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

    var email = document.getElementById("resetpass").value
        // console.log(email)
    $.post('http://secondhome.fragmentedpixel.com/server/resetpassword.php', { user_email: email }, function(data, status) {
        var json_data = JSON.parse(data)
        console.log(json_data.email_sent)
        if (json_data.email_sent == 1)
        // console.log("S-a trimis")
        {
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Succes!',
                subtitle: '',
                body: 'Adresa de email a fost trimisa!'
            });
            // location.replace("http://secondhome.fragmentedpixel.com/index.php")
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

    console.log("code  " + getQueryVariable("code"))
    console.log("parola  " + new_pass)
    $.post('http://secondhome.fragmentedpixel.com/server/newpassword.php', { code: getQueryVariable("code"), user_password: new_pass }, function(data, status) {
        var json_data = JSON.parse(data)
        console.log(json_data.email_sent)
        if (json_data.password_reset == 1)
        // console.log("S-a trimis")
        {
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Succes!',
                subtitle: '',
                body: 'Adresa de email a fost trimisa!'
            });

        }
    })


}