<?php
session_start();
require_once('../src/cfg/db.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Vérifier si l'utilisateur est autorisé à accéder
$username = $_SESSION['username'];
$check_access_query = "SELECT allowacces FROM users WHERE username = '$username'";
$check_access_result = $conn->query($check_access_query);

if ($check_access_result->num_rows > 0) {
    $user = $check_access_result->fetch_assoc();
    $allow_access = $user['allowacces'];

    if ($allow_access === 'no') {
        header("Location: ./noaccess.php"); // Redirige vers la page noaccess.php si l'accès est interdit
        exit();
    }
}
?>

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5">
        <meta name="format-detection" content="telephone=no">
        <meta name="description" content="Le chat officiel des étudiants du lycée de l'Atlantique">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Gochat — Home">
        <meta name="twitter:description" content="Le chat officiel des étudiants du lycée de l'Atlantique">
        <meta name="twitter:image" content="#">
        <meta name="theme-color" content="#77ffc0">
        <!--=============== FAVICON ===============-->
        <link rel="icon" type="image/png" href="./src/img/main/favicon.png">
        <!--=============== BOXICONS ===============-->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <!--=============== CSS ===============-->
        

        <title>Gochat — Home</title>
    </head>
    <body>
    <h1>Bienvenue sur la page Home</h1>
    <p>Bonjour, <?php echo $_SESSION['username']; ?> ! Vous êtes autorisé à accéder à cette page.</p>
    <a href="logout.php">Déconnexion</a>
    </body>
</html>