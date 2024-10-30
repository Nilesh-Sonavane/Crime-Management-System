<?php
include('php/database.php');
if(!isset($_SESSION['pid'])){
  header('Location:index.php');
}

  $police_id = $_SESSION['pid'];
  $sql = "SELECT * FROM police WHERE police_id=$police_id";
  $result =$conn->query($sql);
  $row = $result->fetch_assoc();
  $station_id = $row['station_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/dashbord.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

    <title>Police (Dashbord)</title>
    <style>
      .swal2-popup{
    font-size: 1.5rem !important;
  }
    </style>
</head>
<body onload="startSpinner()">
    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>

    <?php require './includes/sidebar.php'?>
    <div id="content-wrapper">
        <div class="container-fluid">
            
                <div class="row"> 
                    <div class="col-lg-3 col-md-6 col-sm-6 col-10" style="margin:auto">
                        <div class="card bg-shadow-skyblue border-0" style="width: 85%;">
                            <div class="card-body pr-0">
                                <div class="row">
                                    <div class="col-lg-5 col-5 text-start" style="height:100px;">
                                    <img src="./images/fir2.png" height="70px" weight="70px" alt="fir" style="color: white;padding: 10px;border-radius: 20%;background-color: rgba(0, 0, 0, 0.18);" class="backgroung-round">
                                    </div>
                                    <div class="col-lg-6 col-6 text-end">
                                        <h4 class="text-white fw-bold" style="font-size:20px">FIR</h4>
                                        <h3 class="text-white fw-bold" style="margin-top:20px">
                                            <?php
                                                $sql_mobile = "SELECT * FROM mobile_fir WHERE station_id=$station_id";
                                                $result_mobile =$conn->query($sql_mobile);
                                                $row_mobile_count = mysqli_num_rows($result_mobile);  

                                                $sql_vehical = "SELECT * FROM vehical_fir WHERE station_id=$station_id";
                                                $result_vehical =$conn->query($sql_vehical);
                                                $row_vehical_count = mysqli_num_rows($result_vehical);

                                                $row_count=$row_mobile_count+$row_vehical_count;

                                                echo $row_count; 
                                            ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-10" style="margin:auto">
                        <div class="card bg-shadow-blue border-0" style="width: 85%;">
                            <div class="card-body pr-0">
                                <div class="row">
                                    <div class="col-lg-5 col-5 text-start" style="height:100px;">
                                        <img src="./images/wanted.png" height="70px" weight="70px" alt="Criminal" style="color: white;padding: 10px;border-radius: 20%;background-color: rgba(0, 0, 0, 0.18);" class="backgroung-round">
                                    </div>
                                    <div class="col-lg-6 col-6 text-end">
                                        <h4 class="text-white fw-bold" style="font-size:20px">Criminal</h4>
                                        <h3 class="text-white fw-bold" style="margin-top:20px">
                                            <?php
                                                    $sql = "SELECT * FROM wanted_person WHERE police_id=$police_id";
                                                    $result =$conn->query($sql);
                                                    $row_count = mysqli_num_rows($result);  
                                                    echo $row_count;  
                                            ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-10" style="margin:auto">
                        <div class="card bg-shadow-green border-0" style="width: 85%;">
                            <div class="card-body pr-0">
                                <div class="row">
                                    <div class="col-lg-5 col-5 text-start" style="height:100px;">
                                    <img src="./images/police-handcuffs.png" height="70px" weight="70px" alt="police-station" style="color: white;padding: 10px;border-radius: 20%;background-color: rgba(0, 0, 0, 0.18);" class="backgroung-round">
                                    </div>
                                    <div class="col-lg-6 col-6 text-end">
                                        <h4 class="text-white fw-bold" style="font-size:20px">Arrested</h4>
                                        <h3 class="text-white fw-bold" style="margin-top:20px">
                                            <?php
                                                $sql = "SELECT * FROM arrested_person WHERE police_id=$police_id";
                                                $result =$conn->query($sql);
                                                $row_count = mysqli_num_rows($result);  
                                                echo $row_count; 
                                            ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div id="chart_div" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        function startSpinner(){
            $(".loader").css("display", "none");
        }  
        $(window).resize(function(){
            drawChart();
        });
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = new google.visualization.arrayToDataTable(<?php include('./php/ArrestedChartdata.php'); ?>);
            
            var options = {
                title: 'Daily Arrested Persons',
                curveType: 'function',
                legend: { position: 'bottom' }
            };
            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
        
    </script>
</body>
</html>