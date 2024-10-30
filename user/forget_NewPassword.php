<?php
    if(!isset($_GET['email'])){
        header('Location:index.php');
    }
    $email = $_GET['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BharatSuraksha</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/forget_NewPassword.css">
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
        <div class="container1">
            <label style="margin-top: 0;margin-bottom: 1rem;margin-left:20px"> <storng>All fields marked with <span class="require">*</span> are mandatory </storng> </label>
            <div class="row">
                <div class="col-md-5">

                    <label for="password">Password</label><span class="require">*</span>
                    <input type="password" name="password" id="pass">
                    <small><span class="Error pass_err">* It Is reqired</span></small><br>
                    
                    <label for="confirem-password">Confirm Password</label><span class="require">*</span>
                    <input type="password" name="confirem-password" onpaste="return false" id="con_pass">
                    <small><span class="Error con_pass_err">* It Is reqired</span></small><br>

                    <input type="checkbox"id="showPass" style="margin-top:35px"> Show Characters 
                    <div class="progress" style="margin-top:10px">
                        <div id="password-strength" 
                            class="progress-bar" 
                            role="progressbar" 
                            aria-valuenow="40" 
                            aria-valuemin="0" 
                            aria-valuemax="100" 
                            style="width:0%">
                        </div>
                    </div>
                    <div class="password-msg">
                        <span class="week">Week</span>
                        <span class="good">Good</span>
                        <span class="strong">Strong</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <hr>
                </div>
                <div class="col-md-5">
                    <div class="container toolBox">
                        <h5>Password Hint</h5>
                        <ul>
                               <li>password must be 8-16 charaters.</li>
                               <li>one special (!@#$%^&*) charaters.</li>
                               <li>one uppercase charaters.</li>
                               <li>one lowercase charaters.</li>
                               <li>one digit charaters.</li>
                       </ul>
                    </div>
                </div>  
            </div>

            <div class="row">
                <div class="buttons">
                    <input type="button" class="btn_sub mx-2 btn btn-sm btn-secondary" onclick="submit1()" value="Submit">
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
  <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
 
  
<script>
    let password = document.getElementById("pass");
    let passwordStrength = document.getElementById("password-strength");
      
    function startSpinner(){
        $(".loader").css("display", "none");
    }
    function back(){
        window.location.href = 'forget_pass.php';
    }
    $(document).ready(function(){

        $(".week").hide();
        $(".good").hide();
        $(".strong").hide();

        $('#showPass').on('click', function(){
            var pass=$("#pass");
            if(pass.attr('type')==='password')
            {
                pass.attr('type','text');
            }else{
                pass.attr('type','password');
            }
            var con_pass=$("#con_pass");
            if(con_pass.attr('type')==='password')
            {
                con_pass.attr('type','text');
            }else{
                con_pass.attr('type','password');
            }
        })
    });
    password.addEventListener("keyup", function(){
        let password = document.getElementById("pass").value;
        checkStrength(password);
    });
    function checkStrength(password) {

      let strength = 0;
      
      //If password contains both lower and uppercase characters
      if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
          strength += 1;
        } 
        //If it has numbers and characters
        if (password.match(/([0-9])/)) {
            strength += 1;
        } 
        //If it has one special character
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
            strength += 1;
        }
        //If password is greater than 7
        if (password.length > 7) {
            strength += 1;   
        }
        
        // If value is less than 2
        if (strength < 2) {
            passwordStrength.classList.remove('progress-bar-warning');
            passwordStrength.classList.remove('progress-bar-success');
            passwordStrength.classList.add('progress-bar-danger');
            passwordStrength.style = 'width: 10%';
            
            $(".week").show();
            $(".good").hide();
            $(".strong").hide();                    
            
        } else if (strength == 3) {
            passwordStrength.classList.remove('progress-bar-success');
            passwordStrength.classList.remove('progress-bar-danger');
            passwordStrength.classList.add('progress-bar-warning');
            passwordStrength.style = 'width: 60%';
            $(".week").hide();
            $(".good").show();
            $(".strong").hide();
        } else if (strength == 4) {
            passwordStrength.classList.remove('progress-bar-warning');
            passwordStrength.classList.remove('progress-bar-danger');
            passwordStrength.classList.add('progress-bar-success');
            passwordStrength.style = 'width: 100%';
            $(".week").hide();
            $(".good").hide();
            $(".strong").show();
        }
    }

    const urlParams = new URLSearchParams(window.location.search);
    const myParam = String(urlParams.get('email'));
    var decripted_email = window.atob(myParam);
    // console.log(decripted_email);

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