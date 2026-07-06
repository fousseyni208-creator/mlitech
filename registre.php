<?php
session_start();

include("connexion.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(isset($_POST['registre'])){

    $name = $_POST['name'];
    $email = $_POST['email'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $otp = rand(100000,999999);

    $sql = "
        INSERT INTO users(name,email,password,otp)
        VALUES('$name','$email','$password','$otp')
    ";

    if($conn->query($sql)){

        $_SESSION['user_id'] = $conn->insert_id;

        $mail = new PHPMailer(true);

        try{

            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';

            $mail->SMTPAuth = true;

            $mail->Username = 'mlitech00223@gmail.com';

            $mail->Password = 'mpzxpysluihwicvc';

            $mail->SMTPSecure = 'tls';

            $mail->Port = 587;

            $mail->setFrom(
                'mlitech00223@gmail.com',
                'MLI TECH'
            );

            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->Subject = 'Code OTP';

            $mail->Body = "
                <h2>Confirmation Email</h2>

                <p>Votre code de validation OTP est :</p>

                <h1>$otp</h1>
            ";

            $mail->send();

            header("Location: verify.php");
            exit();

        }catch(Exception $e){

            echo "Erreur Email : "
                 . $mail->ErrorInfo;
        }

    }else{

        echo "Erreur inscription : "
             . $conn->error;
    }
}
?>
