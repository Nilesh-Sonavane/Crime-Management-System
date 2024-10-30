<?php
    include_once './php/database.php';
    if(!isset($_SESSION['uid'])){
        header('Location:index.php');
      }


    $uid = $_SESSION['uid'];
?>



    <?php
    $sql = "SELECT * FROM user WHERE user_id=$uid";
    $result =$conn->query($sql); 
    $row = mysqli_fetch_assoc($result);

    $fname = $row['fname'];
    $mname = $row['mname'];
    $lname = $row['lname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BharatSuraksha (eFIR)</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/mobile_fir.css">
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
    <div>
        <form id="firForm" method="POST" enctype="multipart/form-data">

            <div class="page-title">
                <h2>Mobile eFIR</h2>
            </div>
            <div class="container1">
                <label style="margin-top: 0;margin-bottom: 1rem;margin-left:20px"> <storng>All fields marked with <span class="require">*</span> are mandatory </storng> </label>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="first-name">First Name</label><span class="require">*</span>
                        <input type="text" name="first-name" value="<?php echo $fname; ?>" id="first_name" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="middle-name">Middle Name</label>
                        <input type="text" name="middle-name" value="<?php echo $mname; ?>" id="middle_name" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="last-name">Last Name</label><span class="require">*</span>
                        <input type="text" name="last-name" value="<?php echo $lname; ?>" id="last_name" readonly>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-4">
                        <label for="IMEI_no"  class="IMEI_no">IMEI No</label><span class="require">*</span>
                        <input  id="IMEI_no" type="text" name="IMEI_no" id="IMEI_no">
                        <small><span class="Error IMEI_err">* It Is reqired</span></small>
                    </div>
                    <div class="col-sm-4">
                        <label for="brand"  class="brand">Brand</label><span class="require">*</span>
                        <input  id="brand" type="text" name="brand" id="brand">
                        <small><span class="Error brand_err">* It Is reqired</span></small>
                    </div>
                    <div class="col-md-4">
                        <label for="model"  class="model">Model</label><span class="require">*</span>
                        <input  id="model" type="text" name="model" id="model">
                        <small><span class="Error model_err">* It Is reqired</span></small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="color"  class="color">Color</label><span class="require">*</span>
                        <input  id="color" type="text" name="color" id="color">
                        <small><span class="Error color_err">* It Is reqired</span></small>
                    </div>
                    <div class="col-md-4">
                        <label for="location_of_theft">Location Of Theft</label><span class="require">*</span>
                        <input  id="location_of_theft" type="text" name="location_of_theft" id="location_of_theft">
                        <small><span class="Error location_err">* It Is reqired</span></small>

                    </div>
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
                </div>

                <div class="row">
                    
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
                    <div class="col-md-4">
                        <label for="police_station" class="police_station">Police Station</label>
                        <select  id="police_station" name="police_station">
                            <option  value="-1" selected>--Select--</option>
                        </select>  
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="date_of_theft"  class="date_of_theft">Date Of Theft</label><span class="require">*</span>
                        <input  id="date_of_theft" type="date" name="date_of_theft" id="date_of_theft" onkeydown="return false" >
                        
                    </div>
                    <div class="col-md-4">
                        <label for="time_of_theft"  class="time_of_theft">Time Of Theft</label><span class="require">*</span>
                        <input  id="time_of_theft" type="time" name="time_of_theft" id="time_of_theft">
                        <small><span class="Error time_err">* It Is reqired</span></small>
                    </div>
                    <div class="col-md-4">
                        <label for="bill" >Attach Bill</label><span class="require">*</span>
                        <input  class="bill" type="file" name="file" id="file">
                    </div>
                </div>


            

                <div class="row">
                    <div class="buttons">
                        <input type="button" class="mx-2 btn btn-sm btn-secondary" value="Complete FIR" onclick="submit_fir(event)">
                        <input type="button" class="mx-2 btn btn-sm btn-secondary" value="Reset" onclick="reset()">
                    </div>
                </div>
            </div>

        </form>
    </div>
    <?php require './includes/footer.php'?>


    <script src="./js/jquery.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>

    <script>

        // feature date and time disable 

            const today = new Date().toISOString().split('T')[0];
            document.getElementById("date_of_theft").setAttribute("max", today);
        

        // **************** end *********

        function startSpinner(){
            $(".loader").css("display", "none");
        }                         

        $(document).ready(function(){

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

            $("#IMEI_no").keyup(function() {check_IMEI();});
            $("#brand").keyup(function() {check_brand();});
            $("#model").keyup(function() {check_model();});
            $("#color").keyup(function() {check_color();});
            $("#location_of_theft").keyup(function() {check_location();});


        });

        function reset(){
            location.reload();
        }



        function check_IMEI(){

            var IMEI_no = document.getElementById("IMEI_no").value;
            var IMEI_pattern = /^[0-9]{15}(,[0-9]{15})*$/;


            if(!IMEI_no.match(IMEI_pattern)){
                $(".IMEI_err").show();
                $(".IMEI_err").html("* Please Enter Proper IMEI No");
                return false;
            }else{
                $(".IMEI_err").hide();
                $(".IMEI_err").html("");
                return true;
            }
        }
        function check_brand(){

            var brand = (document.getElementById("brand").value).replace(/ {2,}/g,' ');
            var brand_pattern = /^[A-Za-z][A-Za-zs\-&]+$/;

            if(!brand.match(brand_pattern)){
                $(".brand_err").show();
                $(".brand_err").html("* Please Enter Proper Brand");
                return false;
            }else{
                $(".brand_err").hide();
                $(".brand_err").html("");
                return true;
            }
        }
        function check_model(){

            var model = (document.getElementById("model").value).replace(/ {2,}/g,' ');
            var model_pattern=/^[A-Za-z][a-zA-Z0-9]+$/;

            if(!model.match(model_pattern)){
                $(".model_err").show();
                $(".model_err").html("* Please Enter Proper Model");
                return false;
            }else{
                $(".model_err").hide();
                $(".model_err").html("");
                return true;
            }
        }
        function check_color(){

            var color = (document.getElementById("color").value).replace(/ {2,}/g,' ');
            var string_pattern = /^[A-Za-z][A-Za-z\s\-]+$/;

            
            if(!color.match(string_pattern)){
                $(".color_err").show();
                $(".color_err").html("* Please Enter Proper Color");
                return false;
            }else{
                $(".color_err").hide();
                $(".color_err").html("");
                return true;
            }
        }
        function check_location(){

            var location_of_theft = (document.getElementById("location_of_theft").value).replace(/ {2,}/g,' ');
            var address_pattern = /[a-zA-Z0-9\s]+?/;

            if(location_of_theft==" "){
                $(".location_err").show();
                $(".location_err").html("* Please Enter Proper Location");
                return false;
            }
            else if(!location_of_theft.match(address_pattern)){
                $(".location_err").show();
                $(".location_err").html("* Please Enter Proper Location");
                return false;
            }else{
                $(".location_err").hide();
                $(".location_err").html("");
                return true;
            }
        }



        function submit_fir(e){
        
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

            var IMEI_no = document.getElementById("IMEI_no").value;
            var brand = (document.getElementById("brand").value).replace(/ {2,}/g,' ');
            var model = (document.getElementById("model").value).replace(/ {2,}/g,' ');
            var color = (document.getElementById("color").value).replace(/ {2,}/g,' ');
            var location_of_theft = (document.getElementById("location_of_theft").value).replace(/ {2,}/g,' ');
            var city = document.getElementById("city").value;
            var station = document.getElementById("police_station").value;
            var date_of_theft = document.getElementById("date_of_theft").value;
            var time_of_theft = document.getElementById("time_of_theft").value;
            var fd = document.getElementById("file").files[0];
            
           
            
            var IMEI_pattern = /^[0-9]{15}(,[0-9]{15})*$/;
            var string_pattern = /^[A-Za-z][A-Za-z\s\-]+$/;
            var brand_pattern = /^[A-Za-z][A-Za-z\s\-&]+$/;
            var model_pattern=/^[A-Za-z][a-zA-Z0-9]+$/;
            var address_pattern = /[a-zA-Z0-9\s]+?/;
            
            function check_time(){

                const Time = new Date();
                const toTime = Time.getHours()+":"+Time.getMinutes();
            
                if((today==date_of_theft) && (time_of_theft>=toTime)){
                    $(".time_err").show();
                    $(".time_err").html("*Please Enter Proper Time");
                    return false;
                }else{
                    $(".time_err").hide();
                    $(".time_err").html("");
                    return true;
                }
            } 
            
           

            if(IMEI_no!="" && brand!="" && model!=""&& color!="" && location_of_theft!="" && city!="-1" && station!="-1" && date_of_theft!="" && time_of_theft!=""){

                check_IMEI();
                check_brand();
                check_model();
                check_color();
                check_location();
                check_time();
                
                if(check_IMEI() && check_brand() && check_model() && check_color() && check_location() && check_time()){


                    if(fd != null){
                        var frm = document.getElementById("firForm");
                        
                        var user_id = <?php echo $uid;?>;
                        var crime_id = <?php echo $_GET['id'];?>;


                        var formData = new FormData(frm);
                        formData.append('user_id',user_id);
                        formData.append('crime_id',crime_id);

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
                                url: "./php/addmobileFIR.php?addFIR=1",
                                type: "post",
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(response) {
                                    $(".loader").hide();
                                    if(response == 1){
                                        Swal.fire({
                                        icon: "success",
                                        title: "FIR Submit Successfully",
                                        text :"Please Check Your Registered Email"
                                        }).then((result) => {
                                            window.location.href="index.php";
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
                            title: 'Upload Bill is Blank'
                        })      
                        
                    }
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