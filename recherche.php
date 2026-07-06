<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once("connexion.php");
include("header.php");

$motcle = "";

if(isset($_GET['search'])){
    $motcle = trim($_GET['search']);
}
?>

<div class="container py-5">

    <h2 class="mb-4">
        Résultats pour :
        "<span class="text-primary"><?php echo htmlspecialchars($motcle); ?></span>"
    </h2>

    <div class="row">

    <?php

    $nbResultats = 0;

    if(!empty($motcle)){

        $search = "%".$motcle."%";

        /* ================= PRODUITS ================= */

        $sql = "SELECT id, nom, description, prix, image
        FROM produits
        WHERE nom LIKE ?
        OR description LIKE ?";
        $stmt = $conn->prepare($sql);

        if(!$stmt){
            die("Erreur SQL Produits : " . $conn->error);
        }

        $stmt->bind_param("ss", $search, $search);
        $stmt->execute();

        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()){
            $nbResultats++;
        ?>

            <div class="col-md-4 mb-4">

                <div class="card h-100 shadow-sm">

    <img src="images/<?php echo htmlspecialchars($row['image']); ?>"
         class="card-img-top"
         style="height:220px;object-fit:cover;">

    <div class="card-body d-flex flex-column">

        <h5><?php echo htmlspecialchars($row['nom']); ?></h5>

        <p class="text-muted">
            <?php echo htmlspecialchars($row['description']); ?>
        </p>

        <h4 class="text-success mb-3">
            <?php echo number_format($row['prix'],0,',',' '); ?> FCFA
        </h4>

        <div class="mt-auto">

            <a href="panier.php?id=<?php echo $row['id']; ?>"
               class="btn btn-warning w-100 mb-2">
                🛒 Ajouter au panier
            </a>

        
        </div>

    </div>

</div>

        <?php
        }

        $stmt->close();


        /* ================= SERVICES ================= */

       
$sql2 = "SELECT id, icon, title, description , created_at
         FROM services
         WHERE title LIKE ?
         OR description LIKE ?";

$stmt2 = $conn->prepare($sql2);

if(!$stmt2){
    die("Erreur SQL services : " . $conn->error);
}

$stmt2->bind_param("ss", $search, $search);
$stmt2->execute();

$result2 = $stmt2->get_result();

while($row2 = $result2->fetch_assoc()){
    $nbResultats++;
?>

<div class="col-md-4 mb-4">

    <div class="card border-primary h-100 shadow-sm">

        <div class="card-body">

            <i class="bi <?php echo htmlspecialchars($row2['icon']); ?> fs-1 text-primary"></i>

            <h5 class="mt-3">
                <?php echo htmlspecialchars($row2['title']); ?>
            </h5>

            <p>
                <?php echo htmlspecialchars($row2['description']); ?>
            </p>

          <a href="demande_service.php?id=<?php echo $row2['id']; ?>&service=<?php echo urlencode($row2['title']); ?>"
              class="btn btn-primary">
               Demander ce service
          </a>

        </div>

    </div>

</div>

<?php
}
$stmt2->close();

        if($nbResultats == 0){
            echo '
            <div class="col-12">
                <div class="alert alert-warning">
                    Aucun résultat trouvé pour <strong>'
                    . htmlspecialchars($motcle) .
                    '</strong>.
                </div>
            </div>';
        }
    } else {
        echo '
        <div class="col-12">
            <div class="alert alert-info">
                Veuillez entrer un mot-clé de recherche.
            </div>
        </div>';
    }
    ?>

    </div>

    <div class="mt-4">
        <a href="accueil2.php" class="btn btn-primary">
            Retour à l\'accueil
        </a>
    </div>

</div>

<style>
.card{
    transition:0.3s;
}
.card:hover{
    transform:translateY(-5px);
}
</style>

<?php include("footer.php"); ?>