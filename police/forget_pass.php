<?php
include('php/database.php');
if(isset($_SESSION['pid'])){
  header('Location:dashbord.php');
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">

    
    <link rel="stylesheet" href="./CSS/login.css">
    <?php require './includes/font.php'?>
    <title>Police (Forget Password)</title>
    <style>
        #email{
            font-family: 'Playfair Display', serif;
            font-size:15px;
        }
        #pass{
            font-family: 'Playfair Display', serif;
            font-size:15px;
        }
    </style>
</head>
<body onload="startSpinner()">
    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>
	<section class="login">
		<div class="login_box">
			<div class="left">
				<div class="contact">
					<form method="POST" autocomplete="off">
						<h3>Forgot Password?</h3>

						<div class="alert alert-danger" role="alert" id="error" style="display:none;"></div>
                        
						<input type="text"  id="email" placeholder="EMAIL">
                        <small><span class="Error email_err">* It Is reqired</span></small>

                        <input type="text" style="display:none;" id="user_otp" name="otp" placeholder="OTP">
                        <small><span class="Error otp_err">* It Is reqired</span></small>

                        <div class="col-sm-12 d-inline-flex" style="margin-bottom:2px;">
                                <input type="button" id="send_otp_btn" class="btn btn-sm btn-secondary"  value="Send OTP" onclick="send_otp()">
                                <input type="button" id="resend_otp_btn" class="btn btn-sm btn-secondary" style="display:none;" value="Resend OTP" onclick="resend_otp()">
                            </div>
                            <p id="resend_otp" style="display:none;font-size:15px;text-align: center;"> Resend OTP in <span id="countdowntimer" >60 </span> Seconds</p>
						<button class="submit" name="submit" onclick="submit1(event)">LET'S GO</button>
                      
					</form>
				</div>
			</div>



			<div class="right">
				<div class="right-text">
					
			</div>
		</div>
	</section>
	<!-- <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> -->
    <script src="./js/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<script>
		let otp = Math.floor(100000 + Math.random() * 900000);
        // let otp = 0;
        function startSpinner(){
            $(".loader").css("display", "none");
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
                                    $("#user_otp").show();
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

        function submit1(e){

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
            e.preventDefault();
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
                // console.log($("#user_otp").css('display').toLowerCase());
                
                if($("#user_otp").css('display').toLowerCase()=="none"){
                    Swal.fire({
                        icon: "error",
                        title: "Error In OTP",
                        text: "Please Click Send OTP Button"
                    });
                    return false;           
                }
                else if(otp!=user_otp){
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
</body>
</html>