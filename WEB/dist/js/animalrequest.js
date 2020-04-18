function optiuni_animal(request_type, PID) {
    console.log(PID)
    console.log(request_type)
    $.post('http://secondhome.fragmentedpixel.com/server/animalrequest.php', { request_type: request_type, PID: PID }, function(data, status) {

        console.log(`${status}`)
        if (`${status}` == 'success') {
            console.log("am ajuns aici")
            if (request_type == 1) {
                var elem1 = document.getElementById(`${PID}a`);
                document.getElementById(`${PID}c`).value = 'Asteapta cazarea'
                document.getElementById(`${PID}c`).innerHTML = '<i class="fas fa-paw"></i> Asteapta cazarea'
                elem1.style = "display: none"
            } else
            if (request_type == 0) {
                var elem2 = document.getElementById(`${PID}c`);
                elem2.style = "display: none"
                var elem3 = document.getElementById(`${PID}a`)

                elem3.value = 'Asteapta adoptia'
                elem3.innerHTML = '<i class="fas fa-paw"></i> Asteapta adoptia'
                console.log(elem3.value)

            }
        }
    })
}