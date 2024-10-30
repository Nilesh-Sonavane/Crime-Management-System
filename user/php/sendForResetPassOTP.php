<?php

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;

    include 'database.php';

    require './PHPMailer/PHPMailer/src/Exception.php';
    require './PHPMailer/PHPMailer/src/PHPMailer.php';
    require './PHPMailer/PHPMailer/src/SMTP.php';
    
    if($_POST["email"]){

        $email = $_POST["email"];
        $otp = $_POST["otp"]; 

        $sql_count = "SELECT * FROM user WHERE email='$email'";
        $result_count =$conn->query($sql_count);
        $row_count = mysqli_num_rows($result_count); 
        $check_user_email = $row_count;

        if($check_user_email!=0){

            $name = "Crime Management System";
            $email = $_POST["email"];
            $subject = "Password Reset Confirmation";
            $message = "Use OTP <b> $otp </b> for email varification, and Reset Your Password in crime management system portal.";
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
            echo "0";
        }

    }
        
            
?>