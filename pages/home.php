<?php
session_start();
require_once('../src/cfg/db.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
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
        <link rel="stylesheet" type="text/css" href="../src/style/main/style.css">

        <title>TrainStats — Home</title>
    </head>
    <body>
    <header>
        <nav>
            <div class="logo">
                <img src="../src/img/login/TrainStats.png" alt="TrainStats Icon">
                TrainStats
            </div>
            <div class="menu">
                <a class="logout-button" href="logout.php">
                    <i class='bx bxs-log-out'></i>
                </a>
            </div>
        </nav>
    </header>
    <div class="loading-bar">
        <div class="progress">
            <div class="inner-animation"></div>
        </div>
    </div>
</body>
</html>