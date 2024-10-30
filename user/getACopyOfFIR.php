<?php
    include_once './php/database.php';
    if(!isset($_SESSION['uid'])){
        header('Location:index.php#open-modal');
      }
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BharatSuraksha</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/getACopyOfFIR.css">
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
            <h2>Get a Copy of FIR</h2>
        </div>
        <div class="container1">
             <label style="margin-top: 0;margin-bottom: 1rem;margin-left:20px"> <storng>All fields marked with <span class="require">*</span> are mandatory </storng> </label>
             <div class="row">
                <div class="col-md-5">
                    <label for="firID">FIR Number</label><span class="require">*</span>
                    <input type="text" maxlength="14" name="firID" id="firID">
                    <small><span class="Error firID_err">* It Is reqired</span></small>
                </div>
                <div class="col-md-2">
                    <hr>
                </div>
                
                <div class="col-md-5">
                    <label for="firDate">FIR Date</label><span class="require">*</span>
                    <input type="date" name="firDate" id="firDate">
                    <small><span class="Error firDate_err">* It Is reqired</span></small>
                </div>
            </div>
            <div class="container2">
                <table class="rwd-table">
                    <thead>
                        <tr>
                            <th>FIR NUMBER</th>
                            <th>DATE</th>
                            <th>Time</th>
                            <th>STATUS</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            if(isset($_GET['firID'])){
                                $firID = $_GET['firID'];
                                $firDate = $_GET['firDate'];
                                $sql = "SELECT * FROM fir WHERE fir_id='$firID' AND fir_date = '$firDate'";
                                $result = $conn->query($sql);
                                $rowcount = mysqli_num_rows($result);
                                 if($rowcount!=0){

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
                                            <td data-th="ACTION"><a href="./php/fir_pdf.php?firid=<?php echo $row['fir_id'];?>" target="_blank">Download</a></td>
                                        </tr>
                                        <script>
                                            document.getElementById("firID").value = "<?php echo $row['fir_id'];?>";
                                            document.getElementById("firDate").value = "<?php echo $row['fir_date'];?>";
                                        </script>
                                    <?php
                                    }
                                }else{
                                    ?>
                                        <script>
                                            Swal.fire({
                                                icon: "error",
                                                title: "No Record Found!"
                                            }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.replace("getACopyOfFIR.php");

                                            }else{
                                                window.location.replace("getACopyOfFIR.php");
                                            }
                                            });
                                        </script>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>  

                </table>
                <div class="row">
                    <div class="buttons">
                        <input type="button" class="mx-2 btn btn-sm btn-secondary" value="Generate Report" onclick="submit1()">
                        <input type="button" class="mx-2 btn btn-sm btn-secondary" value="Reset" onclick="reset1()">
                    </div>
                </div>
            </div>
        </div>

    </form>

  <?php require 'signin.php'?>
  
  <?php require './includes/footer.php'?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="./js/script.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
  <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
  <script>
    function startSpinner(){
        $(".loader").css("display", "none");
    }  
     // feature date and time disable 
        const today = new Date().toISOString().split('T')[0];
        document.getElementById("firDate").setAttribute("max", today);
    // **************** end *********
    function submit1(){
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

        var firID = document.getElementById("firID").value;
        var firDate = document.getElementById("firDate").value;
        var firID_pattern = /^[0-9]{14}(,[0-9]{14})*$/;

        function check_firID(){
            if(!firID.match(firID_pattern)){
                $(".firID_err").show();
                $(".firID_err").html("* Please Enter Valid FIR No");
                return false;
            }else{
                $(".firID_err").hide();
                $(".firID_err").html("");
                return true;
            }
        } 
        if(firID!="" && firDate!=""){
            check_firID();
            if(check_firID()){
                $(".loader").show();
                window.location.href = "getACopyOfFIR.php?firID="+firID+"&firDate="+firDate;
            }
        }else{
            Toast.fire({    
                icon: 'error',
                title: 'All fileds are required'
            });
        }
    }
    function reset1(){
        window.location.replace("getACopyOfFIR.php");
    }
  </script>
</body>

</html>