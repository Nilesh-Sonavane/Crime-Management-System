<?php
    include_once './php/database.php';
    if(isset($_SESSION['uid'])){
        header('Location:index.php');
      }
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BharatSuraksha</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/forget_pass.css">
  <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
  <link rel="stylesheet" href="./css/all.css">
  <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">


</head>

<body onload="startSpinner()">

    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>

  <?php require './includes/header.php'?>
  <form>
        <div class="page-title">
            <h2>Forgotten Your Password?</h2>
        </div>
        <div class="container1">
            <label style="margin-top: 0;margin-bottom: 1rem;margin-left:20px"> <storng>All fields marked with <span class="require">*</span> are mandatory </storng> </label>
            <div class="row">
                <div class="col-md-5">
                    <label for="email">Email Address</label><span class="require">*</span>
                    <input type="email" name="email" id="email">
                    <small><span class="Error email_err">* It Is reqired</span></small>
                </div>
                <div class="col-md-2">
                    <hr>
                </div>
                <div class="col-md-5">
                    <label for="otp">Get OTP</label><span class="require">*</span>
                <div class="col-sm-12 d-inline-flex">
                        <input type="button" id="send_otp_btn" class="btn btn-sm btn-secondary" style="margin:20px 2px;" value="Send OTP" onclick="send_otp()">
                        <input type="text" style="margin:20px 2px;" id="user_otp" name="otp">
                    </div>
                    <p id="resend_otp" style="display:none;"> Resend OTP in <span id="countdowntimer" >60 </span> Seconds</p>
                    <input type="button" id="resend_otp_btn" class="btn btn-sm btn-secondary" style="display:none;" value="Resend OTP" onclick="resend_otp()">
                    <small><span class="Error otp_err">* It Is reqired</span></small>
                </div>
            </div>

            <div class="row">
                <div class="buttons">
                    <input type="button" onclick="submit1()" class="btn_sub mx-2 btn btn-sm btn-secondary" value="Submit">
                    <input type="button" class="btn_back mx-2 btn btn-sm btn-secondary" onclick="back()" value="Back">
                </div>
            </div>
        </div>
    </form>
  <?php require 'signin.php'?>
  
  <?php require './includes/footer.php'?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="./js/script.js"></script>

  
</body>
<script>
  let otp = Math.floor(100000 + Math.random() * 900000);
  // let otp = 0;
  function startSpinner(){
    $(".loader").css("display", "none");
  }
  function back(){
    window.location.href = 'index.php#open-modal';
  }
  function send_otp(){

    var email = (document.getElementById("email").value).toLowerCase();
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
                url: "./php/sendForResetPassOTP.php",
                type: "POST",
                data: {
                    email:email,
                    otp:otp
                },
                success: function(response) {
                    if(response == 0){
                      $(".loader").hide(); 
                      $("#email").prop("readonly", false);
                      $("#send_otp_btn").show();
                      $("#resend_otp").hide();
                      Swal.fire({
                        icon: "error",
                        title: "Error In Email",
                        text: "Email Is Not Registered."
                      }); 
                    }
                    else if(response == 1){
                        $(".loader").hide();    
                        Swal.fire({
                          icon: "success",
                          title: "OTP Submit Successfully",
                          text :"Please Check Your Registered Email"
                        }).then((result) => {
                          start_resend_timer();
                        })
                    }
                    else{
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
  function submit1(){
    const Toast = Swal.mixin({
      toast: true,
      position: 'bottom-middle',
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true, 
      onOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    });
    var email = (document.getElementById("email").value).toLowerCase();
    var user_otp = document.getElementById("user_otp").value;
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
    if(email!=""){
      check_email();
      if( check_email() && check_otp()){
        
        var encripted_email = window.btoa(email);
        window.location.href = 'forget_NewPassword.php?email=' + encripted_email;
        
        // var decripted_email = window.atob(encripted_email);
        // console.log(decripted_email);
      }
    }else{
      Toast.fire({    
        icon: 'error',
        title: 'All fileds are required'
      });
    }
  }

</script>
</html>