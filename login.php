<?php
include 'connect.php';
include 'header.php';


//$_SESSION['signed_in'] = true;

if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
    echo '<p>Esti deja conectat!</p>';
    echo '<p>Te poti deconecta <a href="logout.php" >aici</a>.</p>';
} else {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo '<p>Conectare</p>';
        echo '<form action="" method="POST">
                <div class="form-group m-3">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username" name="username">
                </div>
                <div class="form-group m-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <button type="submit" class="btn btn-primary m-3">Login</button>
                </form>';
    } else {
        //echo "Posting!";
        $err = array();

        if (empty($_POST['username'])) {
            $err[] = 'Campul username nu poate fi gol!';
        }

        if (empty($_POST['password'])) {
            $err[] = 'Campul parola nu poate fi gol!';
        }

        if (!empty($err)) {
            echo '<p>Erori la conectare!</p>';
            echo '<ul>';
            foreach ($err as $key => $value) {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>';
        } else {
            $un_temp = $_POST['username'];
            $pw_temp = $_POST['password'];

            $s1 = "&c.?@";
            $s2 = "m#-#?!#@";
            $token = hash("ripemd128", "$s1$pw_temp$s2");

            //echo "TOKEN: $token";
            $sql = 'SELECT
                        id,
                        username,
                        password
                    FROM
                        users
                    WHERE
                        username = "' . $un_temp . '"
                    AND
                        password = "' . $token . '"';
            $result = $connection->query($sql);

            if (!$result) {
                echo '<p>A aparut o eroare la autentificare. Incercati mai tarziu</p>';
            } else {
                if (mysqli_num_rows($result) == 0) {
                    echo '<p>Parola sau nume incorect!</p>';
                } else {
                    $_SESSION['signed_in'] = true;

                    while ($row = mysqli_fetch_array($result)) {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['password'] = $row['password'];
                    }
                    echo '<p>Bine ai venit: '. $_SESSION['username'].'</p>';
                    echo '<p><a href="index.php">Mergeti la pagina principala</a></p>';
                }
            }
        }
    }
}
//header('Location: index.php');
exit();