<?php
    include_once './php/database.php';
    if((!isset($_SESSION['uid'])) && isset($_SESSION['uid'])){
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
  <link rel="stylesheet" href="./css/myFIR.css">
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
  

  <h1>My FIR</h1>
<table class="rwd-table">

    <?php
        $user_id = $_SESSION['uid'];
        $sql = "SELECT * FROM fir WHERE user_id=$user_id";
        $result = $conn->query($sql);
        $rowcount = mysqli_num_rows($result);

        if($rowcount!=0){
            ?>
                <thead>
                    <tr>
                        <th>FIR NUMBER</th>
                        <th>DATE</th>
                        <th>Time</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                     <?php
                        while($row = $result->fetch_assoc()){
                            ?>
                                <tr>
                                    <td data-th="FIR NUMBER"> <?php echo $row['fir_id'];?> </td>
                                    <td data-th="DATE"><?php echo $row['fir_date'];?>  </td>
                                    <td data-th="Time"><?php echo $row['fir_time'];?></td>
                                    <td data-th="STATUS">
                                        <?php 
                                            $status_id =  $row['fir_status'];
                                            $sql1 = "SELECT * FROM fir_status WHERE status_id=$status_id";
                                            $result1 = $conn->query($sql1);
                                            $row1 = $result1->fetch_assoc();
                                            echo $row1['status_name'];
                                        ?>
                                    </td>
                                </tr>
                            <?php
                        }
                     ?>
                </tbody>
            <?php
        }else{
            ?>
                <tr>
                    <td>No Record Found</td>
                </tr>
            <?php
        }
        ?>



</table>




  <?php require 'signin.php'?>

  <?php require './includes/footer.php'?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="./js/script.js"></script>
    <script>
        
        function startSpinner(){
            $(".loader").css("display", "none");
        }  
    </script>
</body>

</html>