<?php
session_start();

require_once("connexion.php");

if(!isset($_SESSION['user_id'])){
    die("Veuillez vous connecter");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);

$user = $result->fetch_assoc();

if(isset($_POST['pay'])){

    $equipment = $_POST['equipment'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

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
            '$equipment',
            '$amount',
            '$payment_method',
            'Succès'
        )
    ";

    if($conn->query($insert)){

        $success = "Paiement effectué avec succès";

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
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
}

.payment-box{
    width:400px;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
    text-align:center;
}

.logo{
    font-size:55px;
    color:#2563eb;
    margin-bottom:10px;
}

h2{
    margin-bottom:10px;
}

p{
    color:gray;
    margin-bottom:25px;
}

.input-box{
    position:relative;
    margin-bottom:20px;
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
}

.error{
    background:#fee2e2;
    color:#dc2626;
    padding:10px;
    border-radius:10px;
    margin-bottom:15px;
}

</style>

</head>
<body>

<div class="payment-box">

    <div class="logo">
        <i class="bi bi-credit-card-fill"></i>
    </div>

    <h2>MLI TECH</h2>

    <p>Paiement sécurisé</p>

    <?php
    if(isset($success)){
        echo "<div class='success'>$success</div>";
    }

    if(isset($error)){
        echo "<div class='error'>$error</div>";
    }
    ?>

    <form method="POST">

        <div class="input-box">

            <i class="bi bi-pc-display"></i>

            <input type="text"
                   name="equipment"
                   placeholder="Equipement acheté"
                   required>

        </div>

        <div class="input-box">

            <i class="bi bi-cash-stack"></i>

            <input type="number"
                   name="amount"
                   placeholder="Montant FCFA"
                   required>

        </div>

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

                <option value="Mobile Money">
                    Mobile Money
                </option>

            </select>

        </div>

        <button type="submit" name="pay">

            Payer maintenant

        </button>

    </form>

</div>

</body>
</html>