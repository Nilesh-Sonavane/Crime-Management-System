<?php
include('php/database.php');
if(!isset($_SESSION['aid'])){
  header('Location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin (Media)</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/media.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
    <link rel="stylesheet" href="./css/all.css">
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">
    <?php include 'font.php'?>
</head>
<body onload="startSpinner()">

    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>

    <?php require 'sidebar.php'?>


    <!-- Content - Start  -->
<div id="content-wrapper">
 <div class="container-fluid">

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="head">
                    <h1 style="font-family: 'Slackside One', cursive;">Media</h1>
                    <button id="add-media" style="font-family: 'Slackside One', cursive;" class="btn-add">ADD MEDIA</button>
                </div>
                <table class="table text-center table-hover img-tbl">
                    <thead >
                        <tr >
                            <th class="text-center">#</th>
                            <th class="text-center">Images</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $conn = new mysqli('localhost','root','','crime_management_system');
                            $sql = "SELECT * FROM media";
                            $result = $conn->query($sql);
                            $id = 1;
                            while($row = $result->fetch_assoc()){
                                $img_id = $row['img_id'];
                        ?>
                            <tr>
                                <td><?php echo $id++?></td>
                                <td><a href="#popup1" class="text-dark fw-bold" style="cursor:pointer;" onclick="getimage('<?php echo $row['img_name']; ?>');">View Image</a></td>
                                <td><i class="far fa-times-circle text-danger ml-2 fa-lg" onclick="deleteMedia(<?php echo $row['img_id'] ?>)"></i></td>
                            </tr>
                        <?php
                            }
                        ?>
        
                    </tbody>
                </table>
                    
              
            </div>
       
            <div class="col-lg-6 upalod-box" id="show-media" style="display:none;">
                <div class="upload-box-head">
                    <span style="font-family: Leckerli One, cursive;font-size:25px;">add media</span>
                    <button id="hide-media" class="btn-cancle" style="font-family: 'Abril Fatface', cursive;">Cancel</button>
                </div>
                    
                    <hr class="text-dark" style="border: 0;border-top: 3px solid #dee2e6;margin: 20px 0;">
                   
                    <form id="mediaForm" class="media_form" method="POST" enctype="multipart/form-data">
                        <label class="mt-10 mb-10 w3-lobster" style="margin:15px;" ><b style="font-family: 'Lugrasimo', cursive;font-size:18px;">Upload Media Image:</b></label>

                        <div class="mt-10 mb-3">
                            <input class="form-control" name="file" type="file" accept="image/png, image/gif, image/jpeg" id="file"> 
                        </div>

                        <button type="submit" id="upload-img-btn" name="upload-img-btn" class="btn btn-info py-2 mt-4 w3-myfont" style="font-size: 13pt;" onclick="addmedia(event);">Submit</button>
                    </form>

                </div>
        </div>
     </div>
 </div>

</div>

<!-- view image start -->
<div id="popup1" class="overlay">
	<div class="popup">
		<h2>Media Image</h2>
		<a class="close" href="">&times;</a>
		<div class="content">
            <img id="up-img"  src="" height="500vh" width="100%"></img>
		</div>
	</div>
</div>


<!-- view image end -->



<script src="./JS/script.js"></script>
<script src="./js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<script>
   function startSpinner(){
        $(".loader").css("display", "none");
    } 

    $(document).ready(function(){
        
        $("#add-media").click(function(){
            $("#show-media").show();
        });
        $("#hide-media").click(function(){
            $("#show-media").hide();
        });   
    });

    function getimage(img) {
        $("#up-img").attr("src", "../uploads/"+img);
        // Swal.fire({
        //     title: "Deleted!",
        //     imageUrl: "../uploads/"+img,
        //     imageHeight: 450,
        //     imageWidth:450,
        //     imageAlt: "A tall image"
        // });
    }

    function addmedia(e){

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

        var fd = document.getElementById("file").files[0];
        if(fd != null){
            var frm = document.getElementById("mediaForm");
            
            var formData = new FormData(frm);
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
                    url: "./php/crud.php?addmediaImage=1",
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
                            title: "Image Uploaded Successfully"
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
        else{
            Toast.fire({
                icon: 'error',
                title: 'Upload Image is Blank'
            })      
             
        }
    }
    function deleteMedia(id){
    
        Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $(".loader").show();
                $.ajax({
                    url: "php/crud.php?deleteMediaImage="+id,
                    type: "post",
                    success: function(response) {
                        $(".loader").hide();
                        if(response == "1"){
                            Swal.fire({
                            icon: "success",
                            title: "Image Deleted Successfully"
                            }).then((result) => {
                                    location.reload();
                                })
                        }else{
                            console.log(response);
                        }
                    }
                });
            }
            });
    }
    
</script>




</body>
</html>