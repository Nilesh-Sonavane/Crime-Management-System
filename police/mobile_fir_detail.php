<?php
include('php/database.php');
if(!isset($_SESSION['pid'])){
  header('Location:index.php');
} 

$fid = $_GET['id'];
$mobile_sql = "SELECT * FROM mobile_fir WHERE fir_id= $fid";
$mobile_result =$conn->query($mobile_sql);
$mobile_row = $mobile_result->fetch_assoc();
$mobile_station_id = $mobile_row['station_id'];


$pid = $_SESSION['pid'];
$police_sql = "SELECT * FROM police WHERE police_id= $pid";
$police_result =$conn->query($police_sql);
$police_row = $police_result->fetch_assoc();
$police_station_id = $police_row['station_id'];

if($mobile_station_id!=$police_station_id){
    header('Location:fir.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police (eFIR)</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/mobile_fir.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">

</head>
<body>
    <?php require './includes/sidebar.php'?>
    <div id="content-wrapper">
        <div class="container-fluid">
        <h2 style="text-align:center;background:#aed3fb;color:rgb(5, 98, 167);padding:10px;border-radius:5px;margin:10px 20px 50px 20px">FIR Detail</h2>
        <div class="container detail_page">
            <form action="#" method="post">
                <table class="table table-striped table-responsive">
                    <?php
                        $fid = $_GET['id'];
                        $sql = "SELECT * FROM mobile_fir WHERE fir_id= $fid";
                        $result =$conn->query($sql);
                        
                        while($row = $result->fetch_assoc()){
                            ?>
                                <?php
                                    $fir_sql = "SELECT * FROM fir WHERE fir_id=$fid";
                                    $fir_result =$conn->query($fir_sql);
                                    $fir_row = $fir_result->fetch_assoc();

                                    $fir_user_id = $fir_row['user_id'];
                                    $user_sql = "SELECT * FROM user WHERE user_id=$fir_user_id";
                                    $user_result =$conn->query($user_sql);
                                    $user_row = $user_result->fetch_assoc();
                                    
                                ?>
                                <tr>
                                    <th>NAME</th>
                                    <td><?php echo $user_row['fname']." ".$user_row['mname']." ".$user_row['lname']?></td>
                                </tr>
                                <tr>
                                    <th>GENDER</th>
                                    <td><?php echo $user_row['gender']?></td>
                                </tr>
                                
                                <tr>
                                    <th>EMAIL</th>
                                    <td><?php echo $user_row['email']?></td>
                                </tr>
                                <tr>
                                    <th>CONTACT NO</th>
                                    <td><?php echo $user_row['contact']?></td>
                                </tr>
                                <tr>
                                    <th>FIR STATUS</th>
                                    <td>
                                        <select name="status_id" id="status_id">
                                        <?php 

                                            $fir_old_status =  $fir_row['fir_status'];
                                            
                                            $status_sql = "SELECT * FROM fir_status;";
                                            $status_result =$conn->query($status_sql);
                                            
                                            while($status_row = $status_result->fetch_assoc()){
                                                ?>
                                                    <option <?php if($fir_old_status==$status_row['status_id']){echo "selected";}?> value="<?php echo $status_row['status_id']?>"><?php echo $status_row['status_name']?></option>
                                                <?php
                                            }
                                        ?>
                                         </select>
                                         <input type="submit" class="btn btn-sm btn-success" name="update" value="Update">
                                    </td>
                                </tr>
                                <tr>
                                    <th>IMEI NO</th>
                                    <td><?php echo $row['imei_no'];?></td>
                                </tr>
                                <tr>
                                    <th>BRAND</th>
                                    <td><?php echo $row['brand'];?></td>
                                </tr>
                                <tr>
                                    <th>MODEL</th>
                                    <td><?php echo $row['model'];?></td>
                                </tr>
                                <tr>
                                    <th>COLOR</th>
                                    <td><?php echo $row['color'];?></td>
                                </tr>
                                <tr>
                                    <th>LOCATION OF THEFT</th>
                                    <td><?php echo $row['location_of_theft'];?></td>
                                </tr>
                                <tr>
                                    <th>STATE OF THEFT</th>
                                    <td>
                                        <?php
                                            $city=$row['city_id'];
                                            $sql_city = "SELECT * FROM cities WHERE city_id=$city";
                                            $result_city = mysqli_query($conn, $sql_city);
                                            
                                            while($row_city = $result_city->fetch_assoc()){

                                                $state=$row_city['state_id'];
                                                $sql_state = "SELECT * FROM states WHERE state_id=$state";
                                                $result_state = mysqli_query($conn, $sql_state);
                                                while($row_state = $result_state->fetch_assoc()){
                                                    echo $row_state['state_name'];
                                                }
                                                
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>CITY OF THEFT</th>
                                    <td>
                                        <?php
                                            $city=$row['city_id'];
                                            $sql_city = "SELECT * FROM cities WHERE city_id=$city";
                                            $result_city = mysqli_query($conn, $sql_city);
                                            
                                            while($row_city = $result_city->fetch_assoc()){
                                                echo $row_city['city_name'];
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>POLICE STATION</th>
                                    <td>
                                        <?php
                                            $station_id =  $row['station_id'];
                                            $sql_station = "SELECT * FROM police_station WHERE station_id=$station_id";
                                            $result_station = mysqli_query($conn, $sql_station);
                                            $row_station = $result_station->fetch_assoc();
                                            echo $row_station['station_name'];
                                        ?>
                                    </td>
                                </tr> 
                                <tr>
                                    <th>DATE OF THEFT</th>
                                    <td><?php echo $row['date_of_theft'];?></td>
                                </tr>  
                                <tr>
                                    <th>TIME OF THEFT</th>
                                    <td><?php echo $row['time_of_theft'];?></td>
                                </tr> 
                                <tr>
                                    <th>MOBILE BILL</th>
                                    <td><a href="#popup1" class="text-dark fw-bold" style="cursor:pointer;" onclick="getimage('<?php echo $row['mobail_bill']; ?>');">View Image</a></td>
                                </tr>
                            <?php
                        }
                    ?>
                                  
                </table>
            </form>
            
        </div>
    </div>

<?php

if(isset($_REQUEST['update'])){
    $status =$_REQUEST['status_id'];
    $sql_update = "UPDATE fir SET fir_status=$status WHERE fir_id=$fid";
    if($conn->query($sql_update)){
        ?>
            <script>
                alert("Update Sucessfully");
                window.location.href="fir.php";
            </script>
        <?php
    }
}  
    
?>

    <!-- view image start -->
<div id="popup1" class="overlay">
	<div class="popup">
		<h2>Mobile Bill</h2>
		<a class="close" href="">&times;</a>
		<div class="content">
            <img id="up-img"  src="" height="500vh" width="100%"></img>
		</div>
	</div>
</div>
<!-- view image end -->


<script src="./JS/script.js"></script>
<script>
    function getimage(img) {
        $("#up-img").attr("src", "../uploads/"+img);
    }
</script>
</body>

</html>