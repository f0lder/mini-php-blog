<?php

include 'connect.php';
include 'header.php';

echo '<h1>Creeaza o categorie</h1>';

if (isset($_SESSION['signed_in'])) {
    if ($_SESSION['signed_in'] == true) {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo '<form method="post" action="" id="catForm">
                    
                        <div class="form-group m-3">
                            <input class="form-control" type="text" name="cat_name" id="cat_name" placeholder="Nume Categorie"/>
                        </div>
                   
                        <div class="form-group m-3">
                            <textarea class="form-control" type="text" name="cat_description" id="name" placeholder="Descriere Categorie"></textarea>
                        </div>
                    
                        <div class="d-flex justify-content-center m-3">
                            <input type="submit" class="btn btn-primary" value="Creaza"/>
                        </div>
		            </form>';
        } else {
            
            $sql = 'INSERT INTO categories(name,description)
            VALUES("' . $_POST['cat_name'] . '","' . $_POST['cat_description'] . '")';
            echo '<pre class="border border-success"><code class="sql">' . $sql . '</code></pre>';
            $result = $connection->query($sql);
            if (!$result) {
                echo 'Eroare' . mysqli_error($connection) . '';
            } else {
                echo '<div class="alert alert-success" role="alert">
                            Categorie creata cu succes!
                    </div>';
            }
        }
    } 
} else {
    echo "Nu esti connectat!";
}

include 'footer.php';