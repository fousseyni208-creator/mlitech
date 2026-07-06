<?php
session_start();
include("connexion.php");

/* Initialisation du panier */
if(!isset($_SESSION['panier'])){
    $_SESSION['panier'] = [];
}

/* Ajouter au panier */
if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    if($id > 0){
        if(isset($_SESSION['panier'][$id])){
            $_SESSION['panier'][$id]++;
        } else {
            $_SESSION['panier'][$id] = 1;
        }
    }
}

/* Supprimer un produit */
if(isset($_GET['supprimer'])){
    $id = intval($_GET['supprimer']);
    unset($_SESSION['panier'][$id]);
}

/* Modifier quantité */
if(isset($_POST['quantite'])){
    foreach($_POST['quantite'] as $id => $qte){
        $id = intval($id);
        $qte = intval($qte);

        if($qte <= 0){
            unset($_SESSION['panier'][$id]);
        } else {
            $_SESSION['panier'][$id] = $qte;
        }
    }
}

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Panier - MLI Tech</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
body{
    background:#f5f5f5;
}

.panier-box{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    margin-bottom:15px;
}

.total{
    font-size:22px;
    font-weight:bold;
    color:#28a745;
}

.btn-action{
    border-radius:30px;
    padding:10px 20px;
}
</style>

</head>

<body>

<?php include("header.php"); ?>

<div class="container mt-5">

<h2 class="text-center mb-4">🛒 Votre Panier</h2>

<form method="POST">

<?php
if(empty($_SESSION['panier'])){
    echo "<p class='text-center text-muted'>Votre panier est vide</p>";
} else {

    foreach($_SESSION['panier'] as $id => $qte){

        $stmt = mysqli_prepare($conn, "SELECT * FROM produits WHERE id=?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)){

            $sous_total = $row['prix'] * $qte;
            $total += $sous_total;
?>

<div class="panier-box d-flex justify-content-between align-items-center flex-wrap">

<div>
    <h5><?php echo htmlspecialchars($row['nom']); ?></h5>
    <p><?php echo $row['prix']; ?> FCFA</p>
</div>

<div>
    <input type="number" name="quantite[<?php echo $id; ?>]" 
    value="<?php echo $qte; ?>" min="1" 
    class="form-control" style="width:80px;">
</div>

<div>
    <strong><?php echo $sous_total; ?> FCFA</strong>
</div>

<div>
    <a href="panier.php?supprimer=<?php echo $id; ?>" 
    class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
    </a>
</div>

</div>

<?php
        }
    }
}
?>

<br>

<div class="text-center">
<button type="submit" class="btn btn-primary btn-action">
🔄 Mettre à jour
</button>
</div>

</form>

<hr>

<div class="text-center total">
Total : <?php echo $total; ?> FCFA
</div>

<div class="text-center mt-4">
<a href="page_produit.php" class="btn btn-secondary btn-action">
🛍 Continuer vos achats
</a>

<form action="paiement.php" method="POST">

<?php

$index = 0;

foreach($_SESSION['panier'] as $id => $qte){

    $stmt = mysqli_prepare(
        $conn,
        "SELECT * FROM produits WHERE id=?"
    );

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){

?>

    <!-- Nom produit -->

    <input type="hidden"

           name="equipments[<?php echo $index; ?>][name]"

           value="<?php echo $row['nom']; ?>">

    <!-- Prix -->

    <input type="hidden"

           name="equipments[<?php echo $index; ?>][price]"

           value="<?php echo $row['prix'] * $qte; ?>">

    <!-- Quantité -->

    <input type="hidden"

           name="equipments[<?php echo $index; ?>][quantity]"

           value="<?php echo $qte; ?>">

<?php

        $index++;
    }
}

?>

<button type="submit"

class="btn btn-success btn-action">

    💳 Payer maintenant

</button>

</form>
</a>
</div>

</div>

<?php include("footer.php"); ?>
</body>
</html>

