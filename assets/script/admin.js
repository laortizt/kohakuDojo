// Client Recollection Chart JS
        if(document.getElementById("client-recollection-chart")){
            var options = {
                chart: {
                    height: 332,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '40%',
                        endingShape: 'rounded'	
                    },
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#3578e5', '#FF5B5C'],
                stroke: {
                    show: true,
                    width: 3,
                    colors: ['transparent']
                },
                series: [{
                    name: 'New Clients',
                    data: [44, 55, 57, 56, 65, 65, 70, 65, 60, 70, 75]
                }, {
                    name: 'Retained Clients',
                    data: [35, 41, 36, 26, 70, 68, 70, 60, 55, 65, 70]
                }],
                xaxis: {
                    categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return + val + " thousands"
                        }
                    }
                },
            }
            var chart = new ApexCharts(
                document.querySelector("#client-recollection-chart"),
                options
            );
            chart.render();
        }
