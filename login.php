<?php
session_start();

require_once("connexion.php");

$error = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){

            // Vérifier si le compte est bloqué
            if(isset($user['status']) && $user['status'] == 'blocked'){

                $error = "Votre compte a été bloqué par l'administrateur.";

            }else{

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];

                if($user['role'] == 'admin'){
                    header("Location: dashboard.php");
                    exit();
                }else{
                    header("Location: accueil2.php");
                    exit();
                }

            }

        }else{

            $error = "Mot de passe incorrect";

        }

    }else{

        $error = "Utilisateur introuvable";

    }

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Connexion - MLI TECH</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
    padding:20px;
}

.login-box{
    width:100%;
    max-width:380px;
    background:white;
    padding:40px 30px;
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
    color:#111827;
}

p{
    color:gray;
    margin-bottom:25px;
    font-size:14px;
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

.input-box input{
    width:100%;
    padding:14px 14px 14px 45px;
    border:1px solid #ddd;
    border-radius:10px;
    outline:none;
    font-size:15px;
    transition:0.3s;
}

.input-box input:focus{
    border-color:#2563eb;
    box-shadow:0 0 10px rgba(37,99,235,0.2);
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
    transition:0.3s;
}

button:hover{
    background:#1d4ed8;
}

.error{
    background:#fee2e2;
    color:#dc2626;
    padding:10px;
    border-radius:8px;
    margin-bottom:15px;
    font-size:14px;
}

.footer{
    margin-top:20px;
    font-size:14px;
}

.footer a{
    color:#2563eb;
    text-decoration:none;
    font-weight:bold;
}

@media(max-width:576px){

.login-box{
    padding:30px 20px;
}

.logo{
    font-size:45px;
}

h2{
    font-size:24px;
}
.toggle-password{
    position:absolute;
    right:15px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
    color:gray;
    font-size:18px;
}

.input-box input{
    width:100%;
    padding:14px 45px 14px 45px;
    border:1px solid #ddd;
    border-radius:10px;
    outline:none;
    font-size:15px;
    transition:0.3s;
}

}

</style>

</head>
<body>
    

<div class="login-box">

    <div class="logo">
        <i class="bi bi-shield-lock-fill"></i>
    </div>

    <h2>MLI TECH</h2>

    <p>Connexion sécurisée à votre compte</p>

    <?php if(!empty($error)){ ?>
        <div class="error">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="input-box">
            <i class="bi bi-envelope-fill"></i>
            <input type="email" name="email" placeholder="Adresse Email" required>
        </div>

        <div class="input-box">
    <i class="bi bi-lock-fill"></i>

    <input
        type="password"
        id="password"
        name="password"
        placeholder="Mot de passe"
        required>

    <span class="toggle-password" onclick="togglePassword()">
        <i id="eyeIcon" class="bi bi-eye-fill"></i>
    </span>
</div>

        <button type="submit" name="login">
            Se connecter
        </button>

    </form>

    <div class="footer">
        Pas de compte ?
        <a href="formulaire.php">S'inscrire</a>
    </div>

</div>
<script>

function togglePassword(){

    let password = document.getElementById("password");
    let eyeIcon = document.getElementById("eyeIcon");

    if(password.type === "password"){

        password.type = "text";
        eyeIcon.classList.remove("bi-eye-fill");
        eyeIcon.classList.add("bi-eye-slash-fill");

    }else{

        password.type = "password";
        eyeIcon.classList.remove("bi-eye-slash-fill");
        eyeIcon.classList.add("bi-eye-fill");

    }

}

</script>
</body>
</html>