<?php
include("connexion.php");

/* AJOUT PRODUIT */
if(isset($_POST['ajouter'])){

    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

        $image = time() . "_" . basename($_FILES['image']['name']);
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "images/".$image);

        $stmt = $conn->prepare("INSERT INTO produits(nom, description, prix, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $nom, $description, $prix, $image);
        $stmt->execute();
        $stmt->close();

        $success = "Produit ajouté avec succès !";
    } else {
        $error = "Veuillez choisir une image.";
    }
}

/* SUPPRIMER PRODUIT */
if(isset($_GET['supprimer'])){
    $id = intval($_GET['supprimer']);

    $res = $conn->query("SELECT image FROM produits WHERE id=$id");
    $img = $res->fetch_assoc();

    if($img && file_exists("images/".$img['image'])){
        unlink("images/".$img['image']);
    }

    $conn->query("DELETE FROM produits WHERE id=$id");

    header("Location: produits.php");
    exit();
}

$result = $conn->query("SELECT * FROM produits ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Gestion Produits</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    background:#f5f6fa;
}

.card-form{
    background:#fff;
    padding:20px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.product-img{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:10px;
}

.table-box{
    background:#fff;
    padding:20px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}
</style>

</head>

<body>

<div class="container py-4">

<h2 class="mb-4">
<i class="bi bi-box"></i> Gestion des Produits
</h2>

<div class="d-flex justify-content-end mb-3">
    <a href="dashboard.php" class="btn btn-secondary">
        Retour Dashboard
    </a>
</div>


<!-- MESSAGE -->
<?php if(isset($success)): ?>
<div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>

<?php if(isset($error)): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<!-- FORMULAIRE -->
<div class="card-form mb-4">

<h4>Ajouter un produit</h4>

<form method="POST" enctype="multipart/form-data" class="row g-3">

<div class="col-md-4">
<input type="text" name="nom" class="form-control" placeholder="Nom produit" required>
</div>

<div class="col-md-4">
<input type="number" name="prix" class="form-control" placeholder="Prix" required>
</div>

<div class="col-md-4">
<input type="file" name="image" class="form-control" required>
</div>

<div class="col-12">
<textarea name="description" class="form-control" placeholder="Description" required></textarea>
</div>

<div class="col-12">
<button name="ajouter" class="btn btn-primary">
<i class="bi bi-plus-circle"></i> Ajouter
</button>
</div>

</form>

</div>

<!-- TABLE -->
<div class="table-box">

<h4 class="mb-3">Liste des produits</h4>

<div class="table-responsive">

<table class="table table-striped align-middle">

<thead class="table-dark">
<tr>
<th>Image</th>
<th>Nom</th>
<th>Description</th>
<th>Prix</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td>
<img src="images/<?= $row['image'] ?>" class="product-img">
</td>

<td><?= htmlspecialchars($row['nom']) ?></td>

<td><?= htmlspecialchars($row['description']) ?></td>

<td><b><?= number_format($row['prix']) ?> FCFA</b></td>

<td>
<a href="?supprimer=<?= $row['id'] ?>"
onclick="return confirm('Supprimer ce produit ?')"
class="btn btn-danger btn-sm">
Supprimer
</a>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>