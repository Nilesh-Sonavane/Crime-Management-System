<?php
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;


    require './PHPMailer/PHPMailer/src/Exception.php';
    require './PHPMailer/PHPMailer/src/PHPMailer.php';
    require './PHPMailer/PHPMailer/src/SMTP.php';

    if($_POST["email"]){

        $otp = $_POST["otp"]; 

        $name = "Crime Management System";
        $email = $_POST["email"];
        $subject = "FIR Registration Confirmation";
        $message = "Use OTP <b> $otp </b> for email varification, and complete registration in crime management system portal.";
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
        
            
?>