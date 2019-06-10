<!DOCTYPE html>
<html class="no-js"> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
            
    </script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

 
       
        <script src="package\dist\Chart.js"></script>
    </head>
    <body>
        <?php 

include("navbar.php")
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
            <h1 class="text-center">Products</h1>
        
        <canvas id="myChart"></canvas>
    </div>
    
    <div class="col-md-4">
        <h1 class="text-center">Zasoby</h1>
        <canvas id="myChart3"></canvas>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">Zasoby Energii</h1>
        <canvas id="myChart2"></canvas>
    </div>
    </div>
   
    </div>
<script>
// ($(document).ready(function(){
//     $.getJSON("biostrateg_modul_analityczny_out.json",function(data){
//         let labels = [];
//         $.each(data,function(index,value){
//             labels.push(value.numbers)
//         });
//         console.log(labels);
//     });
// }))

// window.onload = function(){
// var data=[];
// $.getJSON("biostrateg_modul_analityczny_out.json",function(datek){
//     var nazwy = []
//     var wartosci = []
//     for (var j=0;j<10;j++){
//         nazwy[j] = datek.energy_resources[j].name;
//         wartosci[j] = datek.energy_resources[j].amount;
//     }
//     for(var i in datek.energy_resources){
//         data.push({
//             name:nazwy[i],
//             ammount: wartosci[i]

//         });
//     }
    
// });
// };




var ctx = document.getElementById('myChart').getContext('2d');

var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
       
        labels: ["Mrożony groszek","Mrożony brokuł"],
        datasets: [{
            label: 'Products',
            
            data: [981100,231128],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<script>
        var ctx = document.getElementById('myChart2').getContext('2d');
        
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Węgiel kamienny energetyczny z wyłączeniem brykietów","benzyna silnikowa bezołowiowa","oleje napędowe do silników (Diesla)","gaz skroplony LPG","energia elektryczna","ciepło w parze wodnej i gorącej wodzie"],
                datasets: [{
                    label: 'Energy_resources',
                    data: [1234.2,3214.2,2314.2,2231.4, 3122.4,4212.3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        </script>

<script>
        var ctx = document.getElementById('myChart3').getContext('2d');
        
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Woda","Brokuł róża jesienny","Groszek"],
                datasets: [{
                    label: 'Products',
                    data: [255255,1093508,1011485],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        </script>
        


    </body>
</html>