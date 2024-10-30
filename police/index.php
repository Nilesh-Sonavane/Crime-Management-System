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
<body>
	<section class="login">
		<div class="login_box">
			<div class="left">
				<div class="contact">
					<form method="POST" autocomplete="off">
						<h3>POLICE LOGIN</h3>

						<div class="alert alert-danger" role="alert" id="error" style="display:none;"></div>
						<input type="text"  id="email" placeholder="EMAIL">
						<input type="password" id="pass" placeholder="PASSWORD">
                        
                        <p style="margin-top:20px;text-align:center;"><a href="forget_pass.php">Forgot Password</a>?</p>
						<button class="submit" name="login" onclick="login_police(event);">LET'S GO</button>
                        <p style="margin-top:20px;text-align:center;">Doesn't have an account yet? <a href="signUp.php">Sign up</a></p>
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
	<script>
		 function login_police(e){
            e.preventDefault();
            var email = $('#email').val();   
            var pass = $('#pass').val();
            $.ajax({
                    url: "php/logincheck.php",
                    type: "POST",
                    data: {
                        email: email,
                        pass: pass
                    },
                    success: function(dataResult){
                        if (dataResult == "1") {
                            window.location.replace("dashbord.php");
                        } else{
                            $("#error").show();
                            $('#error').html(dataResult);
                        }
                    }
                });
        }
	</script>
</body>
</html>