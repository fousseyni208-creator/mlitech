<?php
session_start();

require_once("connexion.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(!isset($_SESSION['user_id'])){
    die("Veuillez vous connecter");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);

$user = $result->fetch_assoc();

/*
|--------------------------------------------------------------------------
| Récupération des produits du panier
|--------------------------------------------------------------------------
*/

$equipments = isset($_POST['equipments'])
    ? $_POST['equipments']
    : [];

$total = 0;

foreach($equipments as $item){

    $total += $item['price'];
}

/*
|--------------------------------------------------------------------------
| Paiement
|--------------------------------------------------------------------------
*/

if(isset($_POST['pay'])){

    $payment_method = $_POST['payment_method'];

    $phone = $_POST['phone'];

    $client_email = $_POST['client_email'];

    /*
    |--------------------------------------------------------------------------
    | Liste des produits
    |--------------------------------------------------------------------------
    */

    $product_list = [];

    foreach($equipments as $item){

        $product_list[] = $item['name']." x1";
    }

    $products = implode(", ", $product_list);

    /*
    |--------------------------------------------------------------------------
    | Génération ID transaction
    |--------------------------------------------------------------------------
    */

    $transaction_id = "SIM".rand(1000000000,9999999999);

    /*
    |--------------------------------------------------------------------------
    | Insertion base de données
    |--------------------------------------------------------------------------
    */

    $insert = "
        INSERT INTO payments(
            user_id,
            equipment,
            amount,
            payment_method,
            status
        )

        VALUES(
            '$user_id',
            '$products',
            '$total',
            '$payment_method',
            'Succès'
        )
    ";

    if($conn->query($insert)){

        /*
        |--------------------------------------------------------------------------
        | Email
        |--------------------------------------------------------------------------
        */

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

            $mail->addAddress($client_email);

            $mail->isHTML(true);

            $mail->Subject = "Paiement confirmé";

            $mail->Body = "

            <div style='font-family:Arial;padding:20px;'>

                <h2 style='color:#2563eb;'>

                    Paiement confirmé

                </h2>

                <p>

                    <b>Transaction :</b>
                    $transaction_id

                </p>

                <p>

                    <b>Méthode :</b>
                    $payment_method

                </p>

                <p>

                    <b>Numéro :</b>
                    $phone

                </p>

                <p>

                    <b>Email :</b>
                    $client_email

                </p>

                <p>

                    <b>Produits achetés :</b>
                    $products

                </p>

                <p>

                    <b>Montant :</b>
                    $total FCFA

                </p>

                <hr>

                <p>

                    Merci pour votre achat chez
                    <b>MLI TECH</b>

                </p>

            </div>

            ";

            $mail->send();
            $receiptMail = new PHPMailer(true);

try {

    $receiptMail->isSMTP();
    $receiptMail->Host = 'smtp.gmail.com';
    $receiptMail->SMTPAuth = true;

    $receiptMail->Username = 'mlitech00223@gmail.com';
    $receiptMail->Password = 'mpzxpysluihwicvc';

    $receiptMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $receiptMail->Port = 587;

    $receiptMail->setFrom('mlitech00223@gmail.com', 'MLI TECH');

    $receiptMail->addAddress($client_email);

    $receiptMail->isHTML(true);

    $receiptMail->Subject = "Accusé de réception - MLI TECH";

    $receiptMail->Body = "

    <div style='font-family:Arial;padding:20px;background:#f8fafc;'>

        <h2 style='color:#2563eb;'>MLI TECH</h2>

        <p>Bonjour,</p>

        <p>Nous confirmons la réception de votre paiement et nous vous remercions pour votre confiance.</p>

        <hr>

        <h3>Détails de votre transaction</h3>

        <p><b>Transaction :</b> $transaction_id</p>
        <p><b>Méthode :</b> $payment_method</p>
        <p><b>Produits :</b> $products</p>
        <p><b>Montant :</b> $total FCFA</p>

        <hr>

        <p>Votre commande est en cours de traitement par notre équipe technique.</p>

        <p style='color:#2563eb;'>
            Cordialement,<br>
            <b>Équipe MLI TECH</b>
        </p>

    </div>

    ";

    $receiptMail->send();

} catch (Exception $e) {
    // Optionnel : log erreur
}

            $success = "Paiement effectué avec succès";

        }catch(Exception $e){

            $error = "Erreur Email : ".$mail->ErrorInfo;
        }

    }else{

        $error = "Erreur paiement";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Paiement - MLI TECH</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
    padding:20px;
}

.payment-box{
    width:450px;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

.logo{
    font-size:55px;
    color:#2563eb;
    text-align:center;
    margin-bottom:10px;
}

h2{
    text-align:center;
    margin-bottom:10px;
}

.description{
    text-align:center;
    color:gray;
    margin-bottom:25px;
}

.product{
    background:#f8fafc;
    padding:15px;
    border-radius:10px;
    margin-bottom:10px;
    display:flex;
    justify-content:space-between;
}

.total{
    margin-top:20px;
    background:#2563eb;
    color:white;
    padding:15px;
    border-radius:10px;
    text-align:center;
    font-size:18px;
    font-weight:bold;
}

.input-box{
    position:relative;
    margin-top:20px;
}

.input-box i{
    position:absolute;
    left:15px;
    top:50%;
    transform:translateY(-50%);
    color:gray;
}

.input-box input,
.input-box select{

    width:100%;
    padding:14px 14px 14px 45px;
    border:1px solid #ddd;
    border-radius:10px;
    outline:none;
    font-size:15px;
}

button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:10px;
    background:#2563eb;
    color:white;
    font-size:16px;
    cursor:pointer;
    margin-top:20px;
}

button:hover{
    background:#1d4ed8;
}

.success{
    background:#dcfce7;
    color:#166534;
    padding:10px;
    border-radius:10px;
    margin-bottom:15px;
    text-align:center;
}

.error{
    background:#fee2e2;
    color:#dc2626;
    padding:10px;
    border-radius:10px;
    margin-bottom:15px;
    text-align:center;
}

</style>

</head>
<body>

<div class="payment-box">

    <div class="logo">
        <i class="bi bi-credit-card-fill"></i>
    </div>

    <h2>MLI TECH</h2>

    <p class="description">
        Vérification du panier avant paiement
    </p>

    <?php

    if(isset($success)){
        echo "<div class='success'>$success</div>";
    }

    if(isset($error)){
        echo "<div class='error'>$error</div>";
    }

    ?>

    <form method="POST">

        <!-- Produits -->

        <?php foreach($equipments as $index => $item){ ?>

            <div class="product">

                <span>
                    <?php echo $item['name']; ?>
                </span>

                <span>
                    <?php echo $item['price']; ?> FCFA
                </span>

            </div>

            <input type="hidden"
                   name="equipments[<?php echo $index; ?>][name]"
                   value="<?php echo $item['name']; ?>">

            <input type="hidden"
                   name="equipments[<?php echo $index; ?>][price]"
                   value="<?php echo $item['price']; ?>">

        <?php } ?>

        <!-- Total -->

        <div class="total">

            Total : <?php echo $total; ?> FCFA

        </div>

        <!-- Méthode paiement -->

        <div class="input-box">

            <i class="bi bi-phone-fill"></i>

            <select name="payment_method" required>

                <option value="">
                    Méthode de paiement
                </option>

                <option value="Orange Money">
                    Orange Money
                </option>

                <option value="Moov Money">
                    Moov Money
                </option>

                <option value="Wave">
                    Wave
                </option>

            </select>

        </div>

        <!-- Numéro -->

        <div class="input-box">

            <i class="bi bi-telephone-fill"></i>

            <input type="text"
                   name="phone"
                   placeholder="Numéro Mobile Money"
                   required>

        </div>

        <!-- Email -->

        <div class="input-box">

            <i class="bi bi-envelope-fill"></i>

            <input type="email"
                   name="client_email"
                   placeholder="Adresse Email"
                   required>

        </div>

        <!-- Bouton -->

        <button type="submit" name="pay">

            Payer maintenant

        </button>

    </form>

</div>

</body>
</html>