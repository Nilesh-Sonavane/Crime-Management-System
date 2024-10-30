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
    <title>BharatSuraksha (eFIR)</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/fir.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">
</head>
<body onload="startSpinner()">

    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>

    <?php require './includes/header.php'?>

    <div id="modal">
    <div id="modal-form">
        <h2>eFIR Disclaimer</h2>
        <hr>
        <p>e-FIR facility has been provided as an alternative arrangement to lodge complain regarding vehicle theft and mobile theft. Provided that</p>
        <ul>
            <li>Mobile number or adhar number of complainant are mandatory for using services of e-FIR</li>
            <li>e -FIR facility has been provided to facilitate common people, in case of lodging malafide complaint or misuse of the facility, legal proceeding under IPC shall be against the complainant</li>
            <li>his facility is provided only for theft committed within the Indian Country</li>
            <li>Please keep handy all the required documents i.e., In case of vehicle theft, RC Book, ID Proof, Insurance Policy and in case of mobile theft, mobile purchase bill and ID proof.</li>
        </ul>
        <form method="POST">
            <input type="checkbox" id="agree">&nbsp;&nbsp;I Agree
            <div>
            <table>
                <tr>
                    <td>Theft Type</td>
                    <td>
                        <select name="crime-type" class="select-dropdown" id="crime_type">
                            <option value="-1">--Select--</option>
                            <option value="1">Mobile Theft</option>
                            <option value="2">Vehicle Theft</option>
                        </select>
                    </td>
                </tr>
            </table>
            </div>
            <div class="buttons-div">
                <a class="btn btn-sm btn-submit" onclick="submit()">Submit</a>
                <a href="index.php" class="btn btn-sm btn-cancle">Cancle</a>
            </div>
            
              
        </form>
    </div>
</div>

    <?php require './includes/footer.php'?>

<script>
    
    function startSpinner(){
        $(".loader").css("display", "none");
    }  

    function submit(){
        
        var agree = document.getElementById("agree").checked;
        var crime_id = document.getElementById("crime_type").value;
  
        if(agree){

            if(crime_id!="-1"){
                document.location.href="./php/check_fir.php?crime_id="+crime_id;
            }else{
                alert("Please select theft type");
            }
        }else{
            alert("Please agree disclaimer");
        }
    }
</script>

</body>
</html> 

