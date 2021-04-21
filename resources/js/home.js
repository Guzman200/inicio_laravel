//import Swal from "sweetalert2";
//import {  loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./helpers";


$(document).ready(() => {

    // Get context with jQuery - using jQuery's .get() method.
    var salesChartCanvas = $('#ordenesChart').get(0).getContext('2d')

    var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: true
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false
                }
            }],
            yAxes: [{
                gridLines: {
                    display: false
                }
            }]
        }
    }

    // peticion para obtener los datos de la grafica
    axios
        .get("ordenes_compra/anio-actual-datos-grafica")
        .then((res) => {

            console.log(res.data)

            var salesChartData = {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                datasets: [
        
                    {
                        label: 'Ordenes de compra',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: true,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: res.data
                    }
                ]
            }

            // This will get the first returned node in the jQuery collection.
            // eslint-disable-next-line no-unused-vars
            var salesChart = new Chart(salesChartCanvas, {
                type: 'line',
                data: salesChartData,
                options: salesChartOptions
            })
            
        })
        .catch(({ response }) => {
            console.log(response);
        });







});