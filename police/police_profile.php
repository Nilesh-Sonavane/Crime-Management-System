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

    $fname =  ucfirst($row['first_name']);
    $mname =  ucfirst($row['middle_name']);
    $lname =  ucfirst($row['last_name']);
    $dob =  $row['dob'];
    $contact =  $row['contact'];
    $email =  $row['email'];
    $rank =  $row['rank_id'];

    $city_id = $row['city_id'];
    $sql_city = "SELECT * FROM cities WHERE city_id= $city_id";
    $result_city =$conn->query($sql_city);
    $row_city = mysqli_fetch_assoc($result_city);

    $state_id = $row_city['state_id'];
    $sql_state = "SELECT * FROM states WHERE state_id= $state_id";
    $result_state =$conn->query($sql_state);
    $row_state = mysqli_fetch_assoc($result_state);

    $country_id =  $row_state['country_id'];
    $sql_country = "SELECT * FROM countries WHERE country_id= $country_id";
    $result_country =$conn->query($sql_country);
    $row_country = mysqli_fetch_assoc($result_country);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/police_profile.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">

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
        <h2 style="text-align:center;background:#aed3fb;color:rgb(5, 98, 167);padding:10px;border-radius:5px;margin:10px">POLICE PROFILE</h2>
            
            <div class="container profile_box" id="profile_box" style="background-color:#fff">
            <form>
            <input type="hidden" id="police_id" name="police_id" value="<?php echo $police_id?>">
                <div class="row">
                    <div>
                        <button type="button" id="btn-edit" type="submit" class="btn btn-primary" onclick="edit()">Edit</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="first_name" style="color:#7d7878" class="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $fname;?>"> 
                        <small><span class="Error fname_err"></span></small>
                    </div>
                    <div class="col-md-4">
                        <label for="middle_name" style="color:#7d7878" class="middle_name">Middle Name</label>
                        <input type="text" class="form-control" name="middle_name" id="middle_name" value="<?php echo $mname;?>">
                        <small><span class="Error mname_err"></span></small> 
                    </div>
                    <div class="col-md-4">
                        <label for="last_name" style="color:#7d7878" class="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $lname;?>"> 
                        <small><span class="Error lname_err"></span></small>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <label for="contact" style="color:#7d7878" class="contact">Contact</label>
                        <input type="text" class="form-control" name="contact" id="contact" value="<?php echo $contact;?>"> 
                        <small><span class="Error phone_err"></span></small>
                    </div>
                    <div class="col-md-4">
                        <label for="email" style="color:#7d7878" class="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $email;?>"> 
                        <small><span class="Error email_err"></span></small>
                    </div>
                    <div class="col-sm-4">
                        <label for="otp" style="color:#7d7878">Get OTP</label>
                        <div class="col-sm-12 d-inline-flex" style="margin-bottom:2px;">
                            <input type="button" id="send_otp_btn" class="btn btn-sm btn-secondary" style="margin:0px 2px;" value="Send OTP" onclick="send_otp()">
                            <input type="button" id="resend_otp_btn" class="btn btn-sm btn-secondary" style="display:none;" value="Resend OTP" onclick="resend_otp()">
                            <input type="text" class="form-control" style="margin:0px 2px;" id="user_otp" name="otp">
                        </div>
                        <p id="resend_otp" style="display:none;font-size:15px;color:#7d7878;text-align: center;"> Resend OTP in <span id="countdowntimer" >60 </span> Seconds</p>
                        <small><span class="Error otp_err">* It Is reqired</span></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="dob" style="color:#7d7878" class="dob">Date Of Birth</label>
                        <input class="form-control" id="dob" type="date" onkeydown="return false" value="<?php echo $dob;?>">
                        <small><span class="Error dob_err"></span></small>
                    </div>
                   
                    <div class="col-md-8">
                        <label for="rank" style="color:#7d7878" class="rank">Rank</label>
                        <select class="form-control form-select" id="rank" name="rank">
                            <option value="-1" selected>-- Select --</option>
                            <?php
                                 $sql = "SELECT * FROM police_ranks";
                                 $result =$conn->query($sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                        <option <?php if($rank==$row['rank_id']){echo 'selected';}?> value="<?php echo $row['rank_id'];?>"><?php echo $row['rank_name'];?></option>
                                    <?php
                                }
                            ?>
                        </select> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="country" style="color:#7d7878" class="country">Country</label>
                        </select>
                        <select class="form-control form-select" id="country" name="country">
                                <option value="-1" selected>--Select--</option>
                                <?php
                                    $sql = "SELECT * FROM countries";
                                    $result =$conn->query($sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                            <option <?php if($country_id==$row['country_id']){echo 'selected';}?>  value="<?php echo $row['country_id'];?>"><?php echo $row['country_name'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>  
                    </div>
                    <div class="col-md-4">
                        <label for="state" style="color:#7d7878" class="state">State</label>
                        <select class="form-control form-select" id="state" name="state">
                            <option value="-1" selected>--Select--</option>
                            <?php
                                    $sql = "SELECT * FROM states";
                                    $result =$conn->query($sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                            <option <?php if($state_id==$row['state_id']){echo 'selected';}?>  value="<?php echo $row['state_id'];?>"><?php echo $row['state_name'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>  
                        </select>     
                    </div>
                    <div class="col-md-4">
                        <label for="city" style="color:#7d7878" class="city">City</label>
                        <select class="form-control form-select" id="city" name="city">
                            <option value="-1" selected>--Select--</option>
                            <?php
                                $sql = "SELECT * FROM cities WHERE state_id=$state_id";
                                $result =$conn->query($sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                        <option <?php if($city_id==$row['city_id']){echo 'selected';}?>  value="<?php echo $row['city_id'];?>"><?php echo $row['city_name'];?></option>
                                    <?php
                                }
                            ?>
                        </select> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="police_station" style="color:#7d7878" class="police_station">Police Station</label>
                        <select class="form-control form-select" id="police_station" name="police_station">
                            <option  value="-1" selected>-- Select --</option>
                            <?php
                                $sql = "SELECT * FROM police_station WHERE city_id=$city_id";
                                $result =$conn->query($sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                        <option  <?php if($station_id==$row['station_id']){echo 'selected';}?> value="<?php echo $row['station_id'];?>"><?php echo $row['station_name'];?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div style="margin-top:30px;">
                    <button type="button" id="btn-update" style="display:none;" class="btn btn-success" onclick="update()">Update</button> 
                    <button type="button" id="btn-cancle" type="button" style="display:none;" class="btn btn-danger" onclick="cancle()">Cancle</button>
                </div>
                </form>
            </div>
    </div>
    <script src="./js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
    <script>
        let otp = Math.floor(100000 + Math.random() * 900000);

        function startSpinner(){
            $(".loader").css("display", "none");
        }
        // validate date and time disable 
        const d = new Date();
        let fullYear = d.getFullYear()-21;
        let m = (d.getMonth()+1);
        let month = m<10?('0'+m):m;
        let dt = d.getDate();
        let date =  dt<10?('0'+dt):dt;
        const today = fullYear+"-"+month+"-"+date;
        document.getElementById("dob").setAttribute("max", today);

        $(document).ready(function(){

            $("#first_name").prop("disabled", true);
            $("#middle_name").prop("disabled", true);
            $("#last_name").prop("disabled", true);
            $("#email").prop("disabled", true);
            $("#send_otp_btn").prop("disabled", true);
            $("#user_otp").prop("disabled", true);  
            $("#contact").prop("disabled", true);
            $("#dob").prop("disabled", true);
            $("#rank").prop("disabled", true);
            $("#country").prop("disabled", true);
            $("#state").prop("disabled", true);
            $("#city").prop("disabled", true);
            $("#police_station").prop("disabled", true);

            $('#country').on('change',function(){
                var country_id = this.value;
                if(country_id!="-1"){
                    $.ajax({
                        url: "./php/states-by-country.php",
                        type: "POST",
                        data: {
                            country_id: country_id
                        },
                        cache: false,
                        success: function(result){
                            $("#state").html(result);
                        }
                    });
                }else{
                    $("#state").html('<option value="-1" >--Select--</option>');
                    $("#city").html('<option value="-1" >--Select--</option>');
                    $("#police_station").html('<option value="-1" >--Select--</option>');
                }
                
            });
            $('#state').on('change', function() {
                var state_id = this.value;
                if(state_id!="-1"){
                    $.ajax({
                        url: "./php/cities-by-state.php",
                        type: "POST",
                        data: {
                            state_id: state_id
                        },
                        cache: false,
                        success: function(result){
                            $("#city").html(result);
                        }
                    });
                }else{
                    $("#city").html('<option value="-1" >--Select--</option>');
                    $("#police_station").html('<option value="-1" >--Select--</option>');
                }
                
            });
            $('#city').on('change', function() {
                var city_id = this.value;
                if(city_id!="-1"){
                    $.ajax({
                        url: "./php/station-by-city.php",
                        type: "POST",
                        data: {
                            city_id: city_id
                        },
                        cache: false,
                        success: function(result){
                            $("#police_station").html(result);
                        }
                    });
                }else{
                    $("#police_station").html('<option value="-1" >--Select--</option>');
                }
                
            });
        });
        function send_otp(){

            var email = document.getElementById("email").value;
            var email_pattern=/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;

            function check_email(){
                if(!email.match(email_pattern)){
                    $(".email_err").show();
                    $(".email_err").html("* Please Enter Proper Email");
                    return false;
                }else{
                    $(".email_err").html("");
                    $(".email_err").hide();
                    return true;
                }   
            }
            if(email!=""){
                check_email();
                if(check_email()){
                    otp = Math.floor(100000 + Math.random() * 900000);
                    $("#email").prop("readonly", true);
                    $("#send_otp_btn").hide();
                    $("#resend_otp").show();
                    $(".loader").show();
                    $.ajax({
                        url: "./php/sendOTP.php",
                        type: "POST",
                        data: {
                            email:email,
                            otp:otp
                        },
                        success: function(response) {
                            if(response == 1){
                                $(".loader").hide();    
                                Swal.fire({
                                icon: "success",
                                title: "OTP Submit Successfully",
                                text :"Please Check Your Registered Email"
                                }).then((result) => {
                                    start_resend_timer();
                                })
                            }else{
                                console.log(response);  
                            }
                        }
                    });   
                }
            }
        }
        function start_resend_timer(){
            var timeleft = 60;
            var downloadTimer = setInterval(function(){
                timeleft--;
                document.getElementById("countdowntimer").textContent = timeleft;
                if(timeleft==0){
                    $("#resend_otp").hide();
                    $("#resend_otp_btn").show();
                }
                if(timeleft <= 0){
                    clearInterval(downloadTimer);
                }        
            },1000);
            // console.log(otp);  
        }
        function resend_otp(){
            $("#resend_otp_btn").hide();
            send_otp();
        }
        function edit(){
            $("#btn-edit").hide();
            $("#first_name").prop("disabled", false);
            $("#middle_name").prop("disabled", false);
            $("#last_name").prop("disabled", false);
            $("#email").prop("disabled", false);
            $("#send_otp_btn").prop("disabled", false);
            $("#user_otp").prop("disabled", false);  
            $("#contact").prop("disabled", false);
            $("#dob").prop("disabled", false);
            $("#rank").prop("disabled", false);
            $("#country").prop("disabled", false);
            $("#state").prop("disabled", false);
            $("#city").prop("disabled", false);
            $("#police_station").prop("disabled", false);
            $("#btn-update").show();
            $("#btn-cancle").show();
        }
        function cancle(){
            // $("#btn-edit").show();
            // $("#first_name").prop("disabled", true);
            // $("#middle_name").prop("disabled", true);
            // $("#last_name").prop("disabled", true);
            // $("#email").prop("disabled", true);
            // $("#send_otp_btn").prop("disabled", true);
            // $("#user_otp").prop("disabled", true);  
            // $("#contact").prop("disabled", true);
            // $("#dob").prop("disabled", true);
            // $("#rank").prop("disabled", true);
            // $("#country").prop("disabled", true);
            // $("#state").prop("disabled", true);
            // $("#city").prop("disabled", true);
            // $("#police_station").prop("disabled", true);
            // $("#btn-update").hide();
            // $("#btn-cancle").hide();
            location.reload();
        }
        function update(){

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
            var police_id = document.getElementById("police_id").value;
            var first_name = document.getElementById("first_name").value;
            var middle_name = document.getElementById("middle_name").value;
            var last_name = document.getElementById("last_name").value;
            var dob = document.getElementById("dob").value;
            var contact = document.getElementById("contact").value;
            var email = (document.getElementById("email").value).toLowerCase();
            var user_otp = document.getElementById("user_otp").value;
            var country = document.getElementById("country").value;
            var state = document.getElementById("state").value;
            var city = document.getElementById("city").value;
            var rank = document.getElementById("rank").value;
            var police_station = document.getElementById("police_station").value;

            

            var name_pattern = /^[A-Za-z\-]+$/;
            var address_pattern = /[a-zA-Z0-9\s]+?/;
            var phno_pattern = /^\d{10}$/;
            var email_pattern=/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;

            function check_fname(){
                if(!first_name.match(name_pattern)){
                    $(".fname_err").show();
                    $(".fname_err").html("* Please Enter Only Alphabet");
                    return false;
                }
                else if(first_name.length<=2 || first_name.length>=25){
                    $(".fname_err").show();
                    $(".fname_err").html("* Please Enter 2-25 Alphabet");
                    return false;
                }else{
                    $(".fname_err").html("");
                    $(".fname_err").hide();
                    return true;
                }
            }
            function check_mname(){

                if(!middle_name.match(name_pattern)){
                    $(".mname_err").show();
                    $(".mname_err").html("* Please Enter Only Alphabet");
                    return false;
                }
                else if(middle_name.length<=2 || middle_name.length>=25){
                    $(".mname_err").show();
                    $(".mname_err").html("* Please Enter 2-25 Alphabet");
                    return false;
                }else{
                    $(".mname_err").hide();
                    $(".mname_err").html("");
                    return true;
                }
            }
            function check_lname(){
                if(!last_name.match(name_pattern)){
                    $(".lname_err").show();
                    $(".lname_err").html("* Please Enter Only Alphabet");
                    return false;
                }
                else if(last_name.length<=2 || last_name.length>=25){
                    $(".lname_err").show();
                    $(".lname_err").html("* Please Enter 2-25 Alphabet");
                    return false;
                }else{
                    $(".lname_err").html("");
                    $(".lname_err").hide();
                    return true;
                }
            }
            function check_phone(){
                if(!contact.match(phno_pattern)){
                    $(".phone_err").show();
                    $(".phone_err").html("* Please Enter Proper Contact No");
                    return false;
                }else{
                    $(".phone_err").hide();
                    $(".phone_err").html("");
                    return true;
                }
            }
            function check_email(){  
                if(!email.match(email_pattern)){
                    $(".email_err").show();
                    $(".email_err").html("* Please Enter Proper Email");
                        return false;
                }else{
                    $(".email_err").html("");
                    $(".email_err").hide();
                    return true;
                }
            }
            function check_otp(){
                if(otp!=user_otp){
                    Swal.fire({
                        icon: "error",
                        title: "Error In OTP",
                        text: "Please Check Your OTP"
                    });
                    return false;
                }
                else{
                    return true;
                }
            }

            if(first_name!="" && middle_name!="" && last_name!="" && dob!="" && contact!="" && email!="" &&  country!="-1" && state!="-1" && city!="-1" && rank!="-1" &&  police_station!="-1"){
                check_fname();
                check_mname();
                check_lname();
                check_phone();
                check_email();
                
                if(check_fname() && check_mname() && check_lname() && check_phone() && check_email() && check_otp()){
                    $(".loader").show();
                    $.ajax({    
                        url: "./php/update_profile.php",
                        type: "post",
                        data: {
                            id :police_id,
                            first_name:first_name,
                            middle_name:middle_name,
                            last_name:last_name,
                            dob:dob,
                            contact:contact,
                            email:email,
                            city:city,
                            rank:rank,
                            police_station:police_station

                        },
                        success: function(response) {
                            $(".loader").hide();
                            if(response=="1"){
                                Swal.fire({
                                    icon: "error",
                                    title: "Error In Email",
                                    text: "Email Is Alredy Exiest."
                                });
                                console.log(response);
                            }else if(response=="2"){
                                Swal.fire({
                                    icon: "error",
                                    title: "Error In Contact No",
                                    text: "Contact No Is Alredy Exiest."
                                });
                            }else if(response == "ok"){
                                Swal.fire({
                                    icon: "success",
                                    title: "Update Successfully"
                                }).then((result) => {
                                    location.reload();
                                })
                            }
                            else{
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
    </script>
</body>
</html>