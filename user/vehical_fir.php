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
                <h2>Vehicle eFIR</h2>
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
                        <label for="plate_no">Plate No</label><span class="require">*</span>
                        <input  id="plate_no" type="text" name="plate_no" id="plate_no"  placeholder="e.g MH 04 ML 1806">
                        <small><span class="Error plate_err">* It Is reqired</span></small>
                    </div>
                    <div class="col-sm-4">
                        <label for="brand"  class="brand">Brand</label><span class="require">*</span>
                        <input  id="brand" type="text" name="brand" id="brand">
                        <small><span class="Error brand_err">* It Is reqired</span></small>
                    </div>
                    <div class="col-md-4">
                        <label for="model_name"  class="model">Model Name</label><span class="require">*</span>
                        <input  id="model_name" type="text" name="model_name" id="model_name">
                        <small><span class="Error model_name_err">* It Is reqired</span></small>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-4">
                        <label for="model_year"  class="model">Model Year</label><span class="require">*</span>
                        <input  id="model_year" type="text" name="model_year" id="model_year" placeholder="e.g 2019">
                        <small><span class="Error model_year_err">* It Is reqired</span></small>
                    </div>
                    <div class="col-md-4">
                        <label for="color"  class="color">Color</label><span class="require">*</span>
                        <input  id="color" type="text" name="color" id="color">
                        <small><span class="Error color_err">* It Is reqired</span></small>
                    </div>
                    <div class="col-md-4">
                        <label for="type"  class="color">Type</label><span class="require">*</span>
                        <input  id="type" type="text" name="type" id="type">
                        <small><span class="Error type_err">* It Is reqired</span></small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <label for="location_of_theft">Location Of Theft</label><span class="require">*</span>
                        <input  id="location_of_theft" type="text" name="location_of_theft" id="location_of_theft" >
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
                        <input  id="date_of_theft" type="date" name="date_of_theft" id="date_of_theft" onkeydown="return false">
                        
                    </div>
                    <div class="col-md-4">
                        <label for="time_of_theft"  class="time_of_theft">Time Of Theft</label><span class="require">*</span>
                        <input  id="time_of_theft" type="time" name="time_of_theft" id="time_of_theft">
                        <small><span class="Error time_err">* It Is reqired</span></small>
                    </div>
                    <div class="col-md-4">
                        <label for="file" >Attach RC</label><span class="require">*</span>
                        <input  class="file" type="file" name="file" id="file">
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

            $("#plate_no").keyup(function() {check_Plate_no();});
            $("#brand").keyup(function() {check_brand();});
            $("#model_name").keyup(function() {check_model_name();});
            $("#model_year").keyup(function() {check_model_year();});
            $("#color").keyup(function() {check_color();});
            $("#type").keyup(function() {check_type();});
            $("#location_of_theft").keyup(function() {check_location();});


        });

        function reset(){
            location.reload();
        }

        function check_Plate_no(){

            var plate_no = document.getElementById("plate_no").value;
            var no_pattern =/^[A-Z]{2}[ -]?[0-9]{2}[ -]?[A-Z]{1,2}[ -]?[0-9]{4}$/;

            if(!plate_no.match(no_pattern)){
                $(".plate_err").show();
                $(".plate_err").html("* Please Enter Proper Plate No");
                return false;
            }else{
                $(".plate_err").hide();
                $(".plate_err").html("");
                return true;
            }
        }
        
        function check_brand(){
            
            var brand = (document.getElementById("brand").value).replace(/ {2,}/g,' ');
            var brand_pattern = /^[A-Za-z][A-Za-z\s\-&]+$/;
            
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
        
        function check_model_name(){

            var model_name = (document.getElementById("model_name").value).replace(/ {2,}/g,' ');
            var model_name_pattern=/^[a-zA-Z][a-zA-Z0-9]+$/;

            if(!model_name.match(model_name_pattern)){
                $(".model_name_err").show();
                $(".model_name_err").html("* Please Enter Proper Model Name");
                return false;
            }else{
                $(".model_name_err").hide();
                $(".model_name_err").html("");
                return true;
            }
        }
        
        function check_model_year(){

            var model_year = (document.getElementById("model_year").value).replace(/ {2,}/g,' ');
            var model_year_pattern=/^\d{4}$/;

            var max_year = new Date().getFullYear();
            var min_year = (new Date().getFullYear())-15;

            if(!model_year.match(model_year_pattern)){
                $(".model_year_err").show();
                $(".model_year_err").html("* Please Enter Proper Model Year");
                return false;
            }else if(!(model_year <= max_year)){
                $(".model_year_err").show();
                $(".model_year_err").html("* Invalid Future year");
                return false;
            }else if(!(model_year >= min_year)){
                $(".model_year_err").show();
                $(".model_year_err").html("* Invalid More Then 15 Year Old.");
                return false;
            }else{
                $(".model_year_err").hide();
                $(".model_year_err").html("");
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
        
        function check_type(){

            var type = (document.getElementById("type").value).replace(/ {2,}/g,' ');
            var string_pattern = /^[A-Za-z][A-Za-z\s\-]+$/;

            if(!type.match(string_pattern)){
                $(".type_err").show();
                $(".type_err").html("* Please Enter Proper Type");
                return false;
            }else{
                $(".type_err").hide();
                $(".type_err").html("");
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

            var plate_no = document.getElementById("plate_no").value;
            var brand = (document.getElementById("brand").value).replace(/ {2,}/g,' ');
            var model_name = (document.getElementById("model_name").value).replace(/ {2,}/g,' ');
            var model_year = (document.getElementById("model_year").value).replace(/ {2,}/g,' ');
            var color = (document.getElementById("color").value).replace(/ {2,}/g,' ');
            var type = (document.getElementById("type").value).replace(/ {2,}/g,' ');
            var location_of_theft = (document.getElementById("location_of_theft").value).replace(/ {2,}/g,' ');
            var city = document.getElementById("city").value;
            var station = document.getElementById("police_station").value;
            var date_of_theft = document.getElementById("date_of_theft").value;
            var time_of_theft = document.getElementById("time_of_theft").value;
            var fd = document.getElementById("file").files[0];

            var no_pattern =/^[A-Z]{2}[ -]?[0-9]{2}[ -]?[A-Z]{1,2}[ -]?[0-9]{4}$/;
            var string_pattern = /^[A-Za-z][A-Za-z\s\-]+$/;
            var brand_pattern = /^[A-Za-z][A-Za-z\s\-&]+$/;
            var model_name_pattern=/^[a-zA-Z0-9]+$/;
            var model_year_pattern=/^\d{4}$/;
            var address_pattern = /[a-zA-Z0-9\s]+?/;


            
            function check_time(){
                
                const today = new Date().toISOString().split('T')[0];
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

            
            if(plate_no!="" && brand!="" && model_name!="" && model_year!="" && color!="" && type!="" && location_of_theft!=""){

                check_Plate_no();
                check_brand();
                check_model_name();
                check_model_year();
                check_color();
                check_type();
                check_location();
                check_time();

                if(check_Plate_no() && check_brand() && check_model_name() && check_color() && check_model_year() && check_type() && check_location() && check_time()){
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
                                url: "./php/addvehicalFIR.php?addFIR=1",
                                type: "post",
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(response) {
                                    if(response == 1){
                                        $(".loader").hide();
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