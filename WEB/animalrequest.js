function optiuni_animal(request_type, PID) {
    console.log(PID)
    console.log(request_type)
    $.post('http://secondhome.fragmentedpixel.com/server/animalrequest.php', { request_type: request_type, PID: PID }, function(data, status) {
        if (status == 1) {
            // if (request_type == 1) {
            //     var elem1 = document.getElementById(`${PID}c`);
            //     if (elem1.value == "Cazează") elem1.value = "Asteaptă cazarea";
            //     else elem1.value = "Cazează";
            // } else if (request_type == 0) {
            //     var elem2 = document.getElementById(`${PID}a`);
            //     if (elem2.value == "Dă spre adopție") elem2.value = "Asteaptă adopția";
            //     else elem2.value = "Dă spre adopție";
            // }
        } else {
            if (request_type == 1) {
                var elem1 = document.getElementById(`${PID}c`);
                if (elem1.value == "Cazează") {
                    elem1.value = "Asteaptă cazarea";
                    elem1.innerText = "Asteaptă cazarea";
                } else elem1.value = "Cazează";
            } else if (request_type == 0) {
                var elem2 = document.getElementById(`${PID}a`);
                if (elem2.value == "Dă spre adopție") {
                    elem2.value = "Asteaptă adopția";
                    elem2.innerHTML = "Asteaptă adopția";

                } else elem2.value = "Dă spre adopție";
            }
        }

    })
}