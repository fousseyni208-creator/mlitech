<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Inscription - MLI TECH</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
}

.register-box{
    width:380px;
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
}

button:hover{
    background:#1d4ed8;
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

</style>

</head>
<body>

<div class="register-box">

    <div class="logo">
        <i class="bi bi-person-plus-fill"></i>
    </div>

    <h2>MLI TECH</h2>

    <p>Créer votre compte sécurisé</p>

    <form action="registre.php" method="POST">

        <div class="input-box">
            <i class="bi bi-person-fill"></i>

            <input type="text"
                   name="name"
                   placeholder="Votre nom d'utilisateur"
                   required>
        </div>

        <div class="input-box">
            <i class="bi bi-envelope-fill"></i>

            <input type="email"
                   name="email"
                   placeholder="Adresse Email"
                   required>
        </div>

        <div class="input-box">
            <i class="bi bi-lock-fill"></i>

            <input type="password"
                   name="password"
                   placeholder="Mot de passe"
                   required>
        </div>

        <div class="input-box">
            <i class="bi bi-shield-lock-fill"></i>

            <input type="password"
                   name="confirm_password"
                   placeholder="Confirmer le mot de passe"
                   required>
        </div>

        <button type="submit" name="registre">
            S'inscrire
        </button>

    </form>

    <div class="footer">
        Déjà un compte ?
        <a href="login.php">
            Connexion
        </a>
    </div>

</div>

</body>
</html>