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
    <title>Admin (Police Station)</title>
    <link rel="stylesheet" href="./CSS/policeStation.css">
    <link rel="stylesheet" href="./CSS/style.css">
    
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />     
    <link rel="stylesheet" href="./css/all.css">
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">
    <?php include 'font.php'?>

    <!-- <script src="./DataTables/js/jquery.js"></script>
    <script src="./DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="./DataTables/media/css/jquery.dataTables.min.css">
<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
    })
</script> -->


</head>
<body onload="startSpinner()">

    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>

    <?php require 'sidebar.php'?>
    
    <div id="content-wrapper">
        <div class="container-fluid">
        <h2 style="text-align:center;background:#aed3fb;color:rgb(5, 98, 167);padding:10px;border-radius:5px;margin:10px">POLICE STATION</h2>
            <div class="container">
            
            <button id="addStationBtn" class="btn btn-success"> <i class="fa fa-plus-circle"></i> Add Police Station</button>
            </div>
            <div class="container station_box" id="station_box" style="display:none">
            <form method="POST">
                    
                    <div class="mb-3">
                        <label for="station-name" style="color:#7d7878" class="station_name">Station Name</label>
                        <input type="text" class="form-control" name="station_name" id="station_name">
                    </div>
                    <div class="mb-3">
                        <label for="address" style="color:#7d7878" class="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="country" style="color:#7d7878"  class="country">Country</label>
                                <select class="form-select" id="country" name="country">
                                    <option value="-1" selected>--Select--</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="state" style="color:#7d7878" class="state">State</label>
                                <select class="form-select"  id="state"  name="STATE">
                                    <option value="-1" selected>--Select--</option>
                                    
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="city" style="color:#7d7878"  class="city">City</label>
                                <select class="form-select" id="city" name="city">
                                    <option value="-1" selected>--Select--</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="contact" style="color:#7d7878" class="contact">Contact No</label>
                        <input type="text" class="form-control" name="contact" id="contact">
                    </div>
                    <div style="margin-top:30px;">
                        <button id="btn-add" type="submit" style="display:visible;" class="btn btn-primary" onclick="addPoliceStation(event)">Add</button> 
                        <button id="btn-hide" type="button" class="btn btn-danger">Cancle</button>
                    </div>
                </form>
            </div>

            <div class="container station_table">
            
            </div>
            
            
        </div>

    </div>
</div>

<!-- update police station start  -->

<div id="modal">
    <div id="modal-form">
        <h2>Update Station</h2>
        <form method="POST">
                    
            <input type="text" class="form-control" name="update-station_id" id="update-station_id" style="display:none">
                    <div class="mb-3">
                        <label for="update-station_name" style="color:#7d7878" class="station_name">Station Name</label>
                        <input type="text" class="form-control" name="update-station_name" id="update-station_name" require>
                    </div>
                    <div class="mb-3">
                        <label for="update-address" style="color:#7d7878" class="address">Address</label>
                        <input type="text" class="form-control" name="update-address" id="update-address" require>
                    </div>
                    <!-- <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="update-country" style="color:#7d7878"  class="country">Country</label>
                                <select class="form-select" id="update-country" name="update-country">
                                    <option value="-1" selected>--Select--</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="update-state" style="color:#7d7878" class="state">State</label>
                                <select class="form-select"  id="update-state"  name="update-state">
                                    <option value="-1" selected>--Select--</option>
                                    
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="update-city" style="color:#7d7878"  class="city">City</label>
                                <select class="form-select" id="update-city" name="update-city">
                                    <option value="-1" selected>--Select--</option>
                                </select>
                            </div>
                        </div>
                    </div> -->
                    
                    <div class="mb-3">
                        <label for="update-contact" style="color:#7d7878" class="contact">Contact No</label>
                        <input type="text" class="form-control" name="update-contact" id="update-contact" require>
                    </div>
                    <div style="margin-top:30px;">
                        
                       <small class="note" style="color:red;">* Country, State or City cannot be changed. If you have reason to change then delete the record and add it again.</small>
                    </div>
                    <div style="margin-top:30px;">
                        
                        <button id="btn-update"  type="button" onclick="updatePoliceStation(event)" class="btn btn-success" >Update</button> 
                        <button id="btn-hide" type="button" class="btn btn-danger" style="float:right">Cancle</button>
                    </div>
                    
                </form>
    </div>
     
</div>

<!-- update police station end  -->


<script src="./JS/script.js"></script>
<!-- <script src="./JS/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<script>
    function startSpinner(){
        $(".loader").css("display", "none");
    } 

     $(document).ready(function(){
        loadStationTable();
        $("#addStationBtn").click(function(){
            $("#station_box").show();
            $("#btn-add").show();
        });
        $("#btn-hide").click(function(){
            $("#station_box").hide();
        });
        function loadData(type,location_id){
            $.ajax({
                url:"./php/load_location.php",
                type:"POST",
                data:{type:type,id:location_id},
                success: function(data){
                    if(type=="stateData"){
                        $("#state").html(data);
                    }
                    else if(type=="cityData"){
                        $("#city").html(data);
                    }else{
                        $("#country").append(data);
                    }
                }

            });
        }  
        $("#country").on("change",function(){
            var country = $("#country").val();
            loadData("stateData",country);
            
        }); 
        $("#state").on("change",function(){
            var state = $("#state").val();
            loadData("cityData",state);
        });
        $(document).on("click",".fa-edit",function(){
            
            $("#modal").show();
        
        });
        $(document).on("click","#btn-hide",function(){
            $("#modal").hide();
        });
        loadData();


    });
        function getStationInfo(id){
            $.ajax({  
            url: "php/crud.php?getStation_id="+id,
            type: "GET",  
            dataType:"json",  
            success:function(data){ 
                $('#update-station_id').val(data['station_id']);
                $('#update-station_name').val(data['station_name']);
                $('#update-address').val(data['address']);
                $('#update-contact').val(data['contact']);
            
                
            }  
        });
        }
        function loadStationTable(){
            $.ajax({  
                url: "php/stationTable.php",
                type: "GET",  
                dataType:"html",  
                success:function(response){ 
                    $(".station_table").html(response);
                }  
            });
        }
        
        function addPoliceStation(e){
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
     
            var station_name = ($("#station_name").val().trim()).replace(/ {2,}/g,' ');
            var address = ($("#address").val().trim()).replace(/ {2,}/g,' ');
            var country = $("#country").val().trim();
            var state = $("#state").val().trim();
            var city = $("#city").val().trim();
            var contact = $("#contact").val().trim();

            if(station_name!= null && address!=null && country!="-1" && state!="-1" && city!="-1" && contact!=null){
                var name_pattern = /[a-zA-Z\s]+$/;
                var address_pattern = /[a-zA-Z0-9\s]+?/;
                var phno_pattern = /^\d{10}$/;
                if(!station_name.match(name_pattern)){
                    Swal.fire({
                        icon: "error",
                        title: "Error In Station Name",
                        text: "Invalid  Pattern, Please Enter Only Alphabet Letters "
                    });
                }else if(!address.match(address_pattern)){
                    Swal.fire({
                        icon: "error",
                        title: "Error In Station Address",
                        text: "Invalid  Pattern, Please Enter Address "
                    });
                }else if(!contact.match(phno_pattern)){
                    Swal.fire({
                        icon: "error",
                        title: "Error In Contact No",
                        text: "Invalid  Pattern, Please Enter Valid Contact No"
                    });
                }
                else{
                    $(".loader").show();
                    $.ajax({
                        url: "./php/crud.php",
                        type: "post",
                        data: {
                            stationName:station_name,
                            address:address,
                            state:state,
                            city:city,
                            contact:contact
                        },
                        success: function(response) {
                            $(".loader").hide();
                            if(response== 0){
                                Swal.fire({
                                    icon: "error",
                                    title: "Error In Station Name",
                                    text: "Station Name Is Alredy Exiest."
                                });
                                console.log(response);
                            }else if(response== 1){
                                Swal.fire({
                                    icon: "error",
                                    title: "Error In Contact",
                                    text: "Contact No Is Alredy Exiest."
                                });
                                console.log(response);
                            }
                            else if(response == 2){
                                Swal.fire({
                                icon: "success",
                                title: "Add Station Successfully"
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
                    title: 'All fileds are required'
                })  
            }
        }

        function updatePoliceStation(e){

            var station_id = $("#update-station_id").val().trim();
            var station_name = ($("#update-station_name").val().trim()).replace(/ {2,}/g,' ');
            var station_address = ($("#update-address").val().trim()).replace(/ {2,}/g,' ');
            var contact = $("#update-contact").val().trim();
            
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

            if(station_name!="" && station_address!="" && contact!=""){

                var name_pattern = /[a-zA-Z\s]+$/;
                var address_pattern = /[a-zA-Z0-9\s]+?/;
                var phno_pattern = /^\d{10}$/;    

                if(!station_name.match(name_pattern)){
                    Swal.fire({
                        icon: "error",
                        title: "Error In Station Name",
                        text: "Invalid  Pattern, Please Enter Only Alphabet Letters "
                    });
                }else if(!station_address.match(address_pattern)){
                    Swal.fire({
                        icon: "error",
                        title: "Error In Station Address",
                        text: "Invalid  Pattern, Please Enter Address "
                    });
                }else if(!contact.match(phno_pattern)){
                    Swal.fire({
                        icon: "error",
                        title: "Error In Contact No",
                        text: "Invalid  Pattern, Please Enter Valid Contact No"
                    });
                }else{
                    $(".loader").show();
                    $.ajax({
                        url: "./php/crud.php?updateStationId="+station_id,
                        type: "GET",
                        data: {
                            stationId:station_id,
                            stationName:station_name,
                            address:station_address,
                            contact:contact

                        },
                        success: function(response) {
                            $(".loader").hide();
                            if(response== 0){
                                Swal.fire({
                                    icon: "error",
                                    title: "Error In Station Name",
                                    text: "Station Name Is Alredy Exiest."
                                });
                                console.log(response);
                            }else if(response== 1){
                                Swal.fire({
                                    icon: "error",
                                    title: "Error In Contact",
                                    text: "Contact No Is Alredy Exiest."
                                });
                                console.log(response);
                            }else if(response == 2){
                                Swal.fire({
                                icon: "success",
                                title: "Update Station Successfully"
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
                    title: 'All fileds are required'
                })   
            }



        }

        function deleteStation(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $(".loader").show();
                $.ajax({
                    url: "php/crud.php?deleteStation="+id,
                    type: "GET",
                    success: function(response) {
                        $(".loader").hide();
                        if(response == "1"){
                            Swal.fire({
                                title: "Deleted!",
                                text: "Deleted Successfully.",
                                icon: "success"
                            }).then((result) => {
                                    location.reload();
                                })
                        }else{
                            console.log(response);
                        }
                    }
                });
            }
            });
        
        }





</script>
</body>

</html>