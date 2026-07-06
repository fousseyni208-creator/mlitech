<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>MLI Tech</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

/* =========================
   GLOBAL
========================= */
body{
    overflow-x:hidden;
    font-family:Arial, sans-serif;
}

img{
    max-width:100%;
    height:auto;
}

/* =========================
   NAVBAR
========================= */
.navbar{
    padding:12px 0;
}

.navbar-brand{
    font-size:1.3rem;
    font-weight:bold;
}

.navbar-brand img{
    border-radius:50%;
}

/* =========================
   MENU
========================= */
.menu-design .nav-link{
    color:#000 !important;
    font-weight:500;
    margin:0 10px;
    position:relative;
    transition:0.3s;
}

.menu-design .nav-link::after{
    content:"";
    position:absolute;
    left:0;
    bottom:0;
    width:0;
    height:3px;
    background:#0d6efd;
    border-radius:5px;
    transition:0.3s;
}

.menu-design .nav-link:hover::after{
    width:100%;
}

.menu-design .nav-link.active{
    color:#0d6efd !important;
    font-weight:bold;
}

.menu-design .nav-link.active::after{
    width:100%;
}

/* =========================
   BOUTON DECONNEXION
========================= */
.btn-deconnexion{
    background:linear-gradient(45deg,#ff4b2b,#ff416c);
    color:white !important;
    padding:8px 18px;
    border-radius:30px;
    transition:0.3s;
    text-decoration:none;
}

.btn-deconnexion:hover{
    transform:scale(1.05);
    box-shadow:0 5px 15px rgba(0,0,0,0.3);
}

/* =========================
   HERO
========================= */
.hero{
    background:url("images/fond.jpg");
    background-size:cover;
    background-position:center;
    min-height:500px;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
}

.hero-text{
    background:rgba(0,0,0,0.55);
    padding:40px;
    border-radius:15px;
    max-width:800px;
}

/* =========================
   CARTES GLOBALES
========================= */
.card{
    height:100%;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card-title{
    font-weight:bold;
}

/* =========================
   TABLETTE
========================= */
@media (max-width:992px){

    .menu-design{
        text-align:center;
        margin-top:10px;
    }

    .menu-design .nav-link{
        display:inline-block;
        margin:8px 0;
    }

    .navbar-nav.ms-auto{
        margin-top:10px;
        text-align:center;
    }

    .btn-deconnexion{
        display:inline-block;
    }

    .hero{
        min-height:400px;
    }

}

/* =========================
   MOBILE
========================= */
@media (max-width:768px){

    .hero{
        min-height:350px;
        padding:20px;
    }

    .hero-text{
        padding:25px;
    }

    .hero-text h1{
        font-size:1.8rem;
    }

    .hero-text p{
        font-size:14px;
    }

    .card-title{
        font-size:15px;
    }

    .card-text{
        font-size:13px;
    }

}

/* =========================
   PETITS TELEPHONES
========================= */
@media (max-width:576px){

    .hero{
        min-height:300px;
    }

    .hero-text{
        padding:20px;
    }

    .hero-text h1{
        font-size:1.4rem;
    }

    .hero-text p{
        font-size:13px;
    }

}

</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">

<div class="container">

<a class="navbar-brand fw-bold" href="accueil.php">
<img src="images/bg-tech.jpg" width="50" height="50" alt="Logo">
MLI TECH
</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav mx-auto menu-design">

<li class="nav-item">
<a class="nav-link" href="accueil.php">Accueil</a>
</li>

<li class="nav-item">
<a class="nav-link" href="page_produit.php">Produits</a>
</li>


<li class="nav-item">
<a class="nav-link" href="service.php">Services</a>
</li>

<li class="nav-item">
<a class="nav-link" href="a_propos.php">À propos</a>
</li>



<a href="logout.php"
   class="btn btn-danger"
   onclick="return confirm('Voulez-vous vraiment vous déconnecter ?');">
    Déconnexion
</a>

</div>

</div>

</nav>

<!-- HERO -->
<section class="hero">
<div class="container">
<div class="hero-text">

<h1 class="fw-bold mb-3">
L’innovation technologique au service de votre réussite
</h1>

<p class="lead">
Votre partenaire technologique pour tous vos projets informatiques.
</p>

</div>
</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
const links = document.querySelectorAll(".menu-design .nav-link");

const currentPage = window.location.pathname.split("/").pop();

links.forEach(link => {
    if(link.getAttribute("href") === currentPage){
        link.classList.add("active");
    }
});
</script>

</body>
</html>