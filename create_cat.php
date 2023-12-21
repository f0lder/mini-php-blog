<?php

include 'connect.php';
include 'header.php';

echo 'Create a category';

if (isset($_SESSION['signed_in'])) {
    if ($_SESSION['signed_in'] == true) {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo '<form method="post" action="">
			            Numele categoriei: <input type="text" name="cat_name" /><br />
			            <p>Descrierea categoriei:<br/></p><p> <textarea name="cat_description" /></textarea><br/><br/></p>
			            <p><input type="submit" value="Adauga categorie" /></p>
		            </form>';
        } else {
            
            $sql = 'INSERT INTO categories(name,description)
            VALUES("' . $_POST['cat_name'] . '","' . $_POST['cat_description'] . '")';
            echo $sql;
            $result = $connection->query($sql);
            if (!$result) {
                echo 'Eroare' . mysqli_error($connection) . '';
            } else {
                echo 'Categorie adaugata cu succes!';
            }
        }
    } 
} else {
    echo "Nu esti connectat!";
}

include 'footer.php';