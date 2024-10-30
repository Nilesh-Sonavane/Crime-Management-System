<?php
    include_once './php/database.php';
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BharatSuraksha</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
  <link rel="stylesheet" href="./css/all.css">
  <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">
  <style>

     table{
            width:50%;
            margin: auto;

        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding:5px;
        }
        /* th{
            width:30%;
        } */
  </style>


</head>

<body onload="startSpinner()">
<div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>
  <?php require './includes/header.php'?>
  

<div style="margin-top:10px">
    <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0">
        <tbody><tr>
                <td width="48" colspan="3">
                    <p class="MsoNormal" align="center"><b>
                        <span>Helpline Number</span>
                    </b></p>
                </td>
                
            </tr>
            <tr>
                <td width="48">
                    <p class="MsoNormal" align="center"><b>
                        <span>Sr. No.</span>
                    </b></p>
                </td>
                <td width="168">
                    <p class="MsoNormal" align="center"><b><span> Helpline Number </span></b></p>
                </td>
                <td width="385">
                    <p class="MsoNormal" align="center"><b><span> Type of Helpline </span></b></p>
                </td>
            </tr>
            <tr>
                <td width="48" style="width:35.75pt; background:#ececec">
                <p class="MsoNormal" align="center" style="text-align:center"><span>1</span></p>
                </td>
                <td width="168" style="width:1.75in;background:#ececec">
                <p class="MsoNormal" style="text-align:justify"><span>100</span></p>
                </td>
                <td width="385" style="width:289.1pt; background:#ececec">
                <p class="MsoNormal" style="text-align:justify"><span>Police Helpline</span></p>
                </td>
            </tr>
            <tr>
                <td width="48" style="width:35.75pt">
                <p class="MsoNormal" align="center" style="text-align:center"><span>2</span></p>
                </td>
                <td width="168" style="width:1.75in;
                ">
                <p class="MsoNormal" style="text-align:justify"><span>108</span></p>
                </td>
                <td width="385" style="width:289.1pt;
                ">
                <p class="MsoNormal" style="text-align:justify"><span>Helpline for medical emergency</span></p>
                </td>
            </tr>
            <tr>
                <td width="48" style="width:35.75pt;background:#ececec">
                <p class="MsoNormal" align="center" style="text-align:center"><span>3</span></p>
                </td>
                <td width="168" style="width:1.75in;
                ;
                background:#ececec">
                <p class="MsoNormal" style="text-align:justify"><span>181<a name="_GoBack"></a></span></p>
                </td>
                <td width="385" style="width:289.1pt;
                ;
                background:#ececec">
                <p class="MsoNormal" style="text-align:justify"><span>Abhayam Women helpline</span></p>
                </td>
            </tr>
            <tr>
                <td width="48" style="width:35.75pt;">
                <p class="MsoNormal" align="center" style="text-align:center"><span>4</span></p>
                </td>
                <td width="168" style="width:1.75in;">
                <p class="MsoNormal" style="text-align:justify"><span>101<a name="_GoBack"></a></span></p>
                </td>
                <td width="385" style="width:289.1pt;">
                <p class="MsoNormal" style="text-align:justify"><span>Fire</span></p>
                </td>
            </tr>
            <tr>
                <td width="48" style="width:35.75pt;background:#ececec">
                <p class="MsoNormal" align="center" style="text-align:center"><span>5</span></p>
                </td>
                <td width="168" style="width:1.75in;
                ;
                background:#ececec">
                <p class="MsoNormal" style="text-align:justify"><span>1072<a name="_GoBack"></a></span></p>
                </td>
                <td width="385" style="width:289.1pt;
                ;
                background:#ececec">
                <p class="MsoNormal" style="text-align:justify"><span>Railway Accident Emergency Services</span></p>
                </td>
            </tr>
            <tr>
                <td width="48" style="width:35.75pt;">
                <p class="MsoNormal" align="center" style="text-align:center"><span>6</span></p>
                </td>
                <td width="168" style="width:1.75in;">
                <p class="MsoNormal" style="text-align:justify"><span>1090<a name="_GoBack"></a></span></p>
                </td>
                <td width="385" style="width:289.1pt;">
                <p class="MsoNormal" style="text-align:justify"><span>Crime Stopper</span></p>
                </td>
            </tr>
            <tr>
                <td width="48" style="width:35.75pt;background:#ececec">
                <p class="MsoNormal" align="center" style="text-align:center"><span>7</span></p>
                </td>
                <td width="168" style="width:1.75in;
                ;
                background:#ececec">
                <p class="MsoNormal" style="text-align:justify"><span>1073<a name="_GoBack"></a></span></p>
                </td>
                <td width="385" style="width:289.1pt;
                ;
                background:#ececec">
                <p class="MsoNormal" style="text-align:justify"><span>Traffic Help</span></p>
                </td>
            </tr>
            <tr>
                <td width="48" style="width:35.75pt;">
                <p class="MsoNormal" align="center" style="text-align:center"><span>8</span></p>
                </td>
                <td width="168" style="width:1.75in;">
                <p class="MsoNormal" style="text-align:justify"><span>1091, 1291<a name="_GoBack"></a></span></p>
                </td>
                <td width="385" style="width:289.1pt;">
                <p class="MsoNormal" style="text-align:justify"><span>Senior Citizen Helpline</span></p>
                </td>
            </tr>
            <tr>
                <td width="48" style="width:35.75pt;background:#ececec">
                <p class="MsoNormal" align="center" style="text-align:center"><span>9</span></p>
                </td>
                <td width="168" style="width:1.75in;
                ;
                background:#ececec">
                <p class="MsoNormal" style="text-align:justify"><span>1070<a name="_GoBack"></a></span></p>
                </td>
                <td width="385" style="width:289.1pt;
                ;
                background:#ececec">
                <p class="MsoNormal" style="text-align:justify">Rescue & Relief Helpline<span>Traffic Help</span></p>
                </td>
            </tr>
            <tr>
                <td width="48" style="width:35.75pt;">
                <p class="MsoNormal" align="center" style="text-align:center"><span>10</span></p>
                </td>
                <td width="168" style="width:1.75in;">
                <p class="MsoNormal" style="text-align:justify"><span>1098<a name="_GoBack"></a></span></p>
                </td>
                <td width="385" style="width:289.1pt;">
                <p class="MsoNormal" style="text-align:justify"><span>Child Helpline</span></p>
                </td>
            </tr>
            <tr>
                <td width="48" style="width:35.75pt;background:#ececec">
                <p class="MsoNormal" align="center" style="text-align:center"><span>11</span></p>
                </td>
                <td width="168" style="width:1.75in;
                ;
                background:#ececec">
                <p class="MsoNormal" style="text-align:justify"><span>9540161344<a name="_GoBack"></a></span></p>
                </td>
                <td width="385" style="width:289.1pt;
                ;
                background:#ececec">
                <p class="MsoNormal" style="text-align:justify">Air Ambulance<span>Traffic Help</span></p>
                </td>
            </tr>
            <tr>
                <td width="48" style="width:35.75pt;">
                <p class="MsoNormal" align="center" style="text-align:center"><span>12</span></p>
                </td>
                <td width="168" style="width:1.75in;">
                <p class="MsoNormal" style="text-align:justify"><span>103<a name="_GoBack"></a></span></p>
                </td>
                <td width="385" style="width:289.1pt;">
                <p class="MsoNormal" style="text-align:justify"><span>Traffic Police</span></p>
                </td>
            </tr>  
            <tr>
                <td width="48" style="width:35.75pt;background:#ececec">
                <p class="MsoNormal" align="center" style="text-align:center"><span>13</span></p>
                </td>
                <td width="168" style="width:1.75in;
                ;
                background:#ececec">
                <p class="MsoNormal" style="text-align:justify"><span>011-24363260<a name="_GoBack"></a></span></p>
                </td>
                <td width="385" style="width:289.1pt;
                ;
                background:#ececec">
                <p class="MsoNormal" style="text-align:justify"><span>N.D.R.F</span></p>
                </td>
            </tr>
        </tbody>
    </table>
</div>



  <?php require 'signin.php'?>

  <?php require './includes/footer.php'?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="./js/script.js"></script>
 
  
</body>
<script>
  function startSpinner(){
    $(".loader").css("display", "none");
  }
</script>
</html>