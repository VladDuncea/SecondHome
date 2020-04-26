function optiuni_animal(request_type, PID) {
    // console.log(PID)
    // console.log(request_type)
    $.post('http://secondhome.fragmentedpixel.com/server/animalrequest.php', { request_type: request_type, PID: PID }, function(data, status) {

        // console.log(`${status}`)
        if (`${status}` == 'success') {
            console.log("am ajuns aici")
            if (request_type == 1) {
                var elem1 = document.getElementById(`${PID}a`);
                document.getElementById(`${PID}c`).value = 'Asteapta cazarea'
                document.getElementById(`${PID}c`).innerHTML = '<i class="fas fa-paw"></i> Asteapta cazarea'
                document.getElementById(`${PID}c`).disabled = true;
                elem1.style = "display: none"
            } else
            if (request_type == 0) {
                var elem2 = document.getElementById(`${PID}c`);
                elem2.style = "display: none"
                var elem3 = document.getElementById(`${PID}a`)
                document.getElementById(`${PID}a`).disabled = true;
                elem3.value = 'Asteapta adoptia'
                elem3.innerHTML = '<i class="fas fa-paw"></i> Asteapta adoptia'

            }
        }
    })
}

function optiuni_angajat(value, RID) {
    console.log(RID)
    console.log(value)
    $.post('http://secondhome.fragmentedpixel.com/server/updaterequest.php', { value: value, RID: RID }, function(data, status) {
        var json_data = JSON.parse(data)

        if (json_data.status == 1) {
            if (value == 1) {
                var elem1 = document.getElementById(`${RID}radoptie`);
                document.getElementById(`${RID}aadoptie`).value = 'Cerere acceptata'
                document.getElementById(`${RID}aadoptie`).innerHTML = '<i class="fas fa-paw"></i> Cerere acceptata'
                document.getElementById(`${RID}aadoptie`).disabled = true;
                elem1.style = "display: none"
            } else
            if (value == -1) {
                var elem2 = document.getElementById(`${RID}aadoptie`);
                elem2.style = "display: none"
                var elem3 = document.getElementById(`${RID}radoptie`)

                elem3.value = 'Cerere adoptie refuzata'
                elem3.innerHTML = '<i class="fas fa-paw"></i> Cerere refuzata'
                document.getElementById(`${RID}radoptie`).disabled = true;
            }


        }
        if (json_data.status == 0) {
            console.log("greseala utilizator")
        }
        if (json_data.status == -1) {
            console.log("eroare server")
        }
        if (json_data.request_updated == 1)
            console.log("a fost actualizat")
        if (json_data.request_updated == 0)
            console.log("nu a fost actualizat")

    })
}