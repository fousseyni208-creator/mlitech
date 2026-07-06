<?php
session_start();
require_once("connexion.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

/* Bloquer */
if(isset($_GET['block'])){

    $id = intval($_GET['block']);

    if($id != $_SESSION['user_id']){
        $conn->query("UPDATE users SET status='blocked' WHERE id='$id'");
    }

    header("Location: utilisateurs.php");
    exit();
}

/* Débloquer */
if(isset($_GET['unblock'])){

    $id = intval($_GET['unblock']);

    $conn->query("UPDATE users SET status='active' WHERE id='$id'");

    header("Location: utilisateurs.php");
    exit();
}

/* Supprimer */
if(isset($_GET['delete'])){

    $id = intval($_GET['delete']);

    if($id != $_SESSION['user_id']){
        $conn->query("DELETE FROM users WHERE id='$id'");
    }

    header("Location: utilisateurs.php");
    exit();
}

/* Donner admin */
if(isset($_GET['makeadmin'])){

    $id = intval($_GET['makeadmin']);

    $conn->query("UPDATE users SET role='admin' WHERE id='$id'");

    header("Location: utilisateurs.php");
    exit();
}

/* Retirer admin */
if(isset($_GET['removeadmin'])){

    $id = intval($_GET['removeadmin']);

    if($id != $_SESSION['user_id']){
        $conn->query("UPDATE users SET role='user' WHERE id='$id'");
    }

    header("Location: utilisateurs.php");
    exit();
}

$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Gestion Utilisateurs</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-4">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des Utilisateurs</h2>

    <a href="dashboard.php" class="btn btn-secondary">
        Retour Dashboard
    </a>
</div>

<div class="table-responsive">

<table class="table table-bordered table-striped bg-white">

<thead class="table-dark">

<tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Email</th>
    <th>Vérifié</th>
    <th>Rôle</th>
    <th>Statut</th>
    <th>Actions</th>
</tr>

</thead>

<tbody>

<?php while($user = $users->fetch_assoc()){ ?>

<tr>

<td><?= $user['id']; ?></td>

<td><?= htmlspecialchars($user['name']); ?></td>

<td><?= htmlspecialchars($user['email']); ?></td>

<td>
<?php
echo $user['is_verified']
? "<span class='badge bg-success'>Oui</span>"
: "<span class='badge bg-danger'>Non</span>";
?>
</td>

<td>
<?php
echo $user['role'] == 'admin'
? "<span class='badge bg-primary'>Admin</span>"
: "<span class='badge bg-secondary'>Utilisateur</span>";
?>
</td>

<td>
<?php
echo $user['status'] == 'blocked'
? "<span class='badge bg-warning'>Bloqué</span>"
: "<span class='badge bg-success'>Actif</span>";
?>
</td>

<td>

<?php if($user['status']=='active'){ ?>

<a href="?block=<?= $user['id']; ?>"
class="btn btn-warning btn-sm mb-1">
Bloquer
</a>

<?php } else { ?>

<a href="?unblock=<?= $user['id']; ?>"
class="btn btn-success btn-sm mb-1">
Débloquer
</a>

<?php } ?>

<?php if($user['role']=='user'){ ?>

<a href="?makeadmin=<?= $user['id']; ?>"
class="btn btn-primary btn-sm mb-1">
Admin
</a>

<?php } else { ?>

<a href="?removeadmin=<?= $user['id']; ?>"
class="btn btn-info btn-sm mb-1">
Retirer
</a>

<?php } ?>

<a href="?delete=<?= $user['id']; ?>"
onclick="return confirm('Supprimer cet utilisateur ?')"
class="btn btn-danger btn-sm mb-1">
Supprimer
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>