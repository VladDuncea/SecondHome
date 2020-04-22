function get_animal(request_type_active, pet_type) {

    $.post('http://secondhome.fragmentedpixel.com/server/getanimals.php', { request_type: request_type_active, pet_type: pet_type }, function(data, status) {
        if (status == 1)
            console.log(typeof data)
        var json_data = JSON.parse(data)
        nr_animals = json_data.nr_animals
        animals = json_data.animals
            // console.log(json_data)
        var type_animal = ["Toate", "Pisici", "Câini", "Rozătoare", "Reptile", "Păsări", "Acvatice"]
        if (request_type_active == 0) {
            for (var i = 0; i < nr_animals; i++) {
                // col-sm-3
                const animal_box = `<div class="d-flex">
                <div class="card bg-light">
                    <div class="card-header text-muted border-bottom-0" >
                       ${type_animal[animals[i].type]}
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead" ><b>${animals[i].name}</b></h2>
                                <p class="text-muted text-sm" ><b>Vârstă: </b> ${animals[i].birthdate}</p>
                                <p class="text-muted text-sm" ><b>Rasă: </b> ${animals[i].breed} </p>
    
                            </div>
                            <div class="col-4 text-center">
                                <img  style="height:300 ; width: 300px" src='${animals[i].image}' alt="" class="img-circle img-fluid" >
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <a href="#" class="btn btn-sm btn-success">
                                <i class="fas fa-paw"id='detalii'></i> Mai multe detalii
                            </a>
                        </div>
                    </div>
                      </div> </div>`;
                // console.log(document.getElementById('boxAnimals'));

                if (document.getElementById('boxAnimals') != null) {
                    document.getElementById('boxAnimals').innerHTML += animal_box;
                } else {
                    console.log('Nu s-a gasit animale.php')
                }

            }
        } else if (request_type_active == 1) {

            for (var i = 0; i < nr_animals; i++) {
                const card = `<div class="d-flex">
                <div class="card bg-light">
                    <div class="card-header text-muted border-bottom-0" >
                       ${type_animal[animals[i].type]}
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead" ><b>${animals[i].name}</b></h2>
                                <p class="text-muted text-sm" ><b>Vârstă: </b> ${animals[i].birthdate}</p>
                                <p class="text-muted text-sm" ><b>Rasă: </b> ${animals[i].breed} </p>
    
                            </div>
                            <div class="col-4 text-center">
                                <img  style="height:300 ; width: 300px" src='${animals[i].image}' alt="" class="img-circle img-fluid" >
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <a href="#" class="btn btn-sm btn-success">
                                <i class="fas fa-paw"id='detalii'></i> Mai multe detalii
                            </a>
                        </div>
                    </div>`
                var buttonState1 = undefined,
                    buttonState2 = undefined,
                    buttonState = undefined;
                // console.log(`${animals[i].PID}`)
                // console.log(`${animals[i].has_request}`)
                // console.log(`${animals[i].request_type}`)
                // console.log(`${animals[i].request_state}`)

                // const buttonState;
                if (animals[i].has_request == 1) {
                    if (animals[i].request_type == 0) {
                        if (animals[i].request_state == 0) {
                            buttonState2 = '<i class="fas fa-paw"></i> Asteaptă adopția';
                        } else
                        if (animals[i].request_state == 1) {
                            buttonState2 = '<i class="fas fa-paw"></i> Adoptat';
                        } else
                        if (animals[i].request_state == -1) {
                            // TODO cerere respinsa
                            console.log("cerere respinsa")
                        }
                    } else
                    if (animals[i].request_type == 1) {
                        if (animals[i].request_state == 0) {
                            buttonState1 = '<i class="fas fa-paw"></i> Asteaptă cazarea';
                        } else
                        if (animals[i].request_state == 1) {
                            if (animals[i].request_state == 0) {
                                buttonState1 = '<i class="fas fa-paw"></i> Cazat';
                            }
                        } else
                        if (animals[i].request_state == -1) {
                            // TODO cerere respinsa
                            console.log("cerere respinsa")
                        }
                    } else
                    if (animals[i].request_type == 2) {
                        // TODO adoptia unui animal
                    }
                } else
                if (animals[i].has_request == 0) {
                    buttonState1 = '<i class="fas fa-paw"></i> Cazează'
                    buttonState2 = '<i class="fas fa-paw"></i> Da spre adoptie'
                }

                if (`${buttonState2}` != '<i class="fas fa-paw"></i> Da spre adoptie' && `${buttonState1}` != '<i class="fas fa-paw"></i> Cazează') {

                    if (buttonState1 == undefined)
                        buttonState = buttonState2
                    else
                    if (buttonState2 == undefined)
                        buttonState = buttonState1

                    const animal_box = card + `
                                            <div class="card-body" style="padding: 2">       
                                                <div class="text-center">
                                                <button type="button" class="btn btn-secondary" disabled>${buttonState}</button>       
                                                <button type="button" class="btn btn-secondary" id='${animals[i].PID}e' ><i class="fas fa-paw"id='detalii'></i> Editează</button> 
                                                </div> 
                                            </div>
                                            </div>
                                         </div>`;
                    // console.log(document.getElementById('boxAnimals'));

                    if (document.getElementById('boxAnimals') != null) {
                        document.getElementById('boxAnimals').innerHTML += animal_box;
                    } else {
                        console.log('Nu s-a gasit animale.php')
                    }

                } else if (`${buttonState2}` == '<i class="fas fa-paw"></i> Da spre adoptie' && `${buttonState1}` == '<i class="fas fa-paw"></i> Cazează') {
                    // --------------------------------------------------------------------------
                    const animal_box = card + `
                                    <div class="card-body" style="padding: 2">       
                                        <div class="text-center">
                                        <button type="button" class="btn btn-secondary" onclick="optiuni_animal(1,${animals[i].PID});" id='${animals[i].PID}c' value='Cazează'>${buttonState1}</button>       
                                        <button type="button" class="btn btn-secondary" onclick="optiuni_animal(0,${animals[i].PID});" id='${animals[i].PID}a'  value='Dă spre adopție'>${buttonState2}</button>
                                        <button type="button" class="btn btn-secondary" id='${animals[i].PID}e' ><i class="fas fa-paw"id='detalii'></i> Editează</button> 
                                        </div> 
                                    </div>
                                    </div>
                                </div>`;
                    // console.log(document.getElementById('boxAnimals'));

                    if (document.getElementById('boxAnimals') != null) {
                        document.getElementById('boxAnimals').innerHTML += animal_box;
                    } else {
                        console.log('Nu s-a gasit animale.php')
                    }

                }
                // console.log(`${buttonState2}`)
                // console.log(`${buttonState1}`)
                // console.log(`${buttonState2}`)
                // console.log("-----------------------")
            }
        }



    })
}