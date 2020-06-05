// functie pt generarea casetelor animalelor
function get_animal(request_type_active, pet_type) {

    $.post('server/getanimals.php', { request_type: request_type_active, pet_type: pet_type }, function(data, status) {

        var json_data = JSON.parse(data)
        if (json_data.status == 1) {
            // console.log(typeof data)
            var json_data = JSON.parse(data)
            nr_animals = json_data.nr_animals
            animals = json_data.animals
                // console.log(json_data)
            var type_animal = ["Toate", "Pisici", "Câini", "Rozătoare", "Reptile", "Păsări", "Acvatice"]
            for (var i = 0; i < nr_animals; i++) {
                // col-sm-3
                const card = `<div class="d-flex col-sm-3" id = '${animals[i].PID}'>
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
                <a href="/detalii_animal.php?PID=${animals[i].PID}" class="btn btn-sm btn-success">
                            <i class="fas fa-paw"id='detalii'></i> Mai multe detalii
                            
                        </a>
                   `;
                if (request_type_active == 0) {

                    if (json_data.hasAccount == 1) {
                        if (animals[i].has_request == 0) {
                            const animal_box = card + ` 
                        <button type="button" class="btn btn-sm btn-secondary" onclick="optiuni_animal(2,${animals[i].PID});" id='${animals[i].PID}adopta'> <i class="fas fa-paw"id='detalii'></i> Adopta</button>
                        </div>
                    </div> </div>
                            </div>`;


                            if (request_type_active == 0) {
                                if (document.getElementById('boxAnimals') != null) {
                                    document.getElementById('boxAnimals').innerHTML += animal_box;
                                } else {
                                    console.log('Nu s-a gasit animale.php')
                                }
                            }
                        } else
                        if (animals[i].has_request == 1) {
                            const animal_box = card + ` 
                        <button type="button" class="btn btn-sm btn-secondary" id='${animals[i].PID}adopta'> <i class="fas fa-paw"id='detalii'></i> Adopta</button>
                        </div>
                    </div> </div>
                            </div>`;

                            if (request_type_active == 0) {

                                if (document.getElementById('boxAnimals') != null) {
                                    document.getElementById('boxAnimals').innerHTML += animal_box;
                                    document.getElementById(`${animals[i].PID}adopta`).disabled = true;
                                } else {
                                    console.log('Nu s-a gasit animale.php')
                                }
                            }
                        }
                    } else if (json_data.hasAccount == 0) {

                        const animal_box = card + `     
                        </div> </div>
                                </div>`;
                        if (request_type_active == 0) {

                            if (document.getElementById('boxAnimals') != null) {
                                document.getElementById('boxAnimals').innerHTML += animal_box;
                            } else {
                                console.log('Nu s-a gasit animale.php')
                            }
                        }
                    }
                } else if (request_type_active == 1) {

                    var buttonState1 = undefined,
                        buttonState2 = undefined,
                        buttonState = undefined;


                    // const buttonState;
                    if (animals[i].has_request == 1) {
                        if (animals[i].request_type == 0) {
                            if (animals[i].request_state == 0) {
                                buttonState2 = '<i class="fas fa-paw"></i> Asteaptă darea spre adopție';
                            } else
                            if (animals[i].request_state == 1) {
                                buttonState2 = '<i class="fas fa-paw"></i> Cerere dare spre adopție acceptată';
                            } else
                            if (animals[i].request_state == -1) {
                                // TODO cerere respinsa
                                // console.log("cerere respinsa")
                                buttonState1 = '<i class="fas fa-paw"></i> Cerere dare spre adopție respinsă';
                            }
                        } else
                        if (animals[i].request_type == 1) {
                            if (animals[i].request_state == 0) {
                                buttonState1 = '<i class="fas fa-paw"></i> Asteaptă cazarea';
                            } else
                            if (animals[i].request_state == 1) {
                                buttonState1 = '<i class="fas fa-paw"></i> Cerere cazare acceptată';
                            } else
                            if (animals[i].request_state == -1) {
                                // TODO cerere respinsa
                                // console.log("cerere respinsa")
                                buttonState1 = '<i class="fas fa-paw"></i> Cerere cazare respinsă';
                            }
                        } else
                        if (animals[i].request_type == 2) {
                            buttonState1 = '<i class="fas fa-paw"></i> Cerere cazare respinsă';
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
                        const animal_box = card + `  </div>
                        </div> 
                        <div class="card-body" style="padding: 2">       
                            <div class="text-center">
                            <button type="button" class="btn btn-sm btn-secondary" disabled>${buttonState}</button> 
                            <hr>     
                            <a href="/edit_animal.php?PID=${animals[i].PID}" class="btn btn-sm btn-success">
                            <i class="fas fa-paw"id='detalii'></i> Editează
                            </a>
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
                        const animal_box = card + `</div></div>
                                    <div class="card-body" style="padding: 2">       
                                        <div class="text-center">
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="optiuni_animal(1,${animals[i].PID});" id='${animals[i].PID}c' value='Cazează'>${buttonState1}</button> <hr>      
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="optiuni_animal(0,${animals[i].PID});" id='${animals[i].PID}a'  value='Dă spre adopție'>${buttonState2}</button><hr>
                                        <a href="/edit_animal.php?PID=${animals[i].PID}" class="btn btn-sm btn-success">
                                        <i class="fas fa-paw"id='detalii'></i> Editează
                                        </a> 
                                        <button type="button" class="btn btn-sm btn-danger" onclick="delete_animal(${animals[i].PID});" id='${animals[i].PID}a'  value='Șterge'><i class="fas fa-paw"></i> Sterge</button>
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
                } else if (request_type_active == 2 || request_type_active == 3 || request_type_active == 4) {

                    const animal_box = card + `</div></div>
                <div class="card-body" style="padding: 2">   
                <p class="lead" ><b>Utilizator: </b> <a href='/detalii_user.php?UID=${animals[i].UID}' >${animals[i].first_name} ${animals[i].last_name} </a></p>       
                    <div class="text-center">
                    <button type="button" class="btn btn-secondary" id='${animals[i].RID}aadoptie' onclick="optiuni_angajat(1,${animals[i].RID});"><i class="fas fa-paw"id='detalii'></i> Accepta</button>    
                    <button type="button" class="btn btn-secondary" id='${animals[i].RID}radoptie' onclick="optiuni_angajat(-1,${animals[i].RID});"><i class="fas fa-paw"id='detalii'></i> Refuza</button> 
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
                } else if (request_type_active == 5) {
                    if (animals[i].has_request == 1) {
                        if (animals[i].request_type == 2) {
                            if (animals[i].request_state == 0) {
                                buttonState = '<i class="fas fa-paw"></i> Asteaptă acceptarea adopție';
                            } else
                            if (animals[i].request_state == 1) {
                                buttonState = '<i class="fas fa-paw"></i> Cerere adoptie acceptată';
                            } else
                            if (animals[i].request_state == -1) {
                                buttonState = '<i class="fas fa-paw"></i> Cerere adopție respinsă';
                            }
                        }
                        const animal_box = card + `  </div>
                        </div> 
                        <div class="card-body" style="padding: 2">       
                            <div class="text-center">
                            <button type="button" class="btn btn-sm btn-secondary" disabled>${buttonState}</button> 


                        </div> 
                        </div>
                        </div>
                    </div>`;

                        if (document.getElementById('boxAnimals') != null) {
                            document.getElementById('boxAnimals').innerHTML += animal_box;
                        } else {
                            console.log('Nu s-a gasit animale.php')
                        }
                    }
                }

            }
        }
    })
}