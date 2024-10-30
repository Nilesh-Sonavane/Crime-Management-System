<?php
    // require '../../../vendor/autoload.php';
   
    include_once './database.php';
    if(!isset($_SESSION['uid'])){
        header('Location:index.php');
    }
    if(isset($_GET['id'])){

        $payment_id = $_GET['id'];
        $arrested_sql =  "SELECT * FROM arrested_person WHERE payment_id='$payment_id'";
        $arrested_result = $conn->query($arrested_sql);
        $arrested_row = $arrested_result->fetch_assoc();
        $count_rows = mysqli_num_rows($arrested_result);
        // echo $count_rows;
    }
    $payment="";

        $razorpay_key_id = 'rzp_test_TKsUUrpIbgmKdJ';
        $razorpay_key_secret = 'SY72s1O849qrW61InNhlnNRq';
            
        
            // Create a basic authentication header
            $auth_header = base64_encode($razorpay_key_id . ':' . $razorpay_key_secret);
        
            // Set up the API endpoint
            $api_endpoint = 'https://api.razorpay.com/v1/payments/' . $payment_id;
        
            // Set up the cURL request
            $ch = curl_init($api_endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Basic ' . $auth_header,
                'Content-Type: application/json',
            ));
        
            // Execute the cURL request
            $response = curl_exec($ch);
        
            // Close cURL session
            curl_close($ch);
        
            // Decode the JSON response
            $payment_details = json_decode($response, true);
        
            // Check if the request was successful
            if ($payment_details && isset($payment_details['id'])) {

                // The payment details are available in $payment_details
                $payment = $payment_details;
                // echo json_encode($payment_details);
            } else {
                // Handle the error
                echo 'Error retrieving payment details';
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
        table{
            width:100%;

        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding:10px;
        }
        th{
            width:30%;
        }
    </style>
</head>
<body>

    <?php 
        if($count_rows==1){

        ?>
            <div id="body" style="border:1px solid black">
                <div style="display:flex;">
                    <h1 style="width:80%;font-size:34px;margin-top:35px;">BharatSuraksha.com</h1>
                    <img  src="../images/Police_Logo.png" alt="Logo" hight="100px" width="100px">
                </div>
                <hr style="border-top: 2px dashed black">
                <div style="background-color:#cbc8c8;border-radius:5px;margin:10px -5px;">
                    <h1 style="text-align:center;padding:10px;color:#515055">Payment Recipt</h1>
                </div>
                <div>
                    <table>
                        <tr>
                            <th>Arrested Name</th>
                            <td><?php echo ucfirst($arrested_row['arrested_name']);?></td>
                        </tr>
                        <tr>
                            <th>Arrested Date</th>
                            <td>
                                <?php 
                                    $orgDate = $arrested_row['arrested_date'];  
                                    $newDate = date("d-m-Y", strtotime($orgDate));  
                                   
                                    echo $newDate;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Arrested Time</th>
                            <td><?php echo $arrested_row['arrested_time']?></td>
                        </tr>
                        <tr>
                            <th>Crime Type</th>
                            <td>
                                <?php
                                    $crime_id =  $arrested_row['crime_id'];
                                    $sql = "SELECT * FROM crimetype WHERE crime_id=$crime_id";
                                    $result = mysqli_query($conn, $sql);
                                    $row = $result->fetch_assoc();
                                    echo ucfirst($row['crime_name']);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Police Name</th>
                            <td>
                                <?php
                                    $police_id = $arrested_row['police_id'];
                                    $sql = "SELECT * FROM police WHERE police_id=$police_id";
                                    $result = mysqli_query($conn, $sql);
                                    $row = $result->fetch_assoc();
                                    echo ucfirst($row['first_name'])." ".ucfirst($row['middle_name'])." ".ucfirst($row['last_name']);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Police Station</th>
                            <td>
                            <?php
                                    $station_id = $arrested_row['station_id'];
                                    $sql = "SELECT * FROM police_station WHERE station_id=$station_id";
                                    $result = mysqli_query($conn, $sql);
                                    $row = $result->fetch_assoc();
                                    echo ucfirst($row['station_name']);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Bail Amount</th>
                            <td>₹<?php echo round($payment['amount']/100)?></td>
                        </tr>
                        <tr>
                            <th>Payment Id</th>
                            <td><?php echo $arrested_row['payment_id']?></td>
                        </tr>
                        <tr>
                            <th>Mode Of Payment</th>
                            <td><?php echo $payment['method']?></td>
                        </tr>
                        <tr>
                            <th>Transection Id</th>
                            <td><?php echo $payment['acquirer_data']['bank_transaction_id'];?></td>
                        </tr>
                    </table>
                    
                    <div style="margin-top:8px;display:flex;justify-content: space-between;">
                        <div style="margin-top:30px;width:75%;">
                            <?php
                            
                            include_once "phpqrcode/qrlib.php";

                            // Set it to a writable location, a place to store generated QR image files 
                            $IMG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR; 
                            
                            // Create directory if not exists 
                            if (!file_exists($IMG_TEMP_DIR)){ 
                                mkdir($IMG_TEMP_DIR); 
                            } 
                            
                            // QR image directory 
                            $IMG_WEB_DIR = 'temp/'; 
                            
                            // QR image file path 
                            $qr_file_path = $IMG_TEMP_DIR.'qrcode.png';
                        
                            // Additional config 
                            $errorCorrectionLevel = 'L'; //'L','M','Q','H' 
                            $matrixPointSize = 3; 
                            $margin = 2;
                        
                            $qrContent = "Bail Amount : ₹".round($payment['amount']/100)."\n"."Payment Id : ".$arrested_row['payment_id']."\n"."Method : ".$payment['method']."\n"."Transection Id : ".$payment['acquirer_data']['bank_transaction_id'];
                        
                            QRcode::png($qrContent, $qr_file_path, $errorCorrectionLevel, $matrixPointSize, $margin); 
                        
                            ?>
                            <img  src="<?php echo $IMG_WEB_DIR.basename($qr_file_path); ?>" />
                        </div>
                        <div style="display:inline-block;justify-content: flex-end;margin-top:30px;">
                            <h3 style="width:fit-content;margin-bottom:0px;">Total Payment</h3>
                            <h1 style="width:fit-content;padding:20px;border:1px solid black;float:right;">₹<?php echo round($payment['amount']/100)?></h1>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
    ?>
<?php
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
            pdf.save(date+'.pdf');
         });
        
       });
       
    
</script>
