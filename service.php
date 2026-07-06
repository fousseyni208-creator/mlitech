<?php
session_start();
include("connexion.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Nos Services - MLI Tech</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>

html,body{
width:100%;
overflow-x:hidden;
margin:0;
padding:0;
}

/* BACKGROUND */
body{
background:radial-gradient(circle at top,#e0f2fe,#f8fafc);
font-family:Arial,sans-serif;
color:#1e293b;
}

/* SECTION */
.services{
padding:80px 0;
}

/* TITRE */
h2{
font-size:52px;
font-weight:900;
text-align:center;
background:linear-gradient(90deg,#0d6efd,#00c6ff,#8b5cf6);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
margin-bottom:15px;
}

/* SOUS TITRE */
.subtitle{
text-align:center;
color:#64748b;
font-size:18px;
margin-bottom:70px;
}

/* CARTE */
.service-card{
background:#fff;
border:1px solid #e5e7eb;
border-radius:25px;
padding:30px 20px;
height:100%;
box-shadow:0 10px 25px rgba(0,0,0,.08);
transition:.4s;
position:relative;
overflow:hidden;

opacity:0;
transform:translateY(40px);
}

.service-card:hover{
transform:translateY(-10px);
box-shadow:0 25px 60px rgba(0,0,0,.15);
border-color:#0d6efd40;
}

/* EFFET LUMIERE */
.service-card::before{
content:'';
position:absolute;
top:0;
left:-120%;
width:120%;
height:100%;
background:linear-gradient(
120deg,
transparent,
rgba(255,255,255,.5),
transparent
);
transition:.8s;
}

.service-card:hover::before{
left:120%;
}

/* ICONE */
.service-icon{
width:80px;
height:80px;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
font-size:35px;
color:white;
margin-bottom:20px;
background:linear-gradient(135deg,#0d6efd,#00c6ff);
box-shadow:0 10px 25px rgba(13,110,253,.3);
transition:.3s;
}

.service-card:hover .service-icon{
transform:scale(1.1) rotate(10deg);
}

/* TITRE CARTE */
.service-card h5{
font-size:22px;
font-weight:800;
margin-bottom:15px;
}

/* LISTE */
.service-card ul{
padding-left:20px;
margin-bottom:0;
}

.service-card ul li{
font-size:15px;
margin-bottom:8px;
line-height:1.6;
}

/* BOUTON */
.btn-service{
display:inline-block;
background:linear-gradient(135deg,#0d6efd,#00c6ff);
color:white;
padding:15px 45px;
border-radius:50px;
font-size:18px;
font-weight:bold;
text-decoration:none;
transition:.3s;
box-shadow:0 15px 30px rgba(13,110,253,.25);
}

.btn-service:hover{
color:white;
transform:scale(1.05);
}

/* TABLETTE */
@media(max-width:992px){

h2{
font-size:42px;
}

.subtitle{
font-size:16px;
margin-bottom:50px;
}

.service-card{
padding:25px 18px;
}

.service-icon{
width:70px;
height:70px;
font-size:30px;
}

}

/* MOBILE */
@media(max-width:768px){

.services{
padding:50px 10px;
}

h2{
font-size:32px;
}

.subtitle{
font-size:15px;
margin-bottom:40px;
}

.service-card{
padding:20px 12px;
}

.service-card h5{
font-size:16px;
}

.service-card ul li{
font-size:12px;
}

.service-icon{
width:55px;
height:55px;
font-size:22px;
}

.btn-service{
width:100%;
max-width:300px;
font-size:15px;
padding:12px 20px;
}

}

/* PETITS TELEPHONES */
@media(max-width:480px){

h2{
font-size:28px;
}

.subtitle{
font-size:14px;
}

.service-card h5{
font-size:15px;
}

.service-card ul li{
font-size:11px;
}
.service-card{
cursor:pointer;
}

.service-card:hover h5{
color:#0d6efd;
}

}

</style>

</head>

<body>

<?php include("header.php"); ?>

<section class="services container">

<h2>Nos Services</h2>

<p class="subtitle">
Des solutions modernes pour accompagner votre transformation digitale
</p>

<div class="row g-4">

<?php

$services = [

[
"icon"=>"bi-tools",
"title"=>"Maintenance Informatique",
"text"=>[
"Diagnostic et réparation",
"Installation logiciels",
"Nettoyage PC",
"Suppression virus"
]
],

[
"icon"=>"bi-shield-lock",
"title"=>"Cybersécurité",
"text"=>[
"Protection systèmes",
"Antivirus & pare-feu",
"Sécurisation données",
"Audit sécurité"
]
],

[
"icon"=>"bi-diagram-3",
"title"=>"Réseaux",
"text"=>[
"Wi-Fi & LAN",
"Configuration routeurs",
"Maintenance réseau",
"Optimisation internet"
]
]
,

[
"icon"=>"bi-code-slash",
"title"=>"Développement Web",
"text"=>[
"Sites modernes",
"E-commerce",
"Applications web",
"Maintenance"
]
]
,

[
"icon"=>"bi-palette",
"title"=>"Design Graphique",
"text"=>[
"Logos",
"Affiches",
"UI/UX Design",
"Identité visuelle"
]
]
,

[
"icon"=>"bi-cpu",
"title"=>"Réparation",
"text"=>[
"Ordinateurs",
"Remplacement pièces",
"Maintenance",
"Diagnostic rapide"
]
]

];

foreach($services as $s){
?>

<!-- 2 cartes téléphone / tablette - 3 cartes ordinateur -->
<div class="col-6 col-lg-4">

<a href="demande_service.php?service=<?= urlencode($s['title']); ?>"
class="text-decoration-none text-dark">

<div class="service-card">

<div class="service-icon">
<i class="bi <?= $s['icon']; ?>"></i>
</div>

<h5><?= $s['title']; ?></h5>

<ul>
<?php foreach($s['text'] as $t){ ?>
<li><?= $t; ?></li>
<?php } ?>
</ul>

<div class="mt-3 fw-bold text-primary">
Voir les options →
</div>

</div>

</a>

</div>

<?php } ?>

</div>



</section>

<?php include("footer.php"); ?>

<script>

const cards = document.querySelectorAll(".service-card");

const observer = new IntersectionObserver(entries => {

entries.forEach(entry => {

if(entry.isIntersecting){

entry.target.style.opacity = "1";
entry.target.style.transform = "translateY(0)";

}

});

},{threshold:0.1});

cards.forEach(card => observer.observe(card));

</script>

</body>
</html>