<!DOCTYPE html>
<html>
<head>
    <title>Paiement</title>
</head>
<body>

<h2>Paiement Mobile Money</h2>

<form action="paiement.php" method="POST">

    <input type="email" name="email" placeholder="Votre email" required>
    <input type="text" name="phone" placeholder="Numéro" required>

    <select name="methode" required>
        <option value="Orange Money">Orange Money</option>
        <option value="Moov Money">Moov Money</option>
        <option value="Wave">Wave</option>
    </select>

    <button type="submit">Payer</button>
</form>

</body>
</html>