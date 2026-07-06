<?php
session_start();
include("connexion.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$service = $_GET['service'] ?? '';

$success = "";
$error = "";

/* OPTIONS SERVICES */
$optionsServices = [

"Maintenance Informatique" => [
"Diagnostic et réparation",
"Installation logiciels",
"Nettoyage PC",
"Suppression virus"
],

"Cybersécurité" => [
"Protection systèmes",
"Antivirus & pare-feu",
"Sécurisation données",
"Audit sécurité"
],

"Réseaux" => [
"Wi-Fi & LAN",
"Configuration routeurs",
"Maintenance réseau",
"Optimisation internet"
],

"Développement Web" => [
"Site vitrine",
"E-commerce",
"Application Web",
"Maintenance"
],

"Design Graphique" => [
"Logo",
"Affiche",
"UI/UX Design",
"Identité visuelle"
],

"Réparation" => [
"Ordinateurs",
"Remplacement pièces",
"Maintenance",
"Diagnostic rapide"
]

];

/* EMAIL DESTINATAIRE ENTREPRISE */
$destinataireEntreprise = "mlitech00223@gmail.com"; // 👉 change ici si besoin

if(isset($_POST['envoyer'])){

$service = $_POST['service'];
$nom = htmlspecialchars($_POST['nom']);
$email = htmlspecialchars($_POST['email']);
$telephone = htmlspecialchars($_POST['telephone']);
$entreprise = htmlspecialchars($_POST['entreprise']);
$capacite = htmlspecialchars($_POST['capacite']);
$description = htmlspecialchars($_POST['description']);

$options = "";

if(isset($_POST['options'])){
$options = implode(", ", $_POST['options']);
}

/* INSERTION BASE DE DONNÉES */
$stmt = $conn->prepare("
INSERT INTO demandes_services
(service,nom,email,telephone,entreprise,capacite,options_choisies,description)
VALUES (?,?,?,?,?,?,?,?)
");

$stmt->bind_param(
"ssssssss",
$service,
$nom,
$email,
$telephone,
$entreprise,
$capacite,
$options,
$description
);

$stmt->execute();

/* ENVOI EMAIL */
$mail = new PHPMailer(true);

try {

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;

$mail->Username = 'mlitech00223@gmail.com';
$mail->Password = 'mpzxpysluihwicvc'; // ⚠️ idéalement mettre en .env

$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->setFrom('mlitech00223@gmail.com', 'MLI Tech');

/* 👉 EMAIL ENVOYÉ À L’ENTREPRISE */
$mail->addAddress($destinataireEntreprise);

/* POUR RÉPONDRE DIRECTEMENT AU CLIENT */
$mail->addReplyTo($email, $nom);

$mail->isHTML(true);

$mail->Subject = "Nouvelle demande de service - MLI Tech";

$mail->Body = "
<h2>Nouvelle demande de service</h2>

<b>Service :</b> $service <br>
<b>Nom :</b> $nom <br>
<b>Email :</b> $email <br>
<b>Téléphone :</b> $telephone <br>
<b>Entreprise :</b> $entreprise <br>
<b>Capacité :</b> $capacite <br>
<b>Options :</b> $options <br><br>

<b>Description :</b><br>
$description
";

$mail->send();
/* =========================
   EMAIL ENTREPRISE ENVOYÉ
========================= */

$mail->send();


/* =========================
   EMAIL ACCUSÉ DE RÉCEPTION CLIENT
========================= */

$mailClient = new PHPMailer(true);

try {

    $mailClient->isSMTP();
    $mailClient->Host = 'smtp.gmail.com';
    $mailClient->SMTPAuth = true;

    $mailClient->Username = 'mlitech00223@gmail.com';
    $mailClient->Password = 'mpzxpysluihwicvc';

    $mailClient->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mailClient->Port = 587;

    $mailClient->setFrom('mlitech00223@gmail.com', 'MLI Tech');

    // 👉 ENVOI AU CLIENT
    $mailClient->addAddress($email, $nom);

    $mailClient->isHTML(true);

    $mailClient->Subject = "   - MLI Tech";

    $mailClient->Body = "
    <div style='font-family:Arial;padding:15px'>

        <h2 style='color:#0d6efd;'>MLI Tech</h2>

        <p>Bonjour <b>$nom</b>,</p>

        <p>Nous avons bien reçu votre demande de service et nous vous remercions de votre confiance.</p>

        <hr>

        <h3>Détails de votre demande :</h3>

        <b>Service :</b> $service <br>
        <b>Téléphone :</b> $telephone <br>
        <b>Entreprise :</b> $entreprise <br>
        <b>Capacité :</b> $capacite <br>
        <b>Options :</b> $options <br><br>

        <b>Description :</b><br>
        $description

        <hr>

        <p>Notre équipe vous contactera très prochainement.</p>

        <p style='color:#0d6efd;'>
        Cordialement,<br>
        <b>Équipe MLI Tech</b>
        </p>

    </div>
    ";

    $mailClient->send();

} catch (Exception $e) {
    // Tu peux log l'erreur si besoin
}

$success = "Votre demande a été envoyée avec succès.";

} catch (Exception $e) {

$error = "Erreur lors de l'envoi : " . $mail->ErrorInfo;

}

}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Demande de Service - MLI Tech</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:#f8fafc;
font-family:Arial;
}

.service-box{
max-width:900px;
margin:auto;
background:#fff;
padding:35px;
border-radius:20px;
box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.page-title{
font-size:35px;
font-weight:800;
text-align:center;
color:#0d6efd;
}

.subtitle{
text-align:center;
color:#64748b;
margin-bottom:30px;
}

.btn-submit{
background:linear-gradient(135deg,#0d6efd,#00c6ff);
border:none;
padding:14px;
font-weight:bold;
}
</style>

</head>

<body>

<?php include("header.php"); ?>

<div class="container py-5">

<div class="service-box">

<h2 class="page-title">Demande de Service</h2>
<p class="subtitle">Remplissez le formulaire ci-dessous</p>

<?php if($success){ ?>
<div class="alert alert-success"><?= $success ?></div>
<?php } ?>

<?php if($error){ ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php } ?>

<form method="POST">

<input type="hidden" name="service" value="<?= $service ?>">

<div class="mb-3">
<label class="form-label">Service choisi</label>
<input type="text" class="form-control" value="<?= $service ?>" readonly>
</div>

<div class="row">

<div class="col-md-6 mb-3">
<label>Nom complet</label>
<input type="text" name="nom" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">
<label>Téléphone</label>
<input type="text" name="telephone" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Entreprise</label>
<input type="text" name="entreprise" class="form-control" required>
</div>

</div>

<div class="mb-3">
<label>Capacité</label>
<select name="capacite" class="form-select" required>
<option value="">Choisir</option>
<option>1 à 5 employés</option>
<option>6 à 20 employés</option>
<option>21 à 50 employés</option>
<option>51 à 100 employés</option>
<option>Plus de 100 employés</option>
</select>
</div>

<div class="mb-3">
<label>Options souhaitées</label>

<?php
if(isset($optionsServices[$service])){
foreach($optionsServices[$service] as $option){
?>

<div class="form-check">
<input class="form-check-input" type="checkbox" name="options[]" value="<?= $option ?>">
<label class="form-check-label"><?= $option ?></label>
</div>

<?php }} ?>

</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" rows="5" class="form-control" required></textarea>
</div>

<button type="submit" name="envoyer" class="btn btn-primary btn-submit w-100">
Envoyer la demande
</button>

</form>

</div>

</div>

<?php include("footer.php"); ?>

</body>
</html>