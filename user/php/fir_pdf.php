<?php
    // require '../../../vendor/autoload.php';

    include_once './database.php';
    if(!isset($_SESSION['uid'])){
        header('Location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #body{
            font-style:'Arial';
            margin:10px 475px;
            /* border: 1px solid red; */
            padding:10px 25px;

        }
        h1{
            font-size:30px;
        }
        p,pre{
            word-wrap: break-word;
            font-size:18px;
        }
    </style>
</head>
<body >
    <div id="body">

    
<?php
    if(isset($_GET['firid'])){
            $fir_id =  $_GET['firid'];
            $sql = "SELECT * FROM fir WHERE fir_id=$fir_id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $crime_id =  $row['crime_id'];
        
            $user_id = $row['user_id'];
            $userSql = "SELECT * FROM user WHERE user_id = $user_id";
            $userResult = $conn->query($userSql);
            $userRow = $userResult->fetch_assoc();
        if($crime_id==1){

                $mobileSql = "SELECT * FROM mobile_fir WHERE fir_id=$fir_id";
                $mobileResult =  $conn->query($mobileSql);
                $mobileRow = $mobileResult->fetch_assoc();

                $station_id =  $mobileRow['station_id'];
                $stationSql = "SELECT * FROM police_station WHERE station_id = $station_id";
                $stationResult =  $conn->query($stationSql);
                $stationRow = $stationResult->fetch_assoc();

                $city_id = $stationRow['city_id'];
                $citySql = "SELECT * FROM cities WHERE city_id = $city_id";
                $cityResult =  $conn->query($citySql);
                $cityRow = $cityResult->fetch_assoc();
                
                $state_id = $cityRow['state_id'];
                $stateSql = "SELECT * FROM states WHERE state_id = $state_id";
                $stateResult =  $conn->query($stateSql);
                $stateRow = $stateResult->fetch_assoc();


                ?>
                   <h1 style="text-align:center"><?php echo strtoupper($stationRow['station_name']);?></h1>
                    <p>
                        <pre>

                            FIR Number : <?php echo $row['fir_id'];?>

                            Date       : <?php echo $row['fir_date'];?>

                            Time       : <?php echo $row['fir_time'];?>
                            
                        </pre>
                    </p>
                    <p>
                        To,
                        The Officer-in-Charge,
                        <?php echo $stationRow['station_name'];?>,<br>
                        <?php echo $stationRow['address'];?>,<br>
                        <?php echo $cityRow['city_name'];?>, <?php echo $stateRow['state_name'];?><br>
                        <br>
                    </p>
                    <p>
                        Subject:<b> FIR for Mobile Theft</b>
                    </p>
                    <p>
                        I, <?php echo $userRow['fname']?> <?php echo $userRow['mname']?> <?php echo $userRow['lname']?>, residing at <?php echo $userRow['address']?>, want to file an FIR for <br>   the theft of my mobile phone.
                        
                    </p>
                    <p> 

                        Details of the stolen mobile phone: <br>
                        Make/Model: <?php echo $mobileRow['brand']?>/<?php echo $mobileRow['model']?><br>
                        IMEI Number: <?php echo $mobileRow['imei_no']?><br>
                        Description: Color Is <?php echo $mobileRow['color']?><br>
                        The theft occurred on <?php echo $mobileRow['date_of_theft']?> at approximately <?php echo $mobileRow['time_of_theft']?>.
                    </p>
                    <p>

                        I request the authorities to take immediate action in investigating this matter. 
                        I am willing to provide any further information or assistance necessary for the investigation.
                        
                        I solemnly declare that the above-stated information is true to the best of my knowledge and belief.
                        
                        Thank you for your prompt attention to this complaint.
                    </p>
                    <br>
                    <p>
                            Yours faithfully,<b> <br>
                            <?php echo $userRow['fname']?> <?php echo $userRow['mname']?> <?php echo $userRow['lname']?><br>
                            Mo    : <?php echo $userRow['contact']?><br>
                            Email : <?php echo $userRow['email']?></b><br>
                        </p>
    
                <?php

        }
        else if($crime_id==2){ 
            $vehicalSql = "SELECT * FROM vehical_fir WHERE fir_id=$fir_id";
            $vehicalResult =  $conn->query($vehicalSql);
            $vehicalRow = $vehicalResult->fetch_assoc();
    
            $station_id =  $vehicalRow['station_id'];
            $stationSql = "SELECT * FROM police_station WHERE station_id = $station_id";
            $stationResult =  $conn->query($stationSql);
            $stationRow = $stationResult->fetch_assoc();
    
            $city_id = $stationRow['city_id'];
            $citySql = "SELECT * FROM cities WHERE city_id = $city_id";
            $cityResult =  $conn->query($citySql);
            $cityRow = $cityResult->fetch_assoc();
            
            $state_id = $cityRow['state_id'];
            $stateSql = "SELECT * FROM states WHERE state_id = $state_id";
            $stateResult =  $conn->query($stateSql);
            $stateRow = $stateResult->fetch_assoc();
    
            ?>
                   <h1 style="text-align:center"><?php echo strtoupper($stationRow['station_name']);?></h1>
                    <p>
                        <pre>
    
                            FIR Number : <?php echo $row['fir_id'];?>
    
                            Date       : <?php echo $row['fir_date'];?>
    
                            Time       : <?php echo $row['fir_time'];?>
                            
                        </pre>
                    </p>
                    <p>
                        To,
                        The Officer-in-Charge,
                        <?php echo $stationRow['station_name'];?>,<br>
                        <?php echo $stationRow['address'];?>,<br>
                        <?php echo $cityRow['city_name'];?>, <?php echo $stateRow['state_name'];?>
                        <br>
                    </p>
                    <p>
                        Subject:<b> FIR for Vehical Theft</b>
                    </p>
                    <p>
                        I, <?php echo $userRow['fname']?> <?php echo $userRow['mname']?> <?php echo $userRow['lname']?>, residing at <?php echo $userRow['address']?>, wish to file an FIR for the theft of my vehicle.
                        
                    </p>
                    <p> 
    
                        Details of the stolen vehical: <br>
                        Vehicle Make/Model: <?php echo $vehicalRow['brand'];?> <?php echo $vehicalRow['model_name'];?> <br>
                        Registration Number: <?php echo $vehicalRow['plate_no'];?> <br>
                        Description: Modle Year Is <?php echo $vehicalRow['model_year'];?> And Color Is <?php echo $vehicalRow['color'];?><br>
    
                        The theft occurred on <?php echo $vehicalRow['date_of_theft'];?> at approximately <?php echo $vehicalRow['time_of_theft'];?>. The vehicle was parked at <?php echo $vehicalRow['location_of_theft'];?> when it was stolen.
                    </p>
                    <p>
                        I urge the authorities to initiate immediate action to locate and recover the stolen vehicle. I am fully cooperating and am willing to provide any further information or assistance needed for the investigation.
                    
                        I declare that the information provided above is accurate and true to the best of my knowledge and belief.
    
                        I request your prompt attention and action in this matter.
                    </p>
                    <p>
                            Yours faithfully,<b> <br>
                            <?php echo $userRow['fname']?> <?php echo $userRow['mname']?> <?php echo $userRow['lname']?><br>
                            Mo    : <?php echo $userRow['contact']?><br>
                            Email : <?php echo $userRow['email']?></b><br>
                        </p>
    
                <?php
    
        }
    } 

    
    ?>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="./js/script.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js" integrity="sha512-sn/GHTj+FCxK5wam7k9w4gPPm6zss4Zwl/X9wgrvGMFbnedR8lTUSLdsolDRBRzsX6N+YgG6OWyvn9qaFVXH9w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script>
    

    $( document ).ready(function() {

     const elementToCapture = document.getElementById('body');
     window.jsPDF = window.jspdf.jsPDF;

       html2canvas(elementToCapture).then(canvas => {
         const imgData = canvas.toDataURL('image/png');
         const pdf = new jsPDF('p', 'mm', 'a4');
         const imgWidth = 210; // A4 size
         const imgHeight = (canvas.height * imgWidth) / canvas.width;
         pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
         const d = new Date();
         const date =  d.getDate() +""+ (d.getMonth()+1) + "" + d.getFullYear()+""+d.getHours()+""+d.getMinutes()+""+d.getSeconds();
         pdf.save(date+'.pdf')
         });
        
       });
    
</script>
