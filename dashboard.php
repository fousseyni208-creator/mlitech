<?php
session_start();
require_once("connexion.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Admin info */
$user = $conn->query("SELECT * FROM users WHERE id='$user_id'");
$userData = $user->fetch_assoc();

/* Stats */
$total_produits = $conn->query("SELECT COUNT(*) as t FROM produits")->fetch_assoc()['t'];
$total_users = $conn->query("SELECT COUNT(*) as t FROM users")->fetch_assoc()['t'];
$total_payments = $conn->query("SELECT COUNT(*) as t FROM payments")->fetch_assoc()['t'];
$total_demandes = $conn->query("SELECT COUNT(*) as t FROM demandes_services")->fetch_assoc()['t'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{background:#f5f5f5;}
.sidebar{
    width:250px;height:100vh;position:fixed;left:0;top:0;
    background:#212529;padding:20px;
}
.sidebar a{display:block;color:#fff;padding:10px;margin:5px 0;text-decoration:none;border-radius:8px;}
.sidebar a:hover{background:#0d6efd;}
.content{margin-left:270px;padding:20px;}
.card-box{padding:20px;border-radius:15px;color:#fff;text-align:center;}
@media(max-width:768px){.sidebar{position:relative;width:100%;height:auto}.content{margin-left:0}}
</style>
</head>

<body>

<div class="sidebar">
<h3 class="text-white">MLI TECH</h3>
<hr class="text-white">

<a href="dashboard.php"><i class="bi bi-house"></i> Dashboard</a>
<a href="utilisateurs.php"><i class="bi bi-people"></i> Utilisateurs</a>
<a href="statistique_paiement.php"><i class="bi bi-credit-card"></i> Paiements</a>
<a href="statistique_service.php"><i class="bi bi-briefcase"></i> Demandes</a>
<a href="ajout_produit.php"><i class="bi bi-box"></i> Produits</a>
<a href="accueil.php" style="background:#198754;">
    <i class="bi bi-person-circle"></i> Espace Utilisateur
</a>
<a href="logout.php"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
</div>

<div class="content">

<h2>Bienvenue <?= $userData['name']; ?></h2>

<div class="row g-3 mt-3">

<div class="col-md-3">
<div class="card-box bg-primary">
<h5>Produits</h5>
<h2><?= $total_produits ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card-box bg-success">
<h5>Utilisateurs</h5>
<h2><?= $total_users ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card-box bg-danger">
<h5>Paiements</h5>
<h2><?= $total_payments ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card-box bg-warning">
<h5>Demandes</h5>
<h2><?= $total_demandes ?></h2>
</div>
</div>

</div>

</div>

</body>
</html>