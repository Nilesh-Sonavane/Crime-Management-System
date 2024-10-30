<?php
    require_once "database.php";

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;


    require './PHPMailer/PHPMailer/src/Exception.php';
    require './PHPMailer/PHPMailer/src/PHPMailer.php';
    require './PHPMailer/PHPMailer/src/SMTP.php';

    if($_POST["payment_id"]){

        $userId = $_POST["uid"];
        $payment_id = $_POST["payment_id"]; 
        $arrested_id = $_POST["arrested_id"];
        $order_id = $_POST["order_id"];


        $sql = "SELECT * FROM user WHERE user_id=$userId"; 
        $result =$conn->query($sql);
        $row = $result->fetch_assoc();

        
        $user_email = $row['email'];
        $user_name = ucfirst($row['fname']);
        
        $arrested_sql =  "SELECT * FROM arrested_person WHERE arrested_id=$arrested_id";
        $arrested_result = $conn->query($arrested_sql);
        $arrested_row = $arrested_result->fetch_assoc();
        $amount = $arrested_row['bail_amount'];


        $update_arrested = "UPDATE `arrested_person` SET `payment_id`='$payment_id' WHERE `arrested_id`=$arrested_id";
        
        
        if($conn->query($update_arrested)){

            $name = "Crime Management System";
            $email = $user_email;
            $subject = "Payment Confirmation";
            $message = '
                        <div class="container" style="max-width: 600px;"margin:auto;background-color: #d8d8d8;padding: 20px;border-radius: 8px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                        <h1 style="color: #4CAF50;">Payment Successful</h1>
                        <p style="color: #333333;">Dear '. $user_name.',</p>
                        <p style="color: #333333;">Your payment of ₹'.$amount.' has been successfully processed.</p>
                        <p style="color: #333333;">Payment ID: '.$payment_id.'</p>
                        <p style="color: #333333;">Thank you for choosing our service. If you have any questions, feel free to contact us.</p>
                        <p style="color: #333333;">Best Regards,<br>BharatSuraksha.com</p>
                        </div>
                        ';

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
        }
    }
        
    
    ?>