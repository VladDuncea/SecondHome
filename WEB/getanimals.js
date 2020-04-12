function get_animal(request_type, pet_type) {

    $.post('http://secondhome.fragmentedpixel.com/server/getanimals.php', { request_type: request_type, pet_type: pet_type }, function(data, status) {
        if (status == 1)
            console.log(typeof data)
        var json_data = JSON.parse(data)
        nr_animals = json_data.nr_animals
        animals = json_data.animals
            // console.log(json_data)
        var type_animal = ["Toate", "Pisici", "Câini", "Rozătoare", "Reptile", "Păsări", "Acvatice"]

        for (var i = 0; i < nr_animals; i++) {
            const animal_box = `
         <div class="d-flex">
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
                            <img height="350" width="320" src='${animals[i].image}' alt="" class="img-circle img-fluid">
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
            </div>
        </div>`;
            // console.log(document.getElementById('boxAnimals'));

            if (document.getElementById('boxAnimals') != null) {
                document.getElementById('boxAnimals').innerHTML += animal_box;
            } else {
                console.log('Nu s-a gasit animale.php')
            }

        }


    })
}