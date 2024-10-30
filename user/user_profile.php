<?php
  include_once './php/database.php';
  if(!isset($_SESSION['uid'])){
      header('Location:index.php');
    }
  
    $user_id = $_SESSION['uid'];
    $sql = "SELECT * FROM user WHERE user_id=$user_id";
    $result =$conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    
    $img_url = $row['img_url'];
    $fname = $row['fname'];
    $fname = $row['fname'];
    $mname = $row['mname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $contact = $row['contact'];
    $gender = $row['gender'];
    $dob = $row['dob'];
    $aadhar_no = $row['aadhar_no'];
    $address = $row['address'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BharatSuraksha</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/usre_profile.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body onload="startSpinner()">  

    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>

  <?php require './includes/header.php'?>
  <?php require 'signin.php'?>


    <div class="profilepage-container">

        <div class="box-header" style="background-color: #281859;height:40px; margin-bottom:20px;padding:5px">
            <strong style="color: white;margin: auto;font-size: 20px;">Profile</strong>
            <strong style="color: white;">
                <i class="fa-solid fa-pen-to-square" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" onclick="edit_profile()"></i>
                <i class="fa-solid fa-floppy-disk" data-bs-toggle="tooltip" data-bs-placement="top" title="Save" onclick="save_profile()"></i>
                <i class="fas fa-times-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Close" onclick="cancle_save()"></i>
            </strong>
        </div>
        <form id="userInfoForm" method="POST" enctype="multipart/form-data">
        <div class="row">   
            <div class="col-sm-3 pic">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' id="imageUpload" name="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview" style="background-image: url(../uploads/<?php echo $img_url;?>);">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 data">
                
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="first-name">First Name</label><span class="require">*</span>
                            <input type="text" name="first-name" id="first_name" value="<?php echo $fname?>">
                            <small><span class="Error fname_err">* It Is reqired</span></small>
                        </div>
                        <div class="col-sm-4">
                            <label for="middle-name">Middle Name</label><span class="require">*</span>
                            <input type="text" name="middle-name" id="middle_name" value="<?php echo $mname?>">
                            <small><span class="Error mname_err">* It Is reqired</span></small>
                        </div>
                        <div class="col-sm-4">
                            <label for="last-name">Last Name</label><span class="require">*</span>
                            <input type="text" name="last-name" id="last_name" value="<?php echo $lname?>">
                            <small><span class="Error lname_err">* It Is reqired</span></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="mobail-no"> Mobile No</label><span class="require">*</span>
                            <input type="text" name="mobail-no" id="contact" value="<?php echo $contact?>">
                            <small><span class="Error phone_err">* It Is reqired</span></small>
                        </div>
                        <div class="col-md-4">
                            <label for="email">Email Address</label><span class="require">*</span>
                            <input type="email" name="email" id="gmail" value="<?php echo $email?>">
                            <small><span class="Error email_err">* It Is reqired</span></small>
                        </div>

                        <div class="form-check col-sm-4">
                            <label for="otp">Get OTP</label><span class="require">*</span>
                            <div class="col-sm-12 d-inline-flex">
                                <input type="button" id="send_otp_btn" class="btn btn-sm btn-secondary" style="margin:25px 10px;"  value="Send OTP" onclick="send_otp()">
                                <input type="text" id="user_otp" style="margin:25px 10px;" name="otp">
                            </div>
                            <p id="resend_otp" style="display:none;"> Resend OTP in <span id="countdowntimer" >60 </span> Seconds</p>
                            <input type="button" id="resend_otp_btn" class="btn btn-sm btn-secondary" style="display:none;" value="Resend OTP" onclick="resend_otp()">
                            <small><span class="Error otp_err">* It Is reqired</span></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="dob"  class="dob">Date Of Birth</label><span class="require">*</span><br>
                            <input  id="dob" type="date" name="dob" value="<?php echo $dob?>"> 
                        </div>
                        <div class="col-md-4">
                            <label for="aadhar">Aadhar No</label><span class="require">*</span>
                            <input  id="aadhar" type="text" id="aadhar" name="aadhar" placeholder="e.g. 0000 0000 0000" value="<?php echo $aadhar_no ?>">
                            <small><span class="Error aadhar_err">* It Is reqired</span></small>
                        </div>
                        <div class="col-md-4">
                            <label for="address">Address</label><span class="require">*</span>
                            <input  id="address" type="text" id="address" name="address" value="<?php echo $address?>">
                            <small><span class="Error address_err">* It Is reqired</span></small>
                        </div>
                            
                    </div>
                </form>
            </div>
    
        </div>
</form>
    </div>

 <?php require './includes/footer.php'?>   

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
 
     let otp = Math.floor(100000 + Math.random() * 900000);
     // let otp = 0;
     $(document).ready(function(){
         $("#first_name").keyup(function() {check_fname();});
         $("#middle_name").keyup(function() {check_mname();});
         $("#last_name").keyup(function() {check_lname();});
         $("#contact").keyup(function() {check_phone();});
         $("#gmail").keyup(function() {check_email();});
         $("#aadhar").keyup(function() {check_aadhar();});
         $("#address").keyup(function() {check_address();});
     });
     
     function startSpinner(){
         $(".loader").css("display", "none");
     }  
     
     function readURL(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();
             reader.onload = function(e) {
                 $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                 $('#imagePreview').hide();
                 $('#imagePreview').fadeIn(650);
             }
             reader.readAsDataURL(input.files[0]);
         }
     }
     $("#imageUpload").change(function() {
         readURL(this);
     });
     
     $('.fa-floppy-disk').hide();
     $('.avatar-edit').hide();
     $('.fa-times-circle').hide();
     
     $("#first_name").prop("disabled", true);
     $("#middle_name").prop("disabled", true);
     $("#last_name").prop("disabled", true);
     $("#gmail").prop("disabled", true);
     $("#send_otp_btn").prop("disabled", true);
     $("#user_otp").prop("disabled", true);  
     $("#contact").prop("disabled", true);
     $("#dob").prop("disabled", true);
     $("#aadhar").prop("disabled", true);
     $("#address").prop("disabled", true);
     
     
     
     function edit_profile(){
         
         $('.fa-pen-to-square').hide();
         $('.fa-floppy-disk').show();
         $('.fa-times-circle').show();
         
         
         $('.avatar-edit').show();
         
         $("#first_name").prop("disabled", false);
         $("#middle_name").prop("disabled", false);
         $("#last_name").prop("disabled", false);
         $("#gmail").prop("disabled", false);
         $("#send_otp_btn").prop("disabled", false);
         $("#user_otp").prop("disabled", false);  
         $("#contact").prop("disabled", false);
         $("#dob").prop("disabled", false);
         $("#aadhar").prop("disabled", false);
         $("#address").prop("disabled", false);
         
     }
     function send_otp(){
         var email = document.getElementById("gmail").value;
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
     
     function check_fname(){
         
         var first_name = $('#first_name').val().trim();
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
         
         var middle_name = $('#middle_name').val().trim();
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
 
         var last_name = $('#last_name').val().trim();
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
 
         var contact = $('#contact').val().trim();
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
 
         var email = ($('#gmail').val().trim()).toLowerCase();
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
 
         var aadhar = $('#aadhar').val().trim();
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
 
         var address = ($('#address').val().trim()).replace(/ {2,}/g,' ');
         var address_pattern = /[a-zA-Z0-9\s]+?/;
 
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
     
     function save_profile(){
         
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
 
         var first_name = $('#first_name').val().trim();
         var middle_name = $('#middle_name').val().trim();
         var last_name = $('#last_name').val().trim();
         var email = ($('#gmail').val().trim()).toLowerCase();
         var user_otp = $('#user_otp').val().trim();
         var contact = $('#contact').val().trim();
         var dob = $("#dob").val().trim();
         var aadhar = $('#aadhar').val().trim();
         var address = ($('#address').val().trim()).replace(/ {2,}/g,' ');
         var fd = document.getElementById("imageUpload").files[0];
 
     
         var name_pattern = /^[A-Za-z\-]+$/;
         var address_pattern = /[a-zA-Z0-9\s]+?/;
         var phno_pattern = /^\d{10}$/;
         var email_pattern=/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;
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
        
         
 
         if(first_name!="" && middle_name!="" && last_name!="" && contact!="" && email!="" && dob!="" && aadhar!="" && address!="" ){
 
             check_fname();
             check_mname();
             check_lname();
             check_phone();
             check_email();
             check_aadhar();
             check_address();
 
             if(check_fname() && check_mname() && check_lname() && check_phone() && check_email()  && check_aadhar() && check_address() && check_otp()){
 
                 var frm = document.getElementById("userInfoForm");
                 var formData = new FormData(frm);
 
                 if(fd != null){
                     
                     var imgtype = fd.name.split(".").pop().toLowerCase();
 
                     if (jQuery.inArray(imgtype, ["png", "jpg", "jpeg"]) == -1) {
                         Swal.fire({
                             icon: "error",
                             title: "Error In Image",
                             text: "Invalid File Formate!Plz Select Image File"
                         });
                     }else if (fd.size > 2000000) {
                         Swal.fire({
                             icon: "error",
                             title: "Error In Image",
                             text: "Image size is Large!Plz Select Image Below 2 MB"
                         });
                     }else{
                         $(".loader").show();
                         $.ajax({
                             url: "./php/saveProfile.php?saveUser=1",
                             type: "post",
                             data: formData,
                             contentType: false,
                             cache: false,
                             processData: false,
                             success: function(response) {
                                 if(response==1){
                                     $(".loader").hide();
                                     Swal.fire({
                                         icon: "error",
                                         title: "Error In Email",
                                         text: "Email Is Alredy Exiest."
                                     });
                                     console.log(response);
                                 }else if(response==2){
                                     $(".loader").hide();
                                     Swal.fire({
                                         icon: "error",
                                         title: "Error In Contact No",
                                         text: "Contact No Is Alredy Exiest."
                                     });
                                 }
                                 else if(response==3){
                                     $(".loader").hide();
                                     Swal.fire({
                                         icon: "error",
                                         title: "Error In Aadhar No",
                                         text: "Aadhar No Is Alredy Exiest."
                                     });
                                 }else if(response == 0){
                                     $(".loader").hide();
                                     Swal.fire({
                                         icon: "success",
                                         title: "Update Successfully",
                                         
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
                     $(".loader").show();
                     $.ajax({
                             url: "./php/saveProfile.php?saveUser=1",
                             type: "post",
                             data: formData,
                             contentType: false,
                             cache: false,
                             processData: false,
                             success: function(response) {
                                 $(".loader").hide();
                                 if(response==1){
                                     Swal.fire({
                                         icon: "error",
                                         title: "Error In Email",
                                         text: "Email Is Alredy Exiest."
                                     });
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
                                         title: "Update Successfully",
 
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
 
         }else{
             Toast.fire({    
                 icon: 'error',
                 title: 'All fileds are required'
             }) 
         }
     }
 
     function cancle_save(){
         
         $('.fa-pen-to-square').show();
         $('.fa-floppy-disk').hide();
         $('.fa-times-circle').hide();
         
         $('.avatar-edit').hide();
         $("#send_otp_btn").show();
         $("#resend_otp_btn").hide();
         $("#resend_otp").hide();
 
         $("#first_name").prop("disabled", true);
         $("#middle_name").prop("disabled", true);
         $("#last_name").prop("disabled", true);
         $("#gmail").prop("disabled", true);
         $("#send_otp_btn").prop("disabled", true);
         $("#user_otp").prop("disabled", true);  
         $("#contact").prop("disabled", true);
         $("#dob").prop("disabled", true);
         $("#aadhar").prop("disabled", true);
         $("#address").prop("disabled", true);
 
     }
 
 </script>
</body>
</html>