<?php

include 'connect.php';
include 'header.php';

echo 'Create a static page';

if (isset($_SESSION['signed_in'])) {
    if ($_SESSION['signed_in'] == true) {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo '<form method="post" action="">
			            Numele paginii: <input type="text" name="page_name" /><br />
			            <p>Content:<br/></p><p> <textarea name="page_content" /></textarea><br/><br/></p>
			            <p><input type="submit" value="Adauga pagina" /></p>
		            </form>';
        } else {

            $sql = 'INSERT INTO static(name,content)
            VALUES("' . $_POST['page_name'] . '","' . $_POST['page_content'] . '")';
            echo $sql;
            $result = $connection->query($sql);
            if (!$result) {
                echo 'Eroare' . mysqli_error($connection) . '';
            } else {
                echo 'Pagina adaugata cu succes!';
            }
        }
    }
} else {
    echo "Nu esti connectat!";
}

include 'footer.php';