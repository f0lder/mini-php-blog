<?php 

include 'connect.php';
include 'header.php';

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true){

    $_SESSION['signed_in'] = NULL;
    $_SESSION['user_name'] = NULL;
    $_SESSION['user_id'] = NULL;

    echo '<h2>Delogare</h2>';
    echo '<p>Va mai asteptam!</p>';

    header('Location: index.php');
    exit();
} else {

    echo '<h2>Delogare</h2>';
    echo '<p>Nu sunteti autentificat. Doriti sa va <a href="login.php">autentificati</a>?';
}

include 'footer.php';