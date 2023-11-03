<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
</head>

<body>
    <h6 class="mb-3">Bonjour {{ $details['nom'] }},</h6>
    <p> Votre code est : <strong> {{ $details['otp'] }} </strong> , la durée est de 10 minutes.</p>

</body>

</html>