<?php
include('php/database.php');
if(!isset($_SESSION['pid'])){
  header('Location:index.php');
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/dashbord.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/all.css">
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
    <title>Police (FIR)</title>
    <style>
      .swal2-popup{
    font-size: 1.5rem !important;
  }
  .view>a>i{
        color:#00ff70;
        cursor:pointer;
        font-size:22px;
    }
    .view{
        text-align:center;
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
        <h2 style="text-align:center;background:#aed3fb;color:rgb(5, 98, 167);padding:10px;border-radius:5px;margin:10px 20px 50px 20px">FIR</h2>
            <div class="container">
                <div class="fir_table">

                </div>
            </div>
        </div>
    </div>

    <script src="./JS/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        function startSpinner(){
            $(".loader").css("display", "none");
        } 
        // $(document).ready(function(){
            loadFirTable();
        // });
        function loadFirTable(){
            $.ajax({  
                url: "php/firTable.php",
                type: "GET",  
                dataType:"html",  
                success:function(response){ 
                    $(".fir_table").html(response);
                }  
            });
        }
    </script>
</body>
</html>