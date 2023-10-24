<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: ./pages/home.php");
    exit();
}

require_once('./src/cfg/db.php');

$login_error = "";

// Gestion de l'inscription (register)
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si l'utilisateur existe déjà
    $check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        $login_error = "Ce nom d'utilisateur ou cet email existe déjà.";
    } else {
        // Insérer le nouvel utilisateur dans la base de données avec allowacces par défaut à "no"
        $insert_query = "INSERT INTO users (username, email, password, allowacces) VALUES ('$username', '$email', '$password', 'no')";
        if ($conn->query($insert_query) === TRUE) {
            $login_error = "Inscription réussie. Vous pouvez maintenant vous connecter.";
        } else {
            $login_error = "Erreur lors de l'inscription : " . $conn->error;
        }
    }
}

// Gestion de la connexion (login)
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // L'utilisateur existe dans la base de données, connexion réussie
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Remplacez "dashboard.php" par la page de destination après la connexion réussie.
    } else {
        // L'utilisateur n'existe pas ou le mot de passe est incorrect
        $login_error = "Identifiants invalides. Veuillez réessayer.";
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
    <meta name="twitter:title" content="Gochat — Connexion">
    <meta name="twitter:description" content="Le chat officiel des étudiants du lycée de l'Atlantique">
    <meta name="twitter:image" content="#">
    <meta name="theme-color" content="#77ffc0">
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="./src/style/loader/style.css">
    <link rel="stylesheet" href="./src/style/login/style.css">
    <!--=============== TITLE ===============-->
    <title>Gochat — Connexion</title>
</head>

<body>
<!--========== LOADING PART ==========-->
<div class="loading-container">
    <h1 class="loading">
        Chargement
        <div class="loading__dots">
            <span class="loading__dot"></span>
            <span class="loading__dot"></span>
            <span class="loading__dot"></span>
            <span class="loading__dot">
                    <span class="loading__dot-down"></span>
                </span>
        </div>
    </h1>
</div>

<div class="login">
    <div class="login__content">
        <div class="login__img">
            <img src="./src/img/login/img-login.png" alt="Connexion Image">
        </div>

        <div class="login__forms">
            <form action="" method="post" class="login__registre" id="login-in">
                <h1 class="login__title">Connexion</h1>

                <div class="login__box">
                    <i class='bx bx-user login__icon'></i>
                    <input type="text" name="username" placeholder="Pseudo" class="login__input">
                </div>

                <div class="login__box">
                    <i class='bx bx-lock-alt login__icon'></i>
                    <input type="password" name="password" placeholder="Mot de Passe" class="login__input">
                </div>

                <div class="login__error-wrapper">
                    <?php if(isset($login_error)): ?>
                        <p class="login__error"><?php echo $login_error; ?></p>
                    <?php endif; ?>
                </div>

                <button type="submit" name="login" class="login__button">Connexion</button>

                <div>
                    <span class="login__account">Vous n'avez pas de compte ?</span>
                    <span class="login__signin" id="sign-up">S'inscrire</span>
                </div>
            </form>

            <form action="" method="post" class="login__create none" id="login-up">
                <h1 class="login__title">Créer un compte</h1>

                <div class="login__box">
                    <i class='bx bx-user login__icon'></i>
                    <input type="text" name="username" placeholder="Pseudo" class="login__input">
                </div>

                <div class="login__box">
                    <i class='bx bx-at login__icon'></i>
                    <input type="text" name="email" placeholder="Email" class="login__input">
                </div>

                <div class="login__box">
                    <i class='bx bx-lock-alt login__icon'></i>
                    <input type="password" name="password" placeholder="Mot de Passe" class="login__input">
                </div>

                <button type="submit" name="register" class="login__button">S'inscrire</button>

                <div>
                    <span class="login__account">Vous avez déjà un compte ?</span>
                    <span class="login__signup" id="sign-in">Connexion</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<!--=============== JS ===============-->
<script src="./src/js/loader/main.js"></script>
<script src="./src/js/loader/start.js"></script>
<script src="./src/js/login/main.js"></script>
</body>
</html>