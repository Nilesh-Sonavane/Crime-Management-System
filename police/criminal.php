<?php
include('php/database.php');
if(!isset($_SESSION['pid'])){
  header('Location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/criminal.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">



    <title>Police (wanted)</title>
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
            <h2 style="text-align:center;background:#aed3fb;color:rgb(5, 98, 167);padding:10px;border-radius:5px;margin:10px">WANTEDS</h2>
            <div class="container">
                <button id="addCriminalBtn" class="btn btn-success"> <i class="fa fa-plus-circle"></i> Add Wanted</button>
            </div>
                <div class="container criminal_box" id="criminal_box" style="display:none">
                
                    <form id="criminalForm" method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-4">
                                <label for="crimi   nal_name">Wanted Name</label><span class="require">*</span>
                                <input type="text" name="criminal_name"  id="criminal_name">
                                <small><span class="Error name_err"></span></small>
                            </div>
                            <div class="form-check col-sm-4">
                                <label for="gender"> Gender</label><span class="require">*</span><br>
                                <input class="form-check-label" type="radio" value="Male" name="gender"> Male
                                <input class="form-check-label" type="radio" value="Female" name="gender"> Female
                                <small><span class="Error gender_err"></span></small>
                            </div>
                            <div class="col-md-4">
                                <label for="dob"  class="dob">Date Of Birth</label><span class="require">*</span>
                                <input  id="dob" type="date" name="dob" onkeydown="return false">
                                <small><span class="Error dob_err"></span></small>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <label for="height">Height</label><span class="require">*</span>
                                <input type="text" name="height"  id="height" placeholder="e.g. 000cm">
                                <small><span class="Error height_err"></span></small>
                            </div>
                            <div class="col-md-4">
                                <label for="weight">Weight</label><span class="require">*</span>
                                <input type="text" name="weight"  id="weight" placeholder="e.g. 00kg or 00.0kg">
                                <small><span class="Error weight_err"></span></small>
                            </div>
                            <div class="col-md-4">
                                <label for="eye_color">Eye Color</label><span class="require">*</span>
                                <input type="text" name="eye_color"  id="eye_color">
                                <small><span class="Error eye_color_err"></span></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="hair_color">Hair Color</label><span class="require">*</span>
                                <input type="text" name="hair_color"  id="hair_color">
                                <small><span class="Error hair_color_err"></span></small>
                            </div>
                            <div class="col-md-4">
                                <label for="nationality">Nationality</label><span class="require">*</span>
                                <input type="text" name="nationality"  id="nationality">
                                <small><span class="Error nationality_err"></span></small>
                            </div>
                            <div class="col-md-4">
                                <label for="reward">Reward</label><span class="require">*</span>
                                <input type="text" name="reward"  id="reward">
                                <small><span class="Error reward_err"></span></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="file">Image </label><span class="require">*</span>
                                <input type="file" name="file"  id="file">
                            </div>
                            <div class="col-md-4">
                                <label for="last_known_location">Last Known Location</label><span class="require">*</span>
                                <input type="text" name="last_known_location"  id="last_known_location">
                                <small><span class="Error location_err"></span></small>
                            </div>
                            <div class="col-md-4">
                                <label for="description">Description</label><span class="require">*</span>
                                <input type="text" name="description"  id="description">
                                <small><span class="Error description_err"></span></small>
                            </div>
                        </div>
                        <div style="margin-top:30px;">
                            <button id="btn-add" type="submit" style="display:visible;" class="btn btn-primary" onclick="submit_criminal(event)">Add</button> 
                            <button id="btn-hide" type="button" class="btn btn-danger">Cancle</button>
                        </div>
                    </form>
                </div>
                <div class="criminal_table" style="margin:10px">

                </div>
        </div>

    </div>


    <!-- update wanted start  -->

<div id="modal">
    <div id="modal-form">
        <h2>Update Wanted Person</h2>
        <form id="update_criminalForm" method="POST" enctype="multipart/form-data">
        
            <input type="hidden" name="update-criminal_id"  id="update-criminal_id" >

            <div class="row">
                <div class="col-md-4">
                    <label for="update-criminal_name">Wanted Name</label><span class="require">*</span>
                    <input type="text" name="update-criminal_name"  id="update-criminal_name">
                    <small><span class="Error update_name_err"></span></small>
                </div>
                <div class="form-check col-sm-4">
                    <label for="update-gender"> Gender</label><span class="require">*</span><br>
                    <input class="form-check-label" type="radio" id="Male" value="Male" name="update-gender"> Male
                    <input class="form-check-label" type="radio" id="Female" value="Female" name="update-gender"> Female
                    <small><span class="Error update_gender_err"></span></small>
                </div>
                <div class="col-md-4">
                    <label for="update-dob" >Date Of Birth</label><span class="require">*</span>
                    <input  id="update-dob" type="date" name="update-dob">
                    <small><span class="Error update_dob_err"></span></small>
                </div>
            </div>
            <div class="row">

                <div class="col-md-4">
                    <label for="update-height">Height</label><span class="require">*</span>
                    <input type="text" name="update-height"  id="update-height" placeholder="e.g. 000cm">
                    <small><span class="Error update_height_err"></span></small>
                </div>
                <div class="col-md-4">
                    <label for="update-weight">Weight</label><span class="require">*</span>
                        <input type="text" name="update-weight"  id="update-weight" placeholder="e.g. 00kg or 00.0kg">
                        <small><span class="Error update_weight_err"></span></small>
                </div>
                <div class="col-md-4">
                    <label for="update-eye_color">Eye Color</label><span class="require">*</span>
                    <input type="text" name="update-eye_color"  id="update-eye_color">
                    <small><span class="Error update_eye_color_err"></span></small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="update-hair_color">Hair Color</label><span class="require">*</span>
                    <input type="text" name="update-hair_color"  id="update-hair_color">
                    <small><span class="Error update_hair_color_err"></span></small>
                </div>
                <div class="col-md-4">
                    <label for="update-nationality">Nationality</label><span class="require">*</span>
                    <input type="text" name="update-nationality"  id="update-nationality">
                    <small><span class="Error update_nationality_err"></span></small>
                </div>
                <div class="col-md-4">
                    <label for="update-reward">Reward</label><span class="require">*</span>
                    <input type="text" name="update-reward"  id="update-reward">
                    <small><span class="Error update_reward_err"></span></small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="update-file">Image </label><span class="require">*</span>
                    <input type="file" name="update-file"  id="update-file">
                </div>
                <div class="col-md-4">
                    <label for="update-last_known_location">Last Known Location</label><span class="require">*</span>
                    <input type="text" name="update-last_known_location"  id="update-last_known_location">
                    <small><span class="Error update_location_err"></span></small>
                </div>
                <div class="col-md-4">
                    <label for="update-description">Description</label><span class="require">*</span>
                    <input type="text" name="update-description"  id="update-description">
                    <small><span class="Error update_description_err"></span></small>
                </div>
            </div>                       
        
            <div style="margin-top:30px;">
                <button id="btn-update"  type="button" onclick="updateWantedPerson(event)" class="btn btn-success" >Update</button> 
                <button id="btn-hide" type="button" class="btn btn-danger" style="float:right">Cancle</button>
            </div>
        </form>
    </div>
     
</div>

<!-- update wanted station end  -->

    
<!-- view image start -->
<div id="popup1" class="overlay">
	<div class="popup">
		<h2>Criminal Image</h2>
		<a class="close" href="">&times;</a>
		<div class="content">
            <img id="up-img"  src="" height="500vh" width="100%"></img>
		</div>
	</div>
</div>
<!-- view image end -->
<script src="./JS/script.js"></script>
<script src="./js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->
    
    <script>
        // validate date and time disable 
            const d = new Date();

            let fullYear = d.getFullYear()-18;
            let m = (d.getMonth()+1);
            let month = m<10?('0'+m):m;
            let dt = d.getDate();
            let date =  dt<10?('0'+dt):dt;
            const today = fullYear+"-"+month+"-"+date;
            document.getElementById("dob").setAttribute("max", today);

        // **************** end *********

        function startSpinner(){
            $(".loader").css("display", "none");
        }  

        $(document).ready(function(){
            loadCriminalTable();
            $("#addCriminalBtn").click(function(){
                $("#criminal_box").show();
                $("#btn-add").show();
                

            });
            $("#btn-hide").click(function(){
                $("#criminal_box").hide();
            }); 
            $(document).on("click",".fa-edit",function(){
                $("#modal").show();
            });
            $(document).on("click","#btn-hide",function(){
                $("#modal").hide();
            });
        });
        function getimage(img) {
            $("#up-img").attr("src", "../uploads/"+img);
        }
        function getPersonInfo(id){
            $.ajax({  
            url: "php/crud.php?getPerson_id="+id,
            type: "GET",  
            dataType:"json",  
            success:function(data){ 
                $('#update-criminal_id').val(data['person_id']);
                $('#update-criminal_name').val(data['person_name']);

                var gender = data['gender'];
                if(gender=="Male"){
                    document.getElementById("Male").checked  = true;
                    document.getElementById("Female").checked  = false;
                }else{
                    document.getElementById("Female").checked  = true;
                    document.getElementById("Male").checked  = false;
                }

                $('#update-dob').val(data['dob']);
                $('#update-height').val(data['height']);
                $('#update-weight').val(data['weight']);
                $('#update-eye_color').val(data['eye_color']);
                $('#update-hair_color').val(data['hair_color']);
                $('#update-nationality').val(data['nationality']);
                $('#update-reward').val(data['reward']);
                $('#update-last_known_location').val(data['last_known_location']);
                $('#update-description').val(data['description']);    
            }  
            });
        }

        function loadCriminalTable(){
            $.ajax({  
                url: "php/criminalTable.php",
                type: "GET",  
                dataType:"html",  
                success:function(response){ 
                    $(".criminal_table").html(response);
                }  
            });
        }
        
        function submit_criminal(e){

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
            });
            e.preventDefault();
        

            var criminal_name = (document.getElementById("criminal_name").value).replace(/ {2,}/g,' ');
                if($("input[type='radio'][name='gender']:checked").val()==undefined){
                    var gender = "-1";
                }else{
                    var gender=$("input[type='radio'][name='gender']:checked").val();
                }

            // var dob = document.getElementById("dob").value;
            // var height = document.getElementById("height").value;
            // var weight = document.getElementById("weight").value;
            // var eye_color = document.getElementById("eye_color").value;
            // var hair_color = document.getElementById("hair_color").value;
            // var nationality = document.getElementById("nationality").value;
            // var reward = document.getElementById("reward").value;
            // var last_known_location = document.getElementById("last_known_location").value;
            // var description = document.getElementById("description").value;
            

            var dob = $("#dob").val().trim();
            var height = $("#height").val().trim();
            var weight = $("#weight").val().trim();
            var eye_color = ($("#eye_color").val().trim()).replace(/ {2,}/g,' ');
            var hair_color = ($("#hair_color").val().trim()).replace(/ {2,}/g,' ');
            var nationality = ($("#nationality").val().trim()).replace(/ {2,}/g,' ');
            var reward = ($("#reward").val().trim()).replace(/ {2,}/g,' ');
            var last_known_location = ($("#last_known_location").val().trim()).replace(/ {2,}/g,' ');
            var description = ($("#description").val().trim()).replace(/ {2,}/g,' ');
            var fd = document.getElementById("file").files[0];

            var string_pattern = /^[A-Za-z][A-Za-z\s.'-]+$/;
            var height_pattern = /^\d{1,3}cm$/;
            var weight_pattern = /^\d+\.{0,1}\d{1,3}kg$/;
            var degits = /^[0-9]*$/;

            
            function check_name(){
                if(!criminal_name.match(string_pattern)){
                    $(".name_err").show();
                    $(".name_err").html("* Please Enter Only Alphabets");
                    return false;
                }else{
                    $(".name_err").hide();
                    $(".name_err").html("");
                    return true;
                }
            }
            function check_gender(){
                if(gender=="-1"){
                    $(".gender_err").show();
                    $(".gender_err").html("* Please Select Gender");
                    return false;
                }else{
                    $(".gender_err").html("");
                    $(".gender_err").hide();
                    return true;
                }
            }
            function check_height(){
                if(!height.match(height_pattern)){
                    $(".height_err").show();
                    $(".height_err").html("* Please Enter Valid Pattern");
                    return false;
                }else{
                    $(".height_err").hide();
                    $(".height_err").html("");
                    return true;
                }
            }
            function check_weight(){
                if(!weight.match(weight_pattern)){
                    $(".weight_err").show();
                    $(".weight_err").html("* Please Enter Proper weight");
                    return false;
                }else{
                    $(".weight_err").hide();
                    $(".weight_err").html("");
                    return true;
                }
            }
            function check_eye_color(){
                if(!eye_color.match(string_pattern)){
                    $(".eye_color_err").show();
                    $(".eye_color_err").html("* Please Enter Proper Color");
                    return false;
                }else{
                    $(".eye_color_err").hide();
                    $(".eye_color_err").html("");
                    return true;
                }
            }
            function check_hair_color(){
                if(!hair_color.match(string_pattern)){
                    $(".hair_color_err").show();
                    $(".hair_color_err").html("* Please Enter Proper Color");
                    return false;
                }else{
                    $(".hair_color_err").hide();
                    $(".hair_color_err").html("");
                    return true;
                }
            }
            function check_nationality(){
                if(!nationality.match(string_pattern)){
                    $(".nationality_err").show();
                    $(".nationality_err").html("* Please Enter Only Alphabets");
                    return false;
                }else{
                    $(".nationality_err").hide();
                    $(".nationality_err").html("");
                    return true;
                }
            }
            function check_reward(){
                if(!reward.match(degits)){
                    $(".reward_err").show();
                    $(".reward_err").html("* Please Enter Only Numbers");
                    return false;
                }else{
                    $(".reward_err").hide();
                    $(".reward_err").html("");
                    return true;
                }
            }
        
            if(criminal_name!="" && dob!="" && height!="" && weight!="" && eye_color!="" && hair_color!="" && nationality!="" && reward!="" && last_known_location!="" && description!=""){

                check_name();
                check_gender();
                check_height();
                check_weight();
                check_eye_color();
                check_hair_color();
                check_nationality();
                check_reward();
            
                if(check_name() && check_gender() && check_height()  && check_weight() && check_eye_color() && check_hair_color() && check_nationality() && check_reward()){

                    if(fd != null){
                            var frm = document.getElementById("criminalForm");

                            var formData = new FormData(frm);
                            var imgtype = fd.name.split(".").pop().toLowerCase();

                            if (jQuery.inArray(imgtype, ["png", "jpg", "jpeg"]) == -1) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error In Image",
                                    text: "Invalid File Formate!Plz Select Image File"
                                });
                            }
                            else if (fd.size > 2000000) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error In Image",
                                    text: "Image size is Large!Plz Select Image Below 2 MB"
                                });
                            }
                            else {
                                $(".loader").show();
                                $.ajax({
                                    url: "./php/addCriminal.php?addcrim=1",
                                    type: "post",
                                    data: formData,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function(response) {
                                        $(".loader").hide();
                                        if(response == "1"){
                                            Swal.fire({
                                            icon: "success",
                                            title: "Criminal Add Successfully"
                                            }).then((result) => {
                                                location.reload();
                                            })
                                        }else{
                                            console.log(response);
                                        }
                                    }
                                });    
                            }
                        }
                        else{
                            Toast.fire({
                                icon: 'error',
                                title: 'Upload Image is Blank'
                            })      
                            
                        }
                }
            }else{
                Toast.fire({    
                    icon: 'error',
                    title: 'All fileds are required'
                }) ;
            }
        }

        function updateWantedPerson(e){

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

            var criminal_name = (document.getElementById("update-criminal_name").value).replace(/ {2,}/g,' ');
            if($("input[type='radio'][name='update-gender']:checked").val()==undefined){
                var gender = "-1";
            }else{
                var gender=$("input[type='radio'][name='update-gender']:checked").val();
            }

            
            var dob = $("#update-dob").val().trim();
            var height = $("#update-height").val().trim();
            var weight = $("#update-weight").val().trim();
            var eye_color = ($("#update-eye_color").val().trim()).replace(/ {2,}/g,' ');
            var hair_color = ($("#update-hair_color").val().trim()).replace(/ {2,}/g,' ');
            var nationality = ($("#update-nationality").val().trim()).replace(/ {2,}/g,' ');
            var reward = ($("#update-reward").val().trim()).replace(/ {2,}/g,' ');
            var last_known_location = ($("#update-last_known_location").val().trim()).replace(/ {2,}/g,' ');
            var description = ($("#update-description").val().trim()).replace(/ {2,}/g,' ');
            var fd = document.getElementById("update-file").files[0];

            var string_pattern = /^[A-Za-z][A-Za-z\s.'-]+$/;
            var height_pattern = /^\d{1,3}cm$/;
            var weight_pattern = /^\d+\.{0,1}\d{1,3}kg$/;
            var degits = /^[0-9]*$/;



            function check_name(){
                if(!criminal_name.match(string_pattern)){
                    $(".update_name_err").show();
                    $(".update_name_err").html("* Please Enter Only Alphabets");
                    return false;
                }else{
                    $(".update_name_err").hide();
                    $(".update_name_err").html("");
                    return true;
                }
            }
            function check_gender(){
                if(gender=="-1"){
                    $(".update_gender_err").show();
                    $(".update_gender_err").html("* Please Select Gender");
                    return false;
                }else{
                    $(".update_gender_err").html("");
                    $(".update_gender_err").hide();
                    return true;
                }
            }
            function check_height(){
                if(!height.match(height_pattern)){
                    $(".update_height_err").show();
                    $(".update_height_err").html("* Please Enter Valid Pattern");
                    return false;
                }else{
                    $(".update_height_err").hide();
                    $(".update_height_err").html("");
                    return true;
                }
            }
            function check_weight(){
                if(!weight.match(weight_pattern)){
                    $(".update_weight_err").show();
                    $(".update_weight_err").html("* Please Enter Proper weight");
                    return false;
                }else{
                    $(".update_weight_err").hide();
                    $(".update_weight_err").html("");
                    return true;
                }
            }
            function check_eye_color(){
                if(!eye_color.match(string_pattern)){
                    $(".update_eye_color_err").show();
                    $(".update_eye_color_err").html("* Please Enter Proper Color");
                    return false;
                }else{
                    $(".update_eye_color_err").hide();
                    $(".update_eye_color_err").html("");
                    return true;
                }
            }
            function check_hair_color(){
                if(!hair_color.match(string_pattern)){
                    $(".update_hair_color_err").show();
                    $(".update_hair_color_err").html("* Please Enter Proper Color");
                    return false;
                }else{
                    $(".update_hair_color_err").hide();
                    $(".update_hair_color_err").html("");
                    return true;
                }
            }

            function check_nationality(){
                if(!nationality.match(string_pattern)){
                    $(".update_nationality_err").show();
                    $(".update_nationality_err").html("* Please Enter Only Alphabets");
                    return false;
                }else{
                    $(".update_nationality_err").hide();
                    $(".update_nationality_err").html("");
                    return true;
                }
            }
            function check_reward(){
                if(!reward.match(degits)){
                    $(".update_reward_err").show();
                    $(".update_reward_err").html("* Please Enter Only Numbers");
                    return false;
                }else{
                    $(".update_reward_err").hide();
                    $(".update_reward_err").html("");
                    return true;
                }
            }

            if(criminal_name!="" && dob!="" && height!="" && weight!="" && eye_color!="" && hair_color!="" && nationality!="" && reward!="" && last_known_location!="" && description!=""){

                if(check_name() && check_gender()  && check_height() && check_weight() && check_eye_color() && check_hair_color() && check_nationality() && check_reward()){

                    if(fd != null){
                        var frm = document.getElementById("update_criminalForm");

                        var formData = new FormData(frm);
                        var imgtype = fd.name.split(".").pop().toLowerCase();

                        if (jQuery.inArray(imgtype, ["png", "jpg", "jpeg"]) == -1) {
                            Swal.fire({
                                icon: "error",
                                title: "Error In Image",
                                text: "Invalid File Formate!Plz Select Image File"
                            });
                        }
                        else if (fd.size > 2000000) {
                            Swal.fire({
                                icon: "error",
                                title: "Error In Image",
                                text: "Image size is Large!Plz Select Image Below 2 MB"
                            });
                        }
                        else {
                            $(".loader").show();
                            $.ajax({
                                url: "./php/updateCriminal.php?updatecrim=1",
                                type: "post",
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(response) {
                                    $(".loader").hide();
                                    if(response == "1"){
                                        Swal.fire({
                                        icon: "success",
                                        title: "Wanted Update Successfully"
                                        }).then((result) => {
                                            location.reload();
                                        })
                                    }else{
                                        console.log(response);
                                    }
                                }
                            });    
                        }
                    }
                    else{
                        Toast.fire({
                            icon: 'error',
                            title: 'Upload Image is Blank'
                        })      
                    }
                }
            }
            else{
                Toast.fire({    
                    icon: 'error',
                    title: 'All fileds are required'
                }) ;
            }
        }

        function deletePerson(id){
            
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
                        url: "./php/crud.php?deletePerson="+id,
                        type: "GET",
                        success: function(response) {
                            $(".loader").hide();
                            if(response == "1"){
                                Swal.fire({
                                icon: "success",
                                title: "Criminal Deleted Successfully"
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