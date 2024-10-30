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
  <link rel="stylesheet" href="./css/signup.css">
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
            <h2>Create your account</h2>
        </div>
        <div class="container1">
            <label style="margin-top: 0;margin-bottom: 1rem;margin-left:20px"> <storng>All fields marked with <span class="require">*</span> are mandatory </storng> </label>
            <div class="row">
                <div class="col-sm-4">
                    <label for="first-name">First Name</label><span class="require">*</span>
                    <input type="text" name="first-name" id="first_name">
                    <small><span class="Error fname_err">* It Is reqired</span></small>
                </div>
                <div class="col-sm-4">
                    <label for="middle-name">Middle Name</label>
                    <input type="text" name="middle-name" id="middle_name">
                    <small><span class="Error mname_err">* It Is reqired</span></small>
                </div>
                <div class="col-sm-4">
                    <label for="last-name">Last Name</label><span class="require">*</span>
                    <input type="text" name="last-name" id="last_name">
                    <small><span class="Error lname_err">* It Is reqired</span></small>
                </div>
            </div>

            <div class="row">
                
                <div class="col-sm-4">
                    <label for="mobail-no"> Mobile No</label><span class="require">*</span>
                    <input type="text" name="mobail-no" id="contact">
                    <small><span class="Error phone_err">* It Is reqired</span></small>
                </div>

                <div class="col-md-4">
                    <label for="email">Email Address</label><span class="require">*</span>
                    <input type="email" name="email" id="email">
                    <small><span class="Error email_err">* It Is reqired</span></small>
                </div>

                <div class="col-sm-4">
                    <div class="col-sm-12 d-inline-flex">
                        <input type="button" id="send_otp_btn" class="btn btn-sm btn-secondary" style="margin:25px 2px;" value="Send OTP" onclick="send_otp()">
                        <input type="text" style="margin:25px 2px;" id="user_otp" name="otp">
                        
                    </div>
                    <p id="resend_otp" style="display:none;"> Resend OTP in <span id="countdowntimer" >60 </span> Seconds</p>
                    <input type="button" id="resend_otp_btn" class="btn btn-sm btn-secondary" style="display:none;" value="Resend OTP" onclick="resend_otp()">
                    <small><span class="Error otp_err">* It Is reqired</span></small>
                </div>

            </div>
            
            <div class="row">
                <div class="form-check col-sm-4">
                    <label for="gender"> Gender</label><span class="require">*</span><br>
                    <input class="form-check-label" type="radio" value="Male" name="gender">&nbsp; Male &nbsp;&nbsp;&nbsp;
                    <input class="form-check-label" type="radio" value="Female" name="gender">&nbsp; Female
                    <small><span class="Error gender_err">* It Is reqired</span></small>
                </div>
                <div class="col-md-4">
                    <label for="dob"  class="dob">Date Of Birth</label><span class="require">*</span>
                    <input  id="dob" type="date" id="dob" onkeydown="return false"> 
                </div>
                <div class="col-md-4">
                   <label for="aadhar">Aadhar No</label><span class="require">*</span>
                   <input  id="aadhar" type="text" id="aadhar" placeholder="e.g. 0000 0000 0000">
                   <small><span class="Error aadhar_err">* It Is reqired</span></small>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="address">Address</label><span class="require">*</span>
                    <!-- <input  id="address" type="text" id="address"> -->
                    <textarea name="" id="address" cols="80" rows="5"></textarea>
                    <small><span class="Error address_err">* It Is reqired</span></small>
                </div>
            </div>

            <div class="row">   
                <div class="col-md-4">
                    <label for="country"  class="country">Country</label><span class="require">*</span>
                    <select id="country" name="country" id="country">
                        <option value="-1">--Select--</option>
                        <?php
                            $sql = "SELECT * FROM countries";
                            $result =$conn->query($sql);
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                    <option value="<?php echo $row['country_id'];?>"><?php echo $row['country_name'];?></option>
                                    <?php
                                }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="state"  class="state">State</label><span class="require">*</span>
                    <select  id="state" name="state" id="state">
                        <option value="-1" selected>--Select--</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="city"  class="city">City</label><span class="require">*</span>
                    <select  id="city" name="city" id="city">
                        <option value="-1" selected>--Select--</option>
                    </select>                
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="password">Password</label><span class="require">*</span>
                    <input type="password" name="password" id="pass">
                    
                    <span id="tooltiptext" class="tooltiptext">
                        <ol>
                            <li>password must be 8-16 charaters.</li>
                            <li>one special (!@#$%^&*) charaters.</li>
                            <li>one uppercase,lowercase and digit.</li>
                        </ol>
                    </span>
                    <small><span class="Error pass_err">* It Is reqired</span></small>
                    
                </div>
                <div class="col-md-4">
                    <label for="confirem-password">Confirm Password</label><span class="require">*</span>
                    <input type="password" name="confirem-password" onpaste="return false" id="con_pass">
                    <small><span class="Error con_pass_err">* It Is reqired</span></small>
                </div>
                <div class="col-md-4">
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
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <u><strong>User Agreement</strong></u>
                    <br><br>
                    <input type="checkbox"  name="term-condition" id="term-condition"> I have read, understood and agreed to the <a href="https://gujhome.gujarat.gov.in/portal/webHP?requestType=ApplicationRH&actionVal=regTermsAndConditions&screenId=1111&_csrf=a96a24ab-04e7-412b-ba2a-68736691e880" target="_blank">Terms & Conditions</a><span class="require">*</span>
                </div>
            </div>
            <div class="row">
                <div class="buttons">
                    <input type="button" class="mx-2 btn btn-sm btn-secondary" onclick="signUp(event)" value="Complete Registration">
                    <input type="button" class="mx-2 btn btn-sm btn-secondary" value="Reset" onclick="reload()">
                </div>
            </div>
        </div>
        
    </form>
    
</body>

    <?php require 'signin.php'?>
    <?php require './includes/footer.php'?>

    <script src="./js/jquery.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    
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


        let password = document.getElementById("pass");
        let passwordStrength = document.getElementById("password-strength");
        let otp = Math.floor(100000 + Math.random() * 900000);
     
        function startSpinner(){
            $(".loader").css("display", "none");
        }  
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
        $(document).ready(function(){

            $(".week").hide();
            $(".good").hide();
            $(".strong").hide();

            $("#pass").focus(function(){
                $("#tooltiptext").css("visibility","visible");
            });

            $("#pass").blur(function(){
                $("#tooltiptext").css("visibility","hidden");
            });

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
                }
                
            });

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
            });


            $("#first_name").keyup(function() {check_fname();});
            $("#middle_name").keyup(function() {check_mname();});
            $("#last_name").keyup(function() {check_lname();});
            $("#contact").keyup(function() {check_phone();});
            $("#email").keyup(function() {check_email();});
            $("#aadhar").keyup(function() {check_aadhar();});
            $("#address").keyup(function() {check_address();});
            $("#con_pass").keyup(function() {check_con_pass();});



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

        function check_fname(){

            var first_name = document.getElementById("first_name").value;
            var name_pattern = /^[A-Za-z\-]+$/;

            if(!first_name.match(name_pattern)){
                $(".fname_err").show();
                $(".fname_err").html("* Invalid First Name");
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

            var middle_name = document.getElementById("middle_name").value;
            var name_pattern = /^[A-Za-z\-]+$/;

            if(!middle_name.match(name_pattern)){
                $(".mname_err").show();
                $(".mname_err").html("* Invalid Middle Name");
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

            var last_name = document.getElementById("last_name").value;
            var name_pattern = /^[A-Za-z\-]+$/;

            if(!last_name.match(name_pattern)){
                $(".lname_err").show();
                $(".lname_err").html("* Invalid Last Name");
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

            var contact = document.getElementById("contact").value;
            var phno_pattern = /^\d{10}$/;

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

            var email = (document.getElementById("email").value).toLowerCase();
            var email_pattern=/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;


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
        function check_aadhar(){

            var aadhar = document.getElementById("aadhar").value;
            var aadhar_pattern = /^[2-9]{1}[0-9]{3}\s[0-9]{4}\s[0-9]{4}$/;

            if(!aadhar.match(aadhar_pattern)){
                $(".aadhar_err").show();
                $(".aadhar_err").html("* Please Enter Proper Aadhar No");
                return false;
            }else{
                $(".aadhar_err").html("");
                $(".aadhar_err").hide();
                return true;
            }
        }
        function check_address(){

            var address = (document.getElementById("address").value).replace(/ {2,}/g,' ');
            var address_pattern = /[a-zA-Z0-9\s]+?/;

            if(address==" "){
                $(".address_err").show();
                $(".address_err").html("* Please Enter Proper Address");
            }
            else if(!address.match(address_pattern)){
                $(".address_err").show();
                $(".address_err").html("* Please Enter Proper Address");
                return false;
            }else{
                $(".address_err").hide();
                $(".address_err").html("");
                return true;
            }
        }
        function check_con_pass(){

            var pass = document.getElementById("pass").value;
            var con_pass = document.getElementById("con_pass").value;

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
        
        function signUp(e){

            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-middle',
                backround: 'green',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true, 
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            e.preventDefault();

            var first_name = document.getElementById("first_name").value;
            var middle_name = document.getElementById("middle_name").value;
            var last_name = document.getElementById("last_name").value;
            var email = (document.getElementById("email").value).toLowerCase();
            var user_otp = document.getElementById("user_otp").value;
            var contact = document.getElementById("contact").value;
            
            if($("input[type='radio'][name='gender']:checked").val()==undefined){
                var gender = "-1";
            }else{
                var gender=$("input[type='radio'][name='gender']:checked").val();
            }
            // var gender = $("input[type='radio'][name='gender']:checked").val();
            var dob = document.getElementById("dob").value;
            var aadhar = document.getElementById("aadhar").value;
            var address = (document.getElementById("address").value).replace(/ {2,}/g,' ');
            var country = document.getElementById("country").value;
            var state = document.getElementById("state").value;
            var city = document.getElementById("city").value;
            var pass = document.getElementById("pass").value;
            var con_pass = document.getElementById("con_pass").value;
            var term_condition = document.getElementById("term-condition").checked;

            var name_pattern = /^[A-Za-z\-]+$/;
            var address_pattern = /[a-zA-Z0-9\s]+?/;
            var phno_pattern = /^\d{10}$/;
            var email_pattern=/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;
            var pass_pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/;
            var aadhar_pattern = /^[2-9]{1}[0-9]{3}\s[0-9]{4}\s[0-9]{4}$/;
            
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

            if(first_name!="" && middle_name!="" && last_name!="" && contact!="" && email!="" && aadhar!="" && address!=""  && country!="-1" && state!="-1" && city!="-1" && pass!="" && con_pass!=""){
                check_fname();
                check_mname();
                check_lname();
                check_phone();
                check_email();
                check_gender();
                check_aadhar();
                check_address();
                check_pass();
                check_con_pass();

                if(term_condition!=true){
                    Swal.fire({
                        icon: "error",
                        title: "Error In Terms & Condition",
                        text: "Please Accept Terms & Conditions"
                    });
                }else{
                    if(check_fname() && check_mname() && check_lname() && check_phone() && check_email() && check_gender() && check_aadhar() && check_address() && check_pass() && check_con_pass() && check_otp()){
                
                        $(".loader").show();
                        $.ajax({
                            url: "./php/registration.php",
                            type: "post",
                            data: {
                                first_name:first_name,
                                middle_name:middle_name,
                                last_name:last_name,
                                email:email,
                                contact:contact,
                                gender:gender,
                                dob:dob,
                                aadhar:aadhar,
                                address:address,
                                city:city,
                                pass:pass
                            },
                            success: function(response) {
                                $(".loader").hide();
                                if(response==1){
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error In Email",
                                        text: "Email Is Alredy Exiest."
                                    });
                                    console.log(response);
                                }else if(response==2){
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error In Contact No",
                                        text: "Contact No Is Alredy Exiest."
                                    });
                                }
                                else if(response==3){
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error In Aadhar No",
                                        text: "Aadhar No Is Alredy Exiest."
                                    });
                                }else if(response == 0){
                                    Swal.fire({
                                        icon: "success",
                                        title: "Registrarion Successfully",
                                        text: "Please Sign In"

                                    }).then((result) => {
                                        window.location.href = 'index.php#open-modal';
                                    })
                                }
                                else{
                                    console.log(response);
                                }
                            }
                        });     
                        
                    }else{

                    }
                }
            }else{
                Toast.fire({    
                    icon: 'error',
                    title: 'All fileds are required'
                }) 
            }
        }
        function reload(){
            location.reload();
        }
    
    </script>

</html>