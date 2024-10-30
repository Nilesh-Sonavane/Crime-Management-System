<?php
include('php/database.php');
if(!isset($_SESSION['pid'])){
    
    header('Location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<heaArrestedd>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/ArrestedPeerson.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">



    <title>Police (Arrested)</title>
    <style>
      .swal2-popup{
    font-size: 1.5rem !important;
  }
    </style>
</heaArrestedd>
<body onload="startSpinner()">
    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>

    <?php require './includes/sidebar.php'?>    
    <div id="content-wrapper">
        <div class="container-fluid">
            <h2 style="text-align:center;background:#aed3fb;color:rgb(5, 98, 167);padding:10px;border-radius:5px;margin:10px">Arrested Person</h2>
            <div class="container">
                <button id="addArrestedBtn" class="btn btn-success"> <i class="fa fa-plus-circle"></i> Add Arrested Person</button>
            </div>
            <div class="container criminal_box" id="criminal_box" style="display:none">
                <form id="ArrestedForm" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Arrested_name">Arrested Name</label><span class="require">*</span>
                            <input type="text" name="Arrested_name"  id="Arrested_name">
                            <small><span class="Error Arrested_Name_err"></span></small>
                        </div>      
                        <div class="col-md-4">
                            <label for="gender"> Gender</label><span class="require">*</span><br>
                                <input class="form-check-label" type="radio" value="Male" name="gender"> Male
                                <input class="form-check-label" type="radio" value="Female" name="gender"> Female
                                <small><span class="Error gender_err"></span></small>
                        </div>
                        <div class="col-md-4">
                                <label for="dob" >Date Of Birth</label><span class="require">*</span>
                                <input  id="dob" class="dob" type="date" name="dob">
                                <small><span class="Error dob_err"></span></small>
                        </div>
                    <div>
                    <div class="row">
                        <div class="col-md-4">
                                <label for="arrest_date">Arrest Date</label><span class="require">*</span>
                                <input  id="arrest_date" class="arrest_date" type="date" name="arrest_date">
                                <small><span class="Error arrest_date_err"></span></small>
                        </div>
                        <div class="col-md-4">
                                <label for="arrest_time">Arrest Time</label><span class="require">*</span>
                                <input  id="arrest_time" class="arrest_time" type="time" name="arrest_time">
                                <small><span class="Error aarrest_time_err"></span></small>
                        </div>
                        <div class="col-md-4">
                                <label for="crime_type">Crime Type</label><span class="require">*</span>
                                <select name="crime_type" id="crime_type">
                                    <option value="-1">--Select--</option>
                                    <?php
                                        $sql = "SELECT * FROM crimetype";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = $result->fetch_assoc()){
                                        ?>
                                            <option value="<?php echo $row['crime_id']?>"><?php echo $row['crime_name']?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="location">Location<span class="require">*</span></label>
                            <textarea name="location" id="location" cols="80" rows="2"></textarea>
                            <small><span class="Error address_err">* It Is reqired</span></small>
                        </div>
                        <div class="col-md-4">
                            <label for="img">Image </label><span class="require">*</span>
                            <input type="file" name="img"  id="img">
                        </div>
                        <div class="col-md-4">
                            <label for="bail_amount">Bail Amount</label><span class="require">*</span>
                            <input type="text" name="bail_amount"  id="bail_amount" placeholder="In INR">
                            <small><span class="Error bail_amount_err"></span></small>
                        </div>
                    </div>
                    <div style="margin-top:30px;">
                        <button id="btn-add" type="submit" style="display:visible;" class="btn btn-primary" onclick="addArrestedPerson(event)">Add</button> 
                        <button id="btn-hide" type="button" class="btn btn-danger">Cancle</button>
                    </div>
                </form>
            </div>
            <br>
            
        </div>
    </div>
    
    <div class="Arrested_table" style="margin:10px">
    </div>
    <!-- update wanted start  -->

<div id="modal">
    <div id="modal-form">
        <h2>Update Arrested Person</h2>
        <form id="updateArrestedForm" method="POST" enctype="multipart/form-data">
        
            <input type="hidden" name="update_Arrested_id"  id="update_Arrested_id" >

            <div class="row">
                <div class="col-md-4">
                    <label for="update_Arrested_name">Arrested Name</label><span class="require">*</span>
                    <input type="text" name="update_Arrested_name"  id="update_Arrested_name">
                    <small><span class="Error update_Arrested_Name_err"></span></small>
                </div>      
                <div class="col-md-4">
                    <label for="update_gender"> Gender</label><span class="require">*</span><br>
                        <input class="form-check-label" type="radio" value="Male" name="update_gender" id="update_male"> Male
                        <input class="form-check-label" type="radio" value="Female" name="update_gender" id="update_female"> Female
                        <small><span class="Error update_gender_err"></span></small>
                </div>
                <div class="col-md-4">
                        <label for="update_dob" >Date Of Birth</label><span class="require">*</span>
                        <input  id="update_dob" class="update_dob" type="date" name="update_dob">
                        <small><span class="Error update_dob_err"></span></small>
                </div>
            <div>                       
            <div class="row">
                <div class="col-md-4">
                        <label for="update_arrest_date">Arrest Date</label><span class="require">*</span>
                        <input  id="update_arrest_date" class="update_arrest_date" type="date" name="update_arrest_date">
                        <small><span class="Error update_arrest_date_err"></span></small>
                </div>
                <div class="col-md-4">
                        <label for="update_arrest_time">Arrest Time</label><span class="require">*</span>
                        <input  id="update_arrest_time" class="update_arrest_time" type="time" name="update_arrest_time">
                        <small><span class="Error update_aarrest_time_err"></span></small>
                </div>
                <div class="col-md-4">
                        <label for="update_crime_type">Crime Type</label><span class="require">*</span>
                        <select name="update_crime_type" id="update_crime_type">
                            <option value="-1">--Select--</option>
                            <?php
                                $sql = "SELECT * FROM crimetype";
                                $result = mysqli_query($conn, $sql);
                                while($row = $result->fetch_assoc()){
                                ?>
                                    <option value="<?php echo $row['crime_id']?>"><?php echo $row['crime_name']?></option>
                                <?php
                                }
                            ?>
                        </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="update_location">Location<span class="require">*</span></label>
                    <textarea name="update_location" id="update_location" cols="80" rows="2"></textarea>
                    <small><span class="Error update_address_err">* It Is reqired</span></small>
                </div>
                <div class="col-md-4">
                    <label for="update_img">Image </label>
                    <input type="file" name="update_img"  id="update_img">
                </div>
                <div class="col-md-4">
                    <label for="update_bail_amount">Bail Amount</label><span class="require">*</span>
                    <input type="text" name="update_bail_amount"  id="update_bail_amount" placeholder="In INR">
                    <small><span class="Error update_bail_amount_err"></span></small>
                </div>
            </div>

            <div style="margin-top:30px;">
                <button id="btn-update"  type="button" onclick="updateArrestedPerson(event)" class="btn btn-success" >Update</button> 
                <button id="btn-hide" type="button" class="btn btn-danger" style="float:right">Cancle</button>
            </div>
        </form>
    </div>
     
</div>

<!-- update wanted station end  -->


<!-- view image start -->
<div id="popup1" class="overlay">
	<div class="popup">
		<h2>Arrested Person Image</h2>
		<a class="close" href="">&times;</a>
		<div class="content">
            <img id="up-img"  src="" height="500vh" width="100%"></img>
		</div>
	</div>
</div>
<!-- view image end -->


<script src="./JS/script.js"></script>
<script src="./js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>    
    <script>
        function startSpinner(){
            $(".loader").css("display", "none");
        } 
        $(document).ready(function(){
            loadArrestedTable();
            $("#addArrestedBtn").click(function(){
                $("#criminal_box").show();
                $("#btn-add").show();
                

            });
            $("#btn-hide").click(function(){
                $("#criminal_box").hide();
            });

            $(document).on("click",".fa-edit",function(){
                $("#modal").show();
            });
            $(document).on("click","#btn-hide",function(){
                $("#modal").hide();
            });


        }); 
        function getimage(img) {
            $("#up-img").attr("src", "../uploads/"+img);
        }
        function getPersonInfo(id){
            $.ajax({  
            url: "php/crud.php?getArrested_id="+id,
            type: "GET",  
            dataType:"json",  
            success:function(data){ 

                $('#update_Arrested_id').val(data['arrested_id']);
                $('#update_Arrested_name').val(data['arrested_name']);
                var gender = data['gender'];
                if(gender=="Male"){
                    document.getElementById("update_male").checked  = true;
                    document.getElementById("update_female").checked  = false;
                }else{
                    document.getElementById("update_female").checked  = true;
                    document.getElementById("update_male").checked  = false;
                }
                $('#update_dob').val(data['dob']);
                $('#update_arrest_date').val(data['arrested_date']);
                $('#update_arrest_time').val(data['arrested_time']);
                $('#update_crime_type').val(data['crime_id']);
                $('#update_location').val(data['location']);
                $('#update_bail_amount').val(data['bail_amount']);

            }});
        }
        function loadArrestedTable(){
            $.ajax({  
                url: "php/arrestedTable.php",
                type: "GET",  
                dataType:"html",  
                success:function(response){ 
                    $(".Arrested_table").html(response);
                }  
            });
        }  
        function addArrestedPerson(e){

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
     
            var arrested_name = $("#Arrested_name").val().trim();
            var dob = $("#dob").val().trim();
            if($("input[type='radio'][name='gender']:checked").val()==undefined){
                var gender = "-1";
            }else{
                var gender=$("input[type='radio'][name='gender']:checked").val();
            }

            var arrested_date = $("#arrest_date").val().trim();
            var arrested_time = $("#arrest_time").val().trim();
            var crime_id = $("#crime_type").val().trim();
            var location = $("#location").val().trim();
            // var crime_id = $("#crime_id").val().trim();
            var img = document.getElementById("img").files[0];
            var bail_amount = $("#bail_amount").val().trim();
            
            var string_pattern = /[a-zA-Z\s]+$/;
            var degits = /^[0-9]*$/;

            function check_name(){
                if(!arrested_name.match(string_pattern)){
                    $(".Arrested_Name_err").show();
                    $(".Arrested_Name_err").html("* Please Enter Only Alphabets");
                    return false;
                }else{
                    $(".Arrested_Name_err").hide();
                    $(".Arrested_Name_err").html("");
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
            function check_Bail_Amount(){
                if(!bail_amount.match(degits)){
                    $(".bail_amount_err").show();
                    $(".bail_amount_err").html("* Please Enter Only Numbers");
                    return false;
                }else{
                    $(".bail_amount_err").hide();
                    $(".bail_amount_err").html("");
                    return true;
                }
            }

            if(arrested_name!="" && gender!=-1 && dob!="" && arrested_date!="" && arrested_time!="" && crime_id!=-1 && location!="" && bail_amount!=""){
                
                check_name();
                check_gender();
                check_Bail_Amount();


                if(check_name() && check_gender() && check_Bail_Amount()){
                    if(img != null){

                        var frm = document.getElementById("ArrestedForm");
                        var formData = new FormData(frm);

                        var imgtype = img.name.split(".").pop().toLowerCase();

                        if (jQuery.inArray(imgtype, ["png", "jpg", "jpeg"]) == -1) {
                            Swal.fire({
                                icon: "error",
                                title: "Error In Image",
                                text: "Invalid File Formate!Plz Select Image File"
                            });
                        }
                        else if (img.size > 2000000) {
                            Swal.fire({
                                icon: "error",
                                title: "Error In Image",
                                text: "Image size is Large!Plz Select Image Below 2 MB"
                            });
                        }else{
                            $(".loader").show();
                            $.ajax({
                                url: "./php/addArrested.php?addArrest=1",
                                type: "post",
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(response) {
                                    $(".loader").hide();
                                    if(response == "1"){
                                        Swal.fire({
                                        icon: "success",
                                        text: "Arrested Person Add Successfully"
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
                        Toast.fire({
                            icon: 'error',
                            title: 'Image is Blank'
                        });
                    }
                }
            }else{
                Toast.fire({    
                    icon: 'error',
                    title: 'All fileds are required'
                });
            }


        }
        function updateArrestedPerson(e){
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
            })
            e.preventDefault();

            var arrested_name = $("#update_Arrested_name").val().trim();
            var dob = $("#update_dob").val().trim();
            if($("input[type='radio'][name='update_gender']:checked").val()==undefined){
                var gender = "-1";
            }else{
                var gender=$("input[type='radio'][name='update_gender']:checked").val();
            }

            var arrested_date = $("#update_arrest_date").val().trim();
            var arrested_time = $("#update_arrest_time").val().trim();
            var crime_id = $("#update_crime_type").val().trim();
            var location = $("#update_location").val().trim();
            // var crime_id = $("#crime_id").val().trim();
            var img = document.getElementById("update_img").files[0];
            var bail_amount = $("#update_bail_amount").val().trim();
            
            var string_pattern = /[a-zA-Z\s]+$/;
            var degits = /^[0-9]*$/;

            function check_name(){
                if(!arrested_name.match(string_pattern)){
                    $(".update_Arrested_Name_err").show();
                    $(".update_Arrested_Name_err").html("* Please Enter Only Alphabets");
                    return false;
                }else{
                    $(".update_Arrested_Name_err").hide();
                    $(".update_Arrested_Name_err").html("");
                    return true;
                }
            }
            function check_gender(){
                if(gender=="-1"){
                    $(".update_gender_err").show();
                    $(".update_gender_err").html("* Please Select Gender");
                    return false;
                }else{
                    $(".update_gender_err").html("");
                    $(".update_gender_err").hide();
                    return true;
                }
            }
            function check_Bail_Amount(){
                if(!bail_amount.match(degits)){
                    $(".update_bail_amount_err").show();
                    $(".update_bail_amount_err").html("* Please Enter Only Numbers");
                    return false;
                }else{
                    $(".update_bail_amount_err").hide();
                    $(".update_bail_amount_err").html("");
                    return true;
                }
            }

            if(arrested_name!="" && gender!=-1 && dob!="" && arrested_date!="" && arrested_time!="" && crime_id!=-1 && location!="" && bail_amount!=""){
                check_name();
                check_gender();
                check_Bail_Amount();

                if(check_name() && check_gender() && check_Bail_Amount()){  

                    var frm = document.getElementById("updateArrestedForm");
                    var formData = new FormData(frm);

                    if(img != null){

                        var imgtype = img.name.split(".").pop().toLowerCase();
                        if (jQuery.inArray(imgtype, ["png", "jpg", "jpeg"]) == -1) {
                            Swal.fire({
                                icon: "error",
                                title: "Error In Image",
                                text: "Invalid File Formate!Plz Select Image File"
                            });
                        }
                        else if (img.size > 2000000) {
                            Swal.fire({
                                icon: "error",
                                title: "Error In Image",
                                text: "Image size is Large!Plz Select Image Below 2 MB"
                            });
                        }else{
                            $(".loader").show();
                            $.ajax({
                                url: "./php/updateArrestedPerson.php?updateArrested=1",
                                type: "post",
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(response) {
                                    $(".loader").hide();
                                    if(response == "1"){
                                        Swal.fire({
                                        icon: "success",
                                        title: "Update Successfully"
                                        }).then((result) => {
                                            location.reload();
                                        })
                                    }else{
                                        console.log(response);
                                    }
                                }
                            });    
                        }
                    }else if(img==null){
                        $(".loader").show();
                        $.ajax({
                            url: "./php/updateArrestedPerson.php?updateArrested=1",
                            type: "post",
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(response) {
                                $(".loader").hide();
                                if(response == "1"){
                                    Swal.fire({
                                    icon: "success",
                                    title: "Update Successfully"
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
                });
            }
        }

    </script>
</body>
</html>