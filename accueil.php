<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("header.php");
?>

<style>


/* SERVICES */

.service-card{
    border:none;
    border-radius:15px;
    transition:0.4s;
    height:100%;
    cursor:pointer;
}

.service-card:hover{
    transform:translateY(-10px);
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
    background:linear-gradient(135deg,#0d6efd,#4facfe);
    color:white;
}

.service-icon{
    font-size:40px;
    color:#0d6efd;
    margin-bottom:10px;
}

.service-card:hover .service-icon{
    color:white;
}

/* TABLETTE */

@media(max-width:992px){

.hero{
    min-height:400px;
    padding:50px 20px;
}

.hero-text{
    max-width:100%;
}

.hero-text h1{
    font-size:2.3rem;
}

}

/* MOBILE */

@media(max-width:768px){

.hero{
    min-height:350px;
    padding:40px 15px;
}

.hero-text{
    padding:20px;
}

.hero-text h1{
    font-size:1.8rem;
}

.hero-text p{
    font-size:15px;
}

.service-icon{
    font-size:32px;
}

}

/* PETIT MOBILE */

@media(max-width:576px){

.hero{
    min-height:300px;
}

.hero-text h1{
    font-size:1.5rem;
}

.hero-text p{
    font-size:14px;
}

.service-card{
    padding:15px !important;
}

.service-card h5{
    font-size:15px;
}

.service-card p{
    font-size:13px;
}

.service-icon{
    font-size:26px;
}

}

</style>

<!-- HERO -->



<!-- SERVICES -->

<div class="container py-5">

<h2 class="text-center mb-5 fw-bold">
💻 Quelques Services
</h2>

<div class="row text-center">

<div class="col-6 col-md-6 col-lg-4 mb-4">
<div class="card service-card p-4">
<div class="service-icon">🛠</div>
<h5>Maintenance Informatique</h5>
<p>
Nous assurons l'installation, la réparation et l’optimisation de vos ordinateurs afin de garantir performance, stabilité et longévité de votre matériel.
</p>
</div>
</div>

<div class="col-6 col-md-6 col-lg-4 mb-4">
<div class="card service-card p-4">
<div class="service-icon">🔐</div>
<h5>Cybersécurité</h5>
<p>
Protégez votre entreprise contre les virus, piratages et intrusions grâce à nos solutions de sécurité fiables et efficaces.
</p>
</div>
</div>

<div class="col-6 col-md-6 col-lg-4 mb-4">
<div class="card service-card p-4">
<div class="service-icon">🌐</div>
<h5>Gestion des Réseaux</h5>
<p>
Installation et configuration de routeurs, switches et points d'accès pour un réseau rapide, sécurisé et performant.
</p>
</div>
</div>

<div class="col-6 col-md-6 col-lg-4 mb-4">
<div class="card service-card p-4">
<div class="service-icon">💻</div>
<h5>Développement Web</h5>
<p>
Création de sites web modernes et d'applications professionnelles pour améliorer votre visibilité sur Internet.
</p>
</div>
</div>

<div class="col-6 col-md-6 col-lg-4 mb-4">
<div class="card service-card p-4">
<div class="service-icon">🎨</div>
<h5>Design Graphique</h5>
<p>
Conception de logos, affiches, cartes de visite et supports visuels pour renforcer l'image de votre entreprise.
</p>
</div>
</div>

<div class="col-6 col-md-6 col-lg-4 mb-4">
<div class="card service-card p-4">
<div class="service-icon">🔧</div>
<h5>Réparation Équipements</h5>
<p>
Diagnostic et réparation des équipements informatiques et réseaux pour garantir leur bon fonctionnement.
</p>
</div>
</div>

</div>

</div>

<?php include("footer.php"); ?>

<script>

/* Animation cartes */

const cartes = document.querySelectorAll(".service-card");

cartes.forEach(card=>{
    card.style.opacity = "0";
    card.style.transform = "translateY(50px)";
    card.style.transition = "0.6s";
});

function showCards(){

    const trigger = window.innerHeight * 0.85;

    cartes.forEach(card=>{

        const top = card.getBoundingClientRect().top;

        if(top < trigger){
            card.style.opacity = "1";
            card.style.transform = "translateY(0)";
        }

    });

}

window.addEventListener("scroll", showCards);
showCards();

/* Bouton retour haut */

const bouton = document.createElement("button");

bouton.innerHTML = "⬆";
bouton.className = "btn btn-primary";

bouton.style.position = "fixed";
bouton.style.bottom = "20px";
bouton.style.right = "20px";
bouton.style.borderRadius = "50%";
bouton.style.display = "none";
bouton.style.zIndex = "999";

document.body.appendChild(bouton);

window.addEventListener("scroll", ()=>{

    if(window.scrollY > 300){
        bouton.style.display = "block";
    }else{
        bouton.style.display = "none";
    }

});

bouton.addEventListener("click", ()=>{

    window.scrollTo({
        top:0,
        behavior:"smooth"
    });

});

</script>