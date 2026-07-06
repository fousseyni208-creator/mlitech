<?php
session_start();

require_once("connexion.php");

$error = "";

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

$user_id = $_SESSION['user_id'];

if(isset($_POST['verify'])){

    $otp = trim($_POST['otp']);

    // Vérification OTP
    $sql = "SELECT * FROM users
            WHERE id='$user_id'
            AND otp='$otp'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){

        // Vérifier le compte
        $conn->query("
            UPDATE users
            SET is_verified='1'
            WHERE id='$user_id'
        ");

        // Récupération utilisateur
        $user = $result->fetch_assoc();

        // Sessions
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        // Redirection selon rôle
        if($user['role'] == 'admin'){

            header("Location: admin/dashboard.php");
            exit();

        }else{

            header("Location: accueil.php");
            exit();

        }

    }else{

        $error = "OTP incorrect";

    }

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Vérification OTP - MLI TECH</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
}

.card{
    width:400px;
    border:none;
    border-radius:20px;
    padding:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

.logo{
    font-size:60px;
    color:#2563eb;
}

input{
    height:50px;
    font-size:18px;
    text-align:center;
    letter-spacing:5px;
}

</style>

</head>
<body>

<div class="card text-center">

    <div class="logo mb-3">
        <i class="bi bi-shield-lock-fill"></i>
    </div>

    <h3 class="mb-2">
        Vérification OTP
    </h3>

    <p class="text-muted mb-4">
        Entrez le code envoyé à votre email
    </p>

    <?php if(!empty($error)){ ?>

        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>

    <?php } ?>

    <form method="POST">

        <input type="text"
               name="otp"
               class="form-control mb-3"
               placeholder="------"
               maxlength="6"
               required>

        <button type="submit"
                name="verify"
                class="btn btn-primary w-100">

            Vérifier le compte

        </button>

    </form>

</div>

</body>
</html>