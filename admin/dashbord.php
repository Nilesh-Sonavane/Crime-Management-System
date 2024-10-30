<?php
include('php/database.php');
if(!isset($_SESSION['aid'])){
  header('Location:index.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin (Dashbord)</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/dashbord.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
    <link rel="stylesheet" href="./css/all.css">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <?php include 'font.php'?>

</head>
<body onload="startSpinner()">
    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>

    <?php require 'sidebar.php'?>

    <div id="content-wrapper">

        <div class="container-fluid">
            
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-10" style="margin:auto">
                        <div class="card bg-shadow-skyblue border-0" style="width: 85%;">
                            <div class="card-body pr-0">
                                <div class="row">
                                    <div class="col-lg-5 col-5 text-start" style="height:100px;">
                                    <img src="./images/user.png" height="70px" weight="70px" alt="Users" style="color: white;padding: 15px;border-radius: 20%;background-color: rgba(0, 0, 0, 0.18);" class="backgroung-round">
                                    </div>
                                    <div class="col-lg-6 col-6 text-end">
                                        <h4 class="text-white fw-bold" style="font-size:20px">Users</h4>
                                        <h3 class="text-white fw-bold" style="margin-top:20px">
                                            <?php
                                                $sql = "SELECT * FROM user";
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
                        <div class="card bg-shadow-blue border-0" style="width: 85%;">
                            <div class="card-body pr-0">
                                <div class="row">
                                    <div class="col-lg-5 col-5 text-start" style="height:100px;">
                                        <img src="./images/policeman.png" height="70px" weight="70px" alt="policeman" style="color: white;padding: 10px;border-radius: 20%;background-color: rgba(0, 0, 0, 0.18);" class="backgroung-round">
                                    </div>
                                    <div class="col-lg-6 col-6 text-end">
                                        <h4 class="text-white fw-bold" style="font-size:20px">Polices</h4>
                                        <h3 class="text-white fw-bold" style="margin-top:20px">
                                            <?php
                                                    $sql = "SELECT * FROM police";
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
                                    <img src="./images/police-station.png" height="70px" weight="70px" alt="police-station" style="color: white;padding: 10px;border-radius: 20%;background-color: rgba(0, 0, 0, 0.18);" class="backgroung-round">
                                    </div>
                                    <div class="col-lg-6 col-6 text-end">
                                        <h4 class="text-white fw-bold" style="font-size:20px">Police Stations</h4>
                                        <h3 class="text-white fw-bold" style="margin-top:20px">
                                            <?php
                                                $sql = "SELECT * FROM police_station";
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
                        <div class="card bg-shadow-orenge border-0" style="width: 85%;">
                            <div class="card-body pr-0">
                                <div class="row">
                                    <div class="col-lg-5 col-5 text-start" style="height:100px;">
                                    <img src="./images/fir2.png" height="70px" weight="70px" alt="fir" style="color: white;padding: 10px;border-radius: 20%;background-color: rgba(0, 0, 0, 0.18);" class="backgroung-round">
                                    </div>
                                    <div class="col-lg-6 col-6 text-end">
                                        <h4 class="text-white fw-bold" style="font-size:20px">FIR</h4>
                                        <h3 class="text-white fw-bold" style="margin-top:20px">
                                            <?php
                                                $sql = "SELECT * FROM fir";
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
                
                <div class="row">
                    <div class="col-sm-6">
                        <div id="chart_div" style="width: 100%; height: 400px;"></div>
                    </div>
                    <div class="col-sm-6">
                            <div id="chart_div2" style="width: 100%; height: 400px;"></div>
    
                        </div>
                </div>
        </div>
    </div>
    
    <script src="./JS/script.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">

        function startSpinner(){
            $(".loader").css("display", "none");
        } 
        $(window).resize(function(){
            drawChart();
            drawChart2();
        });

        google.charts.load('current', {'packages':['corechart']});
        
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = new google.visualization.arrayToDataTable(<?php include('./php/firData.php'); ?>);
            
            var options = {
                title: 'Daily FIR Reports',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawChart2);
        function drawChart2() {
            var data = new google.visualization.arrayToDataTable(<?php include('./php/ArrestedChartdata.php'); ?>);
            
            var options = {
                title: 'Daily Arrested Persons',
                curveType: 'function',
                colors: ['#e769eb'],
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div2'));

            chart.draw(data, options);
        }


    </script>
</body>
</html>