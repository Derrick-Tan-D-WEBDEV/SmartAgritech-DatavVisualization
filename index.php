<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/gh/alphardex/aqua.css/dist/aqua.min.css" rel="stylesheet"/>
    <link href="css/index.css" rel="stylesheet"/>
    <title>Plant Visualization</title>
  </head>
  <body>
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-white text-left"> 
                    <img class="img-fluid" src="img/plant.svg" alt="plant" width="50" style="padding-bottom:10px"> Smart Farming Agritech 
                    <canvas id="digital-clock" class="text-right" width="150" height="35"></canvas>
                </h1>
            </div>  
            <div class="col-3">
                <h5 class="text-white">Tempeature</h5>
                <canvas id="temp" class="p-3" width="100" height="150"></canvas>
            </div>
            <div class="col-3">
                <h5 class="text-white">Humidity</h5>
                <canvas id="humi" class="p-2" width="100" height="150"></canvas>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-6">
                        <h5 class="text-white">Fan</h5>
                        <canvas id="fan" width="100" height="70"></canvas>
                        <br>
                        <h5 class="text-white">Soil Moisture</h5>
                        <div id="gauge-test" class="gauge gauge-danger" style="--gauge-value:400;--gauge-max-value:5000;"></div>
                    </div>
                    <div class="col-6">
                        <h5 class="text-white">Water Level</h5>
                        <canvas id="bar-meter" class="p-4" width="100" height="120"></canvas>
                    </div>

                </div>

            </div>
            <div class="col-12">
                <div class="chart">
                    <canvas id="myChart" style="position: relative; height:14vh; width:40vw"></canvas>
                </div>
            </div>
        </div>
 

    </div>

    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/zeu"></script>
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@latest/dist/chartjs-plugin-streaming.min.js"></script>
    


    <script>

        /* Digital Clock Options */
        var options_digitalClock = {
            // Digital number color.
            numberColor: 'White',
            // Background dash color.
            dashColor: '#00000000',
            // Hour offset.
            hourOffset: 0
        };

        /* Digital Clock Constructor */
        var digitalClock = new zeu.DigitalClock('digital-clock', options_digitalClock);

        /* Options */
        var options_temp = {
            // Minimum value at the bottom
            min: {
                // Font color.
                fontColor: 'black',
                // Number value.
                value: 0,
                // Background color.
                bgColor: '#fff'
            },
            // Maximum value at the top.
            max: {
                // Font color.
                fontColor: 'black',
                // Number value.
                value: 40,
                // Background color.
                bgColor: '#fff'
            },
            // Bar,
            bar: {
                // Border color.
                borderColor: '#fff',
                // Bar fill color.
                fillColor: '#fff',
                // Bar color gradient or not.
                graident: false,
                // Scrolling speed.
                speed: 2
            },
            // Marker,
            marker: {
                // Background color.
                bgColor: '#28a748',
                // Font color.
                fontColor: '#ffffff'
            },
            // Actual number value.
            value: 0
        }
        /* Constructor */
        var temp = new zeu.VolumeMeter('temp', options_temp);

        /* Temp Setter */
        //okay = #00FF00
        //not okay = #DC143C


        /* Options */
        var options_humi = {
            // Minimum value at the bottom
            min: {
                // Font color.
                fontColor: 'black',
                // Number value.
                value: 0,
                // Background color.
                bgColor: '#fff'
            },
            // Maximum value at the top.
            max: {
                // Font color.
                fontColor: 'black',
                // Number value.
                value: 100,
                // Background color.
                bgColor: '#fff'
            },
            // Bar,
            bar: {
                // Border color.
                borderColor: '#fff',
                // Bar fill color.
                fillColor: '#fff',
                // Bar color gradient or not.
                graident: false,
                // Scrolling speed.
                speed: 2
            },
            // Marker,
            marker: {
                // Background color.
                bgColor: '#28a748',
                // Font color.
                fontColor: '#ffffff'
            },
            // Actual number value.
            value: 0
        }
        /* Constructor */
        var humi = new zeu.VolumeMeter('humi', options_humi);

        /* Temp Setter */
        //okay = #00FF00
        //not okay = #DC143C


        /* Options */
        var options_fan = {
        // Fan color.
        fanColor: '#00d7af',
        center: {
            // The center circle color.
            color: '#00d7af',
            // The center circle 2 color.
            bgColor: '#FFFFFF'
        },
        // Fan speed. The larger, the faster.
        speed: 1
        }
        
        /* Constructor */
        var fan = new zeu.RoundFan('fan', options_fan);

        /* Setter */
        fan.speed = 2;
        fan.fanColor = '#00d7af';
        fan.centerColor = '#00d7af';
        fan.centerBgColor = '#FFFFFF';


        /* Options */
        var options = {
            // Minimum number.
            min: 0,
            // Maximum number.
            max: 3000,
            // Background dash color.
            dashColor: '#e5e5e5',
            // Bar color.
            barColor: '#007bfb',
            // Bar speed.
            speed: 5,
            // Bar color gradient or not.
            gradient: true
        };

        /* Constructor */
        var barMeter = new zeu.BarMeter('bar-meter', options);

        /* Setter */
        // barMeter.value = 0;
        // barMeter.dashColor = '#e5e5e5';
        // barMeter.barColor = '#007bfb';
        // barMeter.speed = 10;

    </script>
    <script>
        var temp_data = null;

		var chartColors = {
			red: 'rgb(255, 99, 132)',
			orange: 'rgb(255, 159, 64)',
			yellow: 'rgb(255, 205, 86)',
			green: 'rgb(75, 192, 192)',
			blue: 'rgb(54, 162, 235)',
			purple: 'rgb(153, 102, 255)',
			grey: 'rgb(201, 203, 207)'
		};

		function getting_data() {
            $.get("http://192.168.31.114/Plants/lettuce_1/API_DV/readOne_lettuce_temp_humi.php", function(data, status){
                temp_data = data;
            });
            return temp_data;
		}

		function onRefresh(chart) {

			chart.config.data.datasets.forEach(function(dataset) {
                getting_data(); 
                if(dataset.label == "Temperature"){
                    dataset.data.push({
                        x: Date.now(),
                        y: temp_data.temperature
                    });
                }else{
                    dataset.data.push({
                        x: Date.now(),
                        y: temp_data.humidity
                    });
                }

			});
		}

		var color = Chart.helpers.color;
		var config = {
			type: 'line',
			data: {
				datasets: [{
					label: 'Temperature',
					backgroundColor: '#73fc03',
					borderColor: '#73fc03',
					fill: false,
					lineTension: 0,
					borderDash: [8, 4],
					data: []
				}, {
					label: 'Humidity',
					backgroundColor: '#fcba03',
					borderColor: '#fcba03',
					fill: false,
					cubicInterpolationMode: 'monotone',
					data: []
				}]
			},
			options: {
				title: {
					display: false
				},
				scales: {
					xAxes: [{
						type: 'realtime',
						realtime: {
							duration: 20000,
							refresh: 1000,
							delay: 2000,
							onRefresh: onRefresh
						},
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 100
                        },
                        gridLines: { 
                            color: "transparent" 
                        },
                        ticks: {
                            fontColor: "white",
                            fontSize: 14
                        }
					}],
					yAxes: [{
						scaleLabel: {
							display: false,
							labelString: 'value',
                            fontColor: '#ffffff',
						},
                        gridLines: { 
                            color: "transparent" 
                        },
                        ticks: {
                            fontColor: "white",
                            fontSize: 14
                        }
					}]
				},
				tooltips: {
					mode: 'nearest',
					intersect: false
				},
				hover: {
					mode: 'nearest',
					intersect: false
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('myChart').getContext('2d');
			window.myChart = new Chart(ctx, config);
		};


	</script>

    <script>
        $( document ).ready(function() {
            setInterval(function(){ 
                $.get("http://192.168.31.114/Plants/lettuce_1/API_DV/readOne_lettuce_wlvl_sm.php", function(data, status){
                    var test = $("#gauge-test").css("--gauge-value");
                    $("#gauge-test").css("--gauge-value", data.soil_moisture);
                    barMeter.value = data.water_tank_level;

                    if(data.soil_moisture >= 500){
                        $( "#gauge-test" ).removeClass( "gauge-danger gauge-success" );
                        $( "#gauge-test" ).addClass( "gauge-success" );
                    }

                    if(data.soil_moisture <= 500 || data.soil_moisture >= 3500){
                        $( "#gauge-test" ).removeClass( "gauge-danger gauge-success" );
                        $( "#gauge-test" ).addClass( "gauge-danger" );
                    }
                });
            }, 1000);

            setInterval(function(){ 
                $.get("http://192.168.31.114/Plants/lettuce_1/API_DV/readOne_lettuce_temp_humi.php", function(data, status){
                    temp.value = data.temperature;
                    temp.barFillColor = '#DC143C';
                    temp.markerBgColor = '#DC143C';

                    if(humi.value <= 50){
                        humi.value = data.humidity;
                        humi.barFillColor = '#DC143C';
                        humi.markerBgColor = '#DC143C';
                    }
                    else{
                        humi.value = data.humidity;
                        humi.barFillColor = '#00FF00';
                        humi.markerBgColor = '#00FF00';                        
                    }

                    if(temp.value <= 24 && temp.value >= 28){
                        temp.value = data.temperature;
                        temp.barFillColor = '#DC143C';
                        temp.markerBgColor = '#DC143C';
                    }
                    else{
                        temp.value = data.temperature;
                        temp.barFillColor = '#00FF00';
                        temp.markerBgColor = '#00FF00';                        
                    }

                    // if(data.soil_moisture >= 500){
                    //     $( "#gauge-test" ).removeClass( "gauge-danger gauge-success" );
                    //     $( "#gauge-test" ).addClass( "gauge-success" );
                    // }

                    // if(data.soil_moisture <= 500 || data.soil_moisture >= 3500){
                    //     $( "#gauge-test" ).removeClass( "gauge-danger gauge-success" );
                    //     $( "#gauge-test" ).addClass( "gauge-danger" );
                    // }
                });
            }, 1000);

        });
    </script>
  </body>
</html>