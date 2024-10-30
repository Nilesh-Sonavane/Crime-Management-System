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
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
        <link rel="stylesheet" href="./css/all.css">
        <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">
        <link rel="stylesheet" href="./CSS/signup.css">
        <link rel="stylesheet" href="./CSS/style.css">
        <?php require './includes/font.php'?>

        <title>Police (Sign Up)</title>
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
       
        <section class="signup">
            <div class="container signup_box">
                <div class="contact-box">
                    <form method="POST" autocomplete="off">
                        <h3>POLICE REGISTRATION</h3>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <label for="first_name" style="color:#7d7878" class="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name"> 
                                <small><span class="Error fname_err"></span></small>
                            </div>
                            <div class="col-md-4">
                                <label for="middle_name" style="color:#7d7878" class="middle_name">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name">
                                <small><span class="Error mname_err"></span></small> 
                            </div>
                            <div class="col-md-4">
                                <label for="last_name" style="color:#7d7878" class="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name"> 
                                <small><span class="Error lname_err"></span></small>
                            </div>
                        </div>
                            
                        <div class="row">
                            
                            <div class="col-md-4">
                                <label for="contact" style="color:#7d7878" class="contact">Contact</label>
                                <input type="text" class="form-control" name="contact" id="contact"> 
                                <small><span class="Error phone_err"></span></small>
                            </div>
                            <div class="col-md-4">
                                <label for="email" style="color:#7d7878" class="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email"> 
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
                                <input class="form-control" id="dob" type="date" onkeydown="return false">
                                <small><span class="Error dob_err"></span></small>
                            </div>
                            <div class="col-md-4">
                                <label for="address" style="color:#7d7878" class="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address"> 
                                <small><span class="Error address_err"></span></small> 
                            </div>
                            <div class="col-md-4">
                                <label for="rank" style="color:#7d7878" class="rank">Rank</label>
                                <select class="form-control form-select" id="rank" name="rank">
                                    <option value="-1" selected>-- Select --</option>
                                    <?php
                                        $sql = "SELECT * FROM police_ranks";
                                        $result =$conn->query($sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <option value="<?php echo $row['rank_id'];?>"><?php echo $row['rank_name'];?></option>
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
                                                    <option value="<?php echo $row['country_id'];?>"><?php echo $row['country_name'];?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>  
                            </div>
                            <div class="col-md-4">
                                <label for="state" style="color:#7d7878" class="state">State</label>
                                <select class="form-control form-select" id="state" name="state">
                                    <option value="-1" selected>--Select--</option>
                                </select>     
                            </div>
                            <div class="col-md-4">
                                <label for="city" style="color:#7d7878" class="city">City</label>
                                <select class="form-control form-select" id="city" name="city">
                                    <option value="-1" selected>--Select--</option>
                                </select> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="police_station" style="color:#7d7878" class="police_station">Police Station</label>
                                <select class="form-control form-select" id="police_station" name="police_station">
                                    <option  value="1" selected>-- Select --</option>
                                </select>
                            </div>
                            <div class="col-md-4 ">
                                <label for="pass" style="color:#7d7878" >Password</label>
                                <input type="password" class="form-control pass" name="pass" id="pass">
                                <span id="tooltiptext" class="tooltiptext">
                                    <ol>
                                        <li>password must be 8-16 charaters.</li>
                                        <li>one special (!@#$%^&*) charaters.</li>
                                        <li>one uppercase,lowercase and digit.</li>
                                    </ol>
                                </span>
                                <small><span class="Error pass_err"></span></small> 
                            </div>
                            
                            <div class="col-md-4">  
                                <label for="con_pass-pass" style="color:#7d7878" class="con_pass">Confirem Password</label>
                                <input type="password" class="form-control" name="con_pass" onpaste="return false" id="con_pass"> 
                                <small><span class="Error con_pass_err"></span></small> 
                            </div>
                        </div>

                        </div>

                        <div class="row">
                            <button type="button" class="submit" name="signup" onclick="signUp(event)" >Sign Up</button>
                        </div>
                        <div class="row">
                            <p style="margin:auto;">Alredy have an account? <a href="index.php">Sign in</a></p>
                        </div>
                    
                    </form>
                </div>
            </div>
        </section>
        <!-- <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> -->
        <script src="./js/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script>

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
            // **************** end *********

            let otp = Math.floor(100000 + Math.random() * 900000);
            // let otp = 0;


            $(document).ready(function(){

                $(".Error").hide();
                

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

                $("#pass").focus(function(){
                    $("#tooltiptext").css("visibility","visible");
                })
                $("#pass").blur(function(){
                    $("#tooltiptext").css("visibility","hidden");
                })
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
            function signUp(e){

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

                    var first_name = document.getElementById("first_name").value;
                    var middle_name = document.getElementById("middle_name").value;
                    var last_name = document.getElementById("last_name").value;
                    var dob = document.getElementById("dob").value;
                    var contact = document.getElementById("contact").value;
                    var email = (document.getElementById("email").value).toLowerCase();
                    var user_otp = document.getElementById("user_otp").value;
                    var pass = document.getElementById("pass").value;
                    var con_pass = document.getElementById("con_pass").value;
                    var address = (document.getElementById("address").value).replace(/ {2,}/g,' ');
                    var country = document.getElementById("country").value;
                    var state = document.getElementById("state").value;
                    var city = document.getElementById("city").value;
                    var rank = document.getElementById("rank").value;
                    var police_station = document.getElementById("police_station").value;

                    var name_pattern = /^[A-Za-z\-]+$/;
                    var address_pattern = /[a-zA-Z0-9\s]+?/;
                    var phno_pattern = /^\d{10}$/;
                    var email_pattern=/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;
                    var pass_pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/;

                    

                    function check_fname(){
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
                    function check_address(){
                        if(address==" "){
                            $(".address_err").show();
                            $(".address_err").html("* Please Enter Proper Address");
                            return false;
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

                    if(first_name!="" && middle_name!="" && last_name!="" && dob!="" && contact!="" && email!="" && pass!="" && con_pass!="" && address!="" && country!="-1" && state!="-1" &&city!="-1" && rank!="-1" &&  police_station!="-1"){

                        check_fname();
                        check_mname();
                        check_lname();
                        check_phone();
                        check_email();
                        check_pass();
                        check_con_pass();
                        check_address();


                    if(check_fname() && check_mname() && check_lname() && check_phone() && check_email() && check_pass() && check_con_pass() && check_address() && check_otp()){
                        $(".loader").show();
                        $.ajax({
                            url: "./php/registration.php",
                            type: "post",
                            data: {
                                first_name:first_name,
                                middle_name:middle_name,
                                last_name:last_name,
                                dob:dob,
                                contact:contact,
                                email:email,
                                pass:pass,
                                address:address,
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
                                        title: "Registrarion Successfully",
                                        text: "Please Sign In"
                                    }).then((result) => {
                                        window.location.href = 'index.php';
                                    })
                                }
                                else{
                                    console.log(response);
                                }
                            }
                        });     
                    }
                }
                else{
                    Toast.fire({    
                        icon: 'error',
                        title: 'All fileds are required'
                    }) 
                }
                
                
            }

        </script>
    </body>
</html>