<?php
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;

    include 'database.php';
    require './PHPMailer/PHPMailer/src/Exception.php';
    require './PHPMailer/PHPMailer/src/PHPMailer.php';
    require './PHPMailer/PHPMailer/src/SMTP.php';


    if(isset($_GET['addFIR'])){
        
        
        $user_id = $_POST['user_id'];
        $crime_id = $_POST['crime_id'];
        $file = $_FILES["file"]["name"];
        $IMEI_no = $_POST['IMEI_no'];
        $brand = preg_replace('!\s+!', ' ', $_POST['brand']);
        $model = preg_replace('!\s+!', ' ', $_POST['model']);
        $color = preg_replace('!\s+!', ' ', $_POST['color']);

        $add = $_POST['location_of_theft'];
        $location_of_theft = preg_replace('!\s+!', ' ', $add);

        $city = $_POST['city'];
        $police_station = $_POST['police_station'];
        $date_of_theft = $_POST['date_of_theft'];
        $time = $_POST['time_of_theft'];

        $time_of_theft = date("h:i:sa", strtotime($time));
        
        
        
        // $fir_sql="SELECT  MAX(fir_id) FROM `fir`";
        // $fir_result=$conn->query($fir_sql);
        // $fir_row=$fir_result->fetch_assoc();
        // $fir_id= $fir_row['MAX(fir_id)']+1;
        
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Ydmhis");
        $fir_id= $date;
        
        
        $userSql = "SELECT * FROM user WHERE user_id=$user_id";
        $userResult = $conn->query($userSql);
        $userRow = $userResult->fetch_assoc();

        $p_stationSql = "SELECT * FROM police_station WHERE station_id=$police_station";
        $p_stationResult = $conn->query($p_stationSql);
        $p_stationRow = $p_stationResult->fetch_assoc();

        $city_id = $p_stationRow['city_id'];
        $citySql = "SELECT * FROM cities WHERE city_id=$city_id";
        $cityResult = $conn->query($citySql);
        $cityRow = $cityResult->fetch_assoc();
        
        $target_dir = "../../uploads/";
        $sql="SELECT  MAX(mobile_fir_id) FROM `mobile_fir`";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
           // $name=date("(Y-m-d)(h-i-s)");
            
        $name=$row['MAX(mobile_fir_id)']+1;
        $target_file = $target_dir  . $name . basename($_FILES["file"]["name"]);
        $imagename=$name . basename($_FILES["file"]["name"]);
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

            $fir_date = date("Y-m-d");
            date_default_timezone_set('Asia/Kolkata');
            $fir_time = date("h:i:sa");
            $fir_status = 1;
            
            $sql1 = "INSERT INTO fir (fir_id,crime_id,user_id,fir_date,fir_time,fir_status) VALUES($fir_id,$crime_id,$user_id,'$fir_date','$fir_time',$fir_status)";
            if($conn->query($sql1)){

                $mobile_sql = "INSERT INTO mobile_fir(fir_id,imei_no,brand,model,color,location_of_theft,city_id,station_id,date_of_theft,time_of_theft,mobail_bill) VALUES ($fir_id,'$IMEI_no','$brand','$model','$color','$location_of_theft',$city,$police_station,'$date_of_theft','$time_of_theft','$imagename')";

                if($conn->query($mobile_sql)){
                    
                    $name = "Crime Management System";
                    $email = $userRow['email'];
                    $subject = "FIR Registration Confirmation";
                    $message = '<h3>Subject: FIR Registration Confirmation</h3>
                                <br>
                                Dear '.$userRow['fname'].', 
                                <br><br>
                                <p>
                                We hereby confirm the successful registration of the First Information Report (FIR) filed by you on '.$fir_date.' at '.$p_stationRow['station_name'].'/'.$cityRow['city_name'].'. <br> <b><u>Your FIR Number Is: '.$fir_id.'</u></b> Your complaint has been duly acknowledged, and our team is diligently reviewing the details provided.
                                <br><br>
                                Please keep this confirmation email for your records. Our team will be in touch with updates or any further information required throughout the investigation process. Rest assured, we are committed to addressing the matter with utmost seriousness and urgency.
                                <br><br>
                                Should you have any queries or require additional assistance, please do not hesitate to contact us at '.$p_stationRow['contact'].'.
                                <br><br>
                                Thank you for your cooperation in this matter.
                                <br><br>
                                Best regards,
                                <br><br>
                                Officer-in-Charge<br>
                                '.$p_stationRow['address'].'<br>
                                '.$p_stationRow['station_name'].'/'.$cityRow['city_name'].'<br>
                                Mo: '.$p_stationRow['contact'].'<br>
                                </p>';

                    $mail = new PHPMailer(true);

                    try{
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'userlocal634@gmail.com';
                        $mail->Password = 'knoh zvsi xyki biek';
                        $mail->Port = 465;
                        $mail->SMTPSecure = 'ssl';
                        $mail->isHTML(true);
                        $mail->setFrom($email, $name);
                        $mail->addAddress($email);
                        $mail->Subject = ("$subject");
                        $mail->Body = $message;
                        $mail->send();
                        echo "1";
                    }catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                }else{
                    echo "Error: " . $mobile_sql . "<br>" . mysqli_error($conn);
                }

            }else{
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }else{
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>