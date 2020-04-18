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