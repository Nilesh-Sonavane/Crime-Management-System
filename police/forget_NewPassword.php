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
    <title>Police (Login)</title>
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
					<form>
						<h3>Forgot Password?</h3>

						<div class="alert alert-danger" role="alert" id="error" style="display:none;"></div>
                        
                        <input type="password" name="password" id="pass" placeholder="New Password">
                        
                        <small><span class="Error pass_err">* It Is reqired</span></small><br>
                        
                        <input type="password" name="confirem-password" placeholder="Confirm Password" onpaste="return false" id="con_pass">
                        <small><span class="Error con_pass_err">* It Is reqired</span></small><br>
                        
						<button type="button" class="submit" name="submit" onclick="submit1(event)">LET'S GO</button>
                      
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
        $(document).ready(function(){

        $(".Error").hide();
            $("#pass").focus(function(){
                $("#tooltiptext").css("visibility","visible");
            })
            $("#pass").blur(function(){
                $("#tooltiptext").css("visibility","hidden");
            });
        });
        function startSpinner(){
            $(".loader").css("display", "none");
        }
        const urlParams = new URLSearchParams(window.location.search);
        const myParam = String(urlParams.get('email'));
        var decripted_email = window.atob(myParam);
        
        function submit1(){
                
            var pass = document.getElementById("pass").value;
            var con_pass = document.getElementById("con_pass").value;   
            var pass_pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/;
            
            function check_pass(){
                if(!pass.match(pass_pattern)){
                    $(".pass_err").show();  
                    $(".pass_err").html("*Invalid Password Pattern");
                    return false;
                }
                else{
                    $(".pass_err").hide();
                    $(".pass_err").html("");
                    return true;
                }
            }
            function check_con_pass(){
                if(pass!=con_pass){
                    $(".con_pass_err").show();  
                    $(".con_pass_err").html("*Confirem Passwords Don't Match");
                    return false;
                }
                else{
                    $(".con_pass_err").hide();
                    $(".con_pass_err").html("");
                    return true;
                }
            }
            if(pass!="" && con_pass!=""){
                check_pass();
                check_con_pass();

                if(check_pass() && check_con_pass()){
                    $(".loader").show();
                    
                    $.ajax({
                        url: "./php/forgetPassword.php",
                        type: "POST",
                        data: {
                            email:decripted_email,
                            password:pass
                        },
                        success: function(response) {
                            if(response == 1){
                                $(".loader").hide();    
                                Swal.fire({
                                icon: "success",
                                title:"Success",
                                text: "Password Reset Successfully"
                                }).then((result) => {
                                    window.location.href = 'index.php#open-modal';
                                })
                            }else{
                                console.log(response);  
                            }
                        }
                    });   
                }
            }
        } 
    </script>
</body>
</html>