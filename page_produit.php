<?php
session_start();
include("connexion.php");

$result = mysqli_query($conn,"SELECT * FROM produits");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Boutique MLI Tech</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

html,
body{
    width:100%;
    overflow-x:hidden;
    margin:0;
    padding:0;
}

/* Fond */
body{
    background:radial-gradient(circle at top,#e0f2fe,#f8fafc);
    font-family:Arial,sans-serif;
}

/* Titre */
.page-title{
    text-align:center;
    font-size:50px;
    font-weight:900;
    margin-bottom:15px;
    background:linear-gradient(90deg,#0d6efd,#00c6ff,#8b5cf6);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.subtitle{
    text-align:center;
    color:#64748b;
    margin-bottom:50px;
    font-size:18px;
}

/* Carte produit */
.product-card{
    border:none;
    border-radius:25px;
    overflow:hidden;
    height:100%;
    background:#fff;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.4s;
}

.product-card:hover{
    transform:translateY(-10px);
    box-shadow:0 20px 50px rgba(0,0,0,.15);
}

.product-card img{
    width:100%;
    height:250px;
    object-fit:cover;
}

/* Corps carte */
.product-card .card-body{
    display:flex;
    flex-direction:column;
}

.product-card h5{
    font-size:22px;
    font-weight:800;
}

.product-card p{
    color:#555;
    flex-grow:1;
}

/* Prix */
.product-price{
    color:#0d6efd;
    font-size:24px;
    font-weight:bold;
    margin-bottom:15px;
}

/* Bouton panier */
.btn-panier{
    border-radius:50px;
    font-weight:bold;
    padding:12px;
    transition:.3s;
}

.btn-panier:hover{
    transform:scale(1.03);
}

/* Responsive tablette */
@media(max-width:992px){

    .page-title{
        font-size:40px;
    }

    .product-card img{
        height:200px;
    }

}

/* Responsive mobile */
@media(max-width:768px){

    .page-title{
        font-size:30px;
    }

    .subtitle{
        font-size:15px;
    }

    .product-card{
        border-radius:18px;
    }

    .product-card img{
        height:140px;
    }

    .product-card h5{
        font-size:15px;
    }

    .product-card p{
        font-size:12px;
    }

    .product-price{
        font-size:18px;
    }

    .btn-panier{
        font-size:12px;
        padding:8px;
    }

}

/* Très petits écrans */
@media(max-width:480px){

    .product-card h5{
        font-size:14px;
    }

    .product-card p{
        font-size:11px;
    }

    .product-price{
        font-size:16px;
    }

}

</style>

</head>

<body>

<?php include("header.php"); ?>

<div class="container py-5">

<h2 class="page-title">
🛒 Boutique MLI Tech
</h2>

<p class="subtitle">
Découvrez nos produits informatiques de qualité
</p>

<div class="row g-4">

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<!-- 2 produits téléphone/tablette - 3 produits ordinateur -->
<div class="col-6 col-lg-4">

<div class="card product-card">

<img src="images/<?php echo $row['image']; ?>" 
alt="<?php echo $row['nom']; ?>">

<div class="card-body">

<h5>
<?php echo $row['nom']; ?>
</h5>

<p>
<?php echo $row['description']; ?>
</p>

<div class="product-price">
<?php echo number_format($row['prix'],0,' ',' '); ?> FCFA
</div>

<a href="panier.php?id=<?php echo $row['id']; ?>"
class="btn btn-primary btn-panier">

<i class="bi bi-cart-plus"></i>
 Ajouter au panier

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

<?php include("footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>