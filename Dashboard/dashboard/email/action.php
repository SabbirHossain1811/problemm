<?php

include '../../config/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../../src/PHPMailer.php';
require '../../src/SMTP.php';
require '../../src/Exception.php';

if(isset($_POST['sent_email'])){

    $sender_name = $_POST['name'];
    $sender_email = $_POST['email'];
    $sender_body = $_POST['body'];


    if($sender_name && $sender_email && $sender_name){

        $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'sabbirahammad1811@gmail.com';                     //SMTP username
            $mail->Password   = 'vmchggtcvkcpiurk';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

            //Recipients
            $mail->setFrom($mail->Username, 'Cats Lover ');
            $mail->addAddress($sender_email, $sender_name);     //Add a recipient            //Name is optional
            $mail->addReplyTo($mail->Username);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Thank You..';
            $mail->Body    = "Hi $sender_name,
                                <br>
                                Thank you so much for your support and trust. Its been a pleasure working with you. Looking forward to our continued collaboration!
                                <br>
                                Best Regurds,
                                <br>
                                'Unknown Man..'";

             if($mail->send()){
                $insert_query = "INSERT INTO emails (name,email,body) VALUES ('$sender_name','$sender_email','$sender_body')";

                mysqli_query($db,$insert_query);
    
                header('location:../../index.php#contact');
             }

    }


}



?>