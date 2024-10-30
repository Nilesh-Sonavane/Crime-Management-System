<?php
include('php/database.php');
if(!isset($_SESSION['aid'])){
  header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin (News&Announcement)</title>
    <link rel="stylesheet" href="./CSS/policeStation.css">
    <link rel="stylesheet" href="./CSS/style.css">
    
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />     
    <link rel="stylesheet" href="./css/all.css">
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">
    <?php include 'font.php'?>

    <!-- <script src="./DataTables/js/jquery.js"></script>
    <script src="./DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="./DataTables/media/css/jquery.dataTables.min.css">
<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
    })
</script> -->


</head>
<body onload="startSpinner()">

    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>

    <?php require 'sidebar.php'?>
    
    <div id="content-wrapper">
        <div class="container-fluid">
            <h2 style="text-align:center;background:#aed3fb;color:rgb(5, 98, 167);padding:10px;border-radius:5px;margin:10px">NEWS & ANNOUNCEMENT</h2>
            <div class="container">
                <button id="addNewsBtn" class="btn btn-success"> <i class="fa fa-plus-circle"></i> Add News</button>
            </div>
            <div class="container station_box" id="station_box" style="display:none">
                <form method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="news_headline" style="color:#7d7878" >News Headline</label>
                        <input type="text" class="form-control" name="news_headline" id="news_headline">
                    </div>
                    <div class="mb-3">
                        <label for="news_link" style="color:#7d7878">News Link</label>
                        <input type="text" class="form-control" name="news_link" id="news_link">
                    </div>
                    <div style="margin-top:30px;">
                        <button id="btn-add" type="submit" style="display:visible;" class="btn btn-primary" onclick="addNews(event)">Add</button> 
                        <button id="btn-hide" type="button" class="btn btn-danger">Cancle</button>
                    </div>
                </form>
            </div>   
            <div class="container station_table">
            
            </div>
        </div>
    </div>
</div>
<!-- update news start  -->

<div id="modal">
    <div id="modal-form">
        <h2>Update News</h2>
        <form method="POST" autocomplete="off">
                    
            <input type="text" class="form-control" name="update_news_id" id="update_news_id" style="display:none">
                    <div class="mb-3">
                        <label for="update_news_headline" style="color:#7d7878">News Headline</label>
                        <input type="text" class="form-control" name="update_news_headline" class="update_news_headline" id="update_news_headline" require>
                    </div>
                    <div class="mb-3">
                        <label for="update_news_link" style="color:#7d7878">News Link</label>
                        <input type="text" class="form-control" name="update_news_link" id="update_news_link" class="update_news_link" require>
                    </div>
                    <div style="margin-top:30px;">
                        
                        <button id="btn-update"  type="button" onclick="updateNews(event)" class="btn btn-success" >Update</button> 
                        <button id="btn-hide" type="button" class="btn btn-danger" style="float:right">Cancle</button>
                    </div>
                    
                </form>
    </div>
     
</div>

<!-- update news end  -->


<script src="./JS/script.js"></script>
<!-- <script src="./JS/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<script>
    function startSpinner(){
        $(".loader").css("display", "none");
    } 
    $(document).ready(function(){
        loadStationTable();
        $("#addNewsBtn").click(function(){
            $("#station_box").show();
            $("#btn-add").show();
            

        });
        $("#btn-hide").click(function(){
            $("#station_box").hide();
        });
        $(document).on("click",".fa-edit",function(){
            
            $("#modal").show();
        
        });
        $(document).on("click","#btn-hide",function(){
            $("#modal").hide();
        });
        
    
    });
    function loadStationTable(){
        $.ajax({  
            url: "php/newsTable.php",
            type: "GET",  
            dataType:"html",  
            success:function(response){ 
                $(".station_table").html(response);
            }  
        });
    }
    function addNews(e){
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

        var news_headline = ($("#news_headline").val().trim()).replace(/ {2,}/g,' ');
        var news_link = $("#news_link").val().trim();

        if(news_headline!="" && news_link!="" ){
            $(".loader").show();
            $.ajax({
                url: "./php/crud.php",
                type: "post",
                data: {
                    news_headline:news_headline,
                    news_link:news_link
                },
                success: function(response) {
                    $(".loader").hide();
                    if(response == "1"){
                        Swal.fire({
                        icon: "success",
                        title: "Add News Successfully"
                        }).then((result) => {
                            location.reload();
                        })
                    }else{
                        console.log(response);
                    }
                }
            });    
        }else{
            Toast.fire({    
                icon: 'error',
                title: 'All fileds are required'
            });  
        }
    }
    function getNewsInfo(id){ 
        $.ajax({  
            url: "php/crud.php?getNews_id="+id,
            type: "GET",   
            dataType:"json",
            success:function(data){ 
                console.log(data);
                $('#update_news_id').val(data['id']); 
                $('#update_news_headline').val(data['text']);
                $('#update_news_link').val(data['link']);                
            } 
        });
    }
    function updateNews(e){

        var news_id = $("#update_news_id").val().trim();
        var news_headline = ($("#update_news_headline").val().trim()).replace(/ {2,}/g,' ');
        var news_link = $("#update_news_link").val().trim();

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

        if(news_headline!="" && news_link!="" && news_id!=""){

            $(".loader").show();
            $.ajax({
                url: "./php/crud.php?updateNewsId="+news_id,
                type: "GET",
                data: {
                    news_id:news_id,
                    news_headline:news_headline,
                    news_link:news_link
                },
                success: function(response) {
                    $(".loader").hide();
                    if(response == "1"){
                        Swal.fire({
                        icon: "success",
                        title: "Update News Successfully"
                        }).then((result) => {
                            location.reload();
                        })
                    }else{
                        console.log(response);
                    }
                }
            });   
        }else{
            Toast.fire({
                icon: 'error',
                title: 'All fileds are required'
            }); 
        }
    }
    function deleteNews(id){
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
                url: "php/crud.php?deleteNews="+id,
                type: "GET",
                success: function(response) {
                    $(".loader").hide();
                    if(response == "1"){
                        Swal.fire({
                            title: "Deleted!",
                            text: "Deleted Successfully.",
                            icon: "success"
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