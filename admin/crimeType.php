<?php
include('php/database.php');
if(!isset($_SESSION['aid'])){
  header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin (Crime Type)</title>
    <link rel="stylesheet" href="./CSS/crimeType.css">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
    <link rel="stylesheet" href="./css/all.css">


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
        <h2 style="text-align:center;background:#aed3fb;color:rgb(5, 98, 167);padding:10px;border-radius:5px;margin:10px">CRIME TYPE</h2>
            <div class="container">
            
            <button id="addCrimeBtn" class="btn btn-success"> <i class="fa fa-plus-circle"></i> Add Crime</button>
            </div>
            <div class="container crime-box" id="crime-box" style="display:none">
                <form method="POST">
                    
                    <div class="mb-3">
                        <label for="crime-type" style="color:#7d7878" class="crime-type">Crime Type</label>
                        <input type="text" class="form-control" name="crime-type" id="crime-type">
                        <input type="text" name="crime-id" hidden id="crime-id">
                    </div>
                    <div style="margin-top:30px;">
                        <button id="btn-add" type="submit" style="display:visible" onclick=submitCrime(event) class="btn btn-primary">Add</button>
                        <button id="btn-update" style="display:none" type="button" class="btn btn-success" onclick="updateCrime(event)">Update</button> 
                        <button id="btn-hide" type="button" class="btn btn-danger">Cancle</button>
                    </div>
                </form>
            </div>

            <div class="container crime-table">
                
            </div>

        </div>
    </div>



<script src="./JS/script.js"></script>
<script src="./DataTables/js/jquery.js"></script>
<script src="./js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    function startSpinner(){
            $(".loader").css("display", "none");
        } 
     $(document).ready(function(){
        loadCrimeTable();
        $("#addCrimeBtn").click(function(){
            $("#crime-box").show();
            $("#btn-add").show();
            $("#btn-update").hide();
            $("#crime-type").val("");

        });
        $("#btn-hide").click(function(){
            $("#crime-box").hide();
        });
 
     });

    function loadCrimeTable(){
        $.ajax({  
            url: "php/crimeTable.php",
            type: "GET",  
            dataType:"html",  
            success:function(response){ 
                $(".crime-table").html(response);
            }  
        });
    }

    function getCrimeInfo(id){
        $("#crime-box").show();
        $("#btn-add").hide();
        $("#btn-update").show();
        
       
        $.ajax({  
            url: "php/crud.php?getCrime_id="+id,
            type: "GET",  
            dataType:"json",  
            success:function(data){ 
                $('#crime-id').val(data['crime_id'])
                $("#crime-type").val(data['crime_name']);
            }  
        });
    }

    function submitCrime(e){
        
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-center',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        e.preventDefault();
        
        // var crimeData = document.getElementById("crime-type").value
        var crimeData = ($("#crime-type").val().trim()).replace(/ {2,}/g,' ');

        if(crimeData!=""){
            var pattern = /^[a-zA-Z ]*$/;
            // var frm = document.getElementById("crimeForm");

            if(!crimeData.match(pattern)){
                Swal.fire({
                    icon: "error",
                    title: "Error In Crime Type",
                    text: "Invalid  Pattern, Please Enter Only Alphabet Letters "
                });

            }else{
                $(".loader").show();
                $.ajax({
                    url: "./php/crud.php",
                    type: "post",
                    data: {
                        crimeValue:crimeData    
                    },
                    success: function(response) {
                        $(".loader").hide();
                        if(response==0){
                            Swal.fire({
                                icon: "error",
                                title: "Error In Crime Type",
                                text: "Crime Type Is Alredy Exiest."
                            });
                            console.log(response);
                        }
                        else if(response == 1){
                            Swal.fire({
                            icon: "success",
                            title: "Add Crime Successfully"
                            }).then((result) => {
                                location.reload();
                            })
                        }else{
                            console.log(response);
                        }
                    }
                });    
            }

        }else{
            Toast.fire({
                icon: 'error',
                title: 'Crime Type Is Empty'
            })   
        }
   
    }

    function updateCrime(e){

        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-center',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        e.preventDefault();

        // var crime_id = document.getElementById("crime-id").value
        // var crime_type = document.getElementById("crime-type").value

        var crime_id = $("#crime-id").val().trim();
        var crime_type = ($("#crime-type").val().trim()).replace(/ {2,}/g,' ');

        if(crime_type!=""){
            
            // var pattern = /^[a-zA-Z]+ [a-zA-Z]+$/;
            var pattern =  /^[a-zA-Z ]*$/;

            if(!crime_type.match(pattern)){
                Swal.fire({
                    icon: "error",
                    title: "Error In Crime Type",
                    text: "Invalid  Pattern, Please Enter Only Alphabet Letters "
                });

            }else{
                $(".loader").show();
                $.ajax({
                    url: "./php/crud.php?updateCrimeId="+crime_id,
                    type: "GET",
                    data: {
                        crimeId:crime_id,
                        crimeName:crime_type
                    },
                    success: function(response) {
                        $(".loader").hide();
                        if(response==0){
                            Swal.fire({
                                icon: "error",
                                title: "Error In Crime Type",
                                text: "Crime Type Is Alredy Exiest."
                            });
                            console.log(response);
                        }
                        else if(response == 1){
                            Swal.fire({
                            icon: "success",
                            title: "Update Crime Successfully"
                            }).then((result) => {
                                location.reload();
                            })
                        }else{
                            console.log(response);
                        }
                    }
                });    
            }

        }else{
            Toast.fire({
                icon: 'error',
                title: 'Crime Type Is Empty'
            })   
        }
   
    }

</script>
</body>

</html>