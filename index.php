<!DOCTYPE html>
<html>
<head>

<title>MLI TECH</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

.hero{
background:url("images/fond.jpg"); 
background-size: cover;
background-position: center;
height:500px;
color:white;
display:flex;
align-items:center;
}

.hero-text{
background:rgba(0,0,0,0.5);
padding:40px;
border-radius:10px;
}

.section{
padding:50px 0;
}

.navbar{
padding:15px 0;
}

.menu-design .nav-item{
margin:0 15px;
}

.menu-design .nav-link{
font-weight:500;
color:#333;
transition:0.3s;
}

.menu-design .nav-link:hover{
color:#0d6efd;
}

/* bouton connexion */
.btn-connexion{
background:#28a745;
color:white !important;
padding:8px 18px;
border-radius:25px;
margin-left:10px;
}

/* bouton inscription */
.btn-inscription{
background:#0d6efd;
color:white !important;
padding:8px 18px;
border-radius:25px;
margin-left:10px;
}

.btn-connexion:hover{
background:#218838;
}

.btn-inscription:hover{
background:#0b5ed7;
}

.service-card{
border: none;
border-radius: 15px;
transition: 0.3s;
background: #ffffff;
}

.service-card:hover{
transform: translateY(-10px);
box-shadow: 0 10px 30px rgba(0,0,0,0.2);
background: linear-gradient(135deg,#0d6efd,#4facfe);
color:white;
}

.service-card h5{
font-weight: bold;
margin-top:10px;
}

.service-icon{
font-size:40px;
color:#0d6efd;
}

.service-card:hover .service-icon{
color:white;
}


.footer-pro{
background: linear-gradient(135deg,#0d3b66,#1e5f9e);
color: white;
padding: 40px 0;
}

.footer-pro h5{
margin-bottom: 15px;
}

.footer-pro p{
margin: 5px 0;
font-size: 15px;
}

.social-icons a{
display: inline-block;
margin: 5px;
width: 40px;
height: 40px;
line-height: 40px;
text-align: center;
border-radius: 50%;
background: rgba(255,255,255,0.2);
color: white;
font-size: 18px;
transition: 0.3s;
}

.social-icons a:hover{
background: #0d6efd;
transform: scale(1.1);
}


</style>

</head>

<body>

<!-- MENU -->



<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
<div class="container">

<a class="navbar-brand fw-bold d-flex align-items-center" href="#">
<img src="images/bg-tech.jpg" width="40" class="me-2"> 
MLI Tech
</a>

<ul class="navbar-nav ms-auto menu-design">


<li class="nav-item">
<a class="nav-link btn-connexion" href="login.php">Connexion</a>
</li>

<li class="nav-item">
<a class="nav-link btn-inscription" href="formulaire.php">Inscription</a>
</li>

</ul>

</div>
</nav>


<!-- HERO -->

<section class="hero">

<div class="container">

<div class="hero-text">

<h1>L’innovation technologique au service de votre réussite.</h1>

<p>Votre partenaire technologique</p>


</div>

</div>

</section>


<!-- SERVICES -->



<div class="container mt-5">

<h2 class="text-center mb-5 fw-bold">💻 Nos Services Informatiques</h2>

<div class="row text-center">

<div class="col-md-4 mb-4">
<div class="card service-card p-4">
<div class="service-icon">🛠</div>
<h5>Maintenance Informatique</h5>
<p>Nous assurons l'installation, la réparation et l’optimisation
de vos ordinateurs afin de garantir performance, stabilité
et longévité de votre matériel.</p>
</div>
</div>

<div class="col-md-4 mb-4">
<div class="card service-card p-4">
<div class="service-icon">🔐</div>
<h5>Cybersécurité</h5>
<p>Protégez votre entreprise contre les virus, piratages
et intrusions grâce à nos solutions de sécurité
informatique fiables et efficaces.</p>
</div>
</div>

<div class="col-md-4 mb-4">
<div class="card service-card p-4">
<div class="service-icon">🌐</div>
<h5>Gestion des Réseaux</h5>
<p>Installation et configuration de routeurs, switches
et points d'accès pour un réseau rapide,
sécurisé et performant.</p>
</div>
</div>

<div class="col-md-4 mb-4">
<div class="card service-card p-4">
<div class="service-icon">💻</div>
<h5>Développement Web</h5>
<p>Création de sites web modernes et d'applications
professionnelles pour améliorer votre visibilité
sur Internet.</p>
</div>
</div>

<div class="col-md-4 mb-4">
<div class="card service-card p-4">
<div class="service-icon">🎨</div>
<h5>Design Graphique</h5>
<p>Conception de logos, affiches, cartes de visite
et supports visuels pour renforcer l'image
de votre entreprise.</p>
</div>
</div>

<div class="col-md-4 mb-4">
<div class="card service-card p-4">
<div class="service-icon">🔧</div>
<h5>Réparation Équipements</h5>
<p>Diagnostic et réparation des équipements
informatiques et réseaux pour garantir
leur bon fonctionnement.</p>
</div>
</div>

</div>

</div>



<!-- FOOTER -->

<footer class="footer-pro">

<div class="container">

<div class="row text-start text-white">

<!-- CONTACT -->
<div class="col-md-6 mb-3">
<h5 class="fw-bold">Contactez-Nous</h5>

<p>📞  61 43 20 02 / 90 48 15 85</p>
<p>📧 mlitech223@gmail.com</p>
<p>📍 Bamako, Mali</p>
</div>

<!-- RESEAUX -->
<div class="col-md-6 text-md-end">
<h5 class="fw-bold">Suivez-nous</h5>

<div class="social-icons">
<a href="#"><i class="bi bi-facebook"></i></a>
<a href="#"><i class="bi bi-twitter"></i></a>
<a href="#"><i class="bi bi-linkedin"></i></a>
<a href="#"><i class="bi bi-instagram"></i></a>
</div>
</div>

</div>

</div>

<hr class="bg-light">

<!-- COPYRIGHT -->
<div class="text-center">
<p>© 2026 MLI Tech | Tous droits réservés</p>
</div>

</div>


</body>
</html>
<script>

// Animation hover dynamique
const btnConnexion = document.querySelector(".btn-connexion");
const btnInscription = document.querySelector(".btn-inscription");

// effet zoom
[btnConnexion, btnInscription].forEach(btn => {

btn.addEventListener("mouseenter", () => {
btn.style.transform = "scale(1.1)";
btn.style.transition = "0.3s";
});

btn.addEventListener("mouseleave", () => {
btn.style.transform = "scale(1)";
});

});




</script>

