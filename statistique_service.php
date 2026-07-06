<?php
session_start();
require_once("connexion.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

/* Token de sécurité */
if(empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* Supprimer une demande */
if(isset($_POST['delete_id'])){

    if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']){
        $_SESSION['message'] = "Action non autorisée.";
        $_SESSION['message_type'] = "danger";

        header("Location: demandes.php");
        exit();
    }

    $id = intval($_POST['delete_id']);

    $stmt = $conn->prepare("DELETE FROM demandes_services WHERE id = ?");

    if($stmt){
        $stmt->bind_param("i", $id);

        if($stmt->execute()){
            $_SESSION['message'] = "La demande a été supprimée avec succès.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de la suppression.";
            $_SESSION['message_type'] = "danger";
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Erreur SQL lors de la suppression.";
        $_SESSION['message_type'] = "danger";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
        exit();
}

/* Liste des demandes */
$result = $conn->query("
SELECT *
FROM demandes_services
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Demandes de Services</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.card-box{
    background:white;
    border-radius:15px;
    padding:20px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.table td,
.table th{
    vertical-align:middle;
}

</style>

</head>

<body>

<div class="container py-4">

<?php if(isset($_SESSION['message'])){ ?>

<div class="alert alert-<?= htmlspecialchars($_SESSION['message_type']); ?> alert-dismissible fade show" role="alert">
    <?= htmlspecialchars($_SESSION['message']); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<?php
unset($_SESSION['message']);
unset($_SESSION['message_type']);
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>
<i class="bi bi-briefcase"></i>
Demandes de Services
</h2>

<a href="dashboard.php" class="btn btn-secondary">
    <i class="bi bi-arrow-left"></i>
    Retour Dashboard
</a>

</div>

<div class="card-box">

<div class="table-responsive">

<table class="table table-bordered table-striped align-middle">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>Service</th>
<th>Nom</th>
<th>Email</th>
<th>Téléphone</th>
<th>Entreprise</th>
<th>Capacité</th>
<th>Date</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php if($result && $result->num_rows > 0){ ?>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?= htmlspecialchars($row['id']); ?></td>

<td><?= htmlspecialchars($row['service']); ?></td>

<td><?= htmlspecialchars($row['nom']); ?></td>

<td><?= htmlspecialchars($row['email']); ?></td>

<td><?= htmlspecialchars($row['telephone']); ?></td>

<td><?= htmlspecialchars($row['entreprise']); ?></td>

<td><?= htmlspecialchars($row['capacite']); ?></td>

<td><?= htmlspecialchars($row['date_demande']); ?></td>

<td>

<form method="POST" class="d-inline"
      onsubmit="return confirm('Voulez-vous vraiment supprimer cette demande ?');">

    <input type="hidden" name="delete_id" value="<?= htmlspecialchars($row['id']); ?>">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">

    <button type="submit" class="btn btn-danger btn-sm">
        <i class="bi bi-trash"></i>
        Supprimer
    </button>

</form>

</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>
<td colspan="9" class="text-center text-muted">
    Aucune demande de service trouvée.
</td>
</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>