<?php

include 'connect.php';
include 'header.php';


$sql = 'SELECT
            categories.id,
            categories.name,
            categories.description
        FROM
            categories';

$result = $connection->query($sql);

if (!$result) {
    echo 'Nu se poate afisa';
} else {
    if (mysqli_num_rows($result) == 0) {
        echo 'Nu exista categorii';
    } else {

        // print all categories for now
        while ($row = mysqli_fetch_assoc($result)) {
        
            echo '<div class="card m-4">
                <div class="card-header">
                    Categorie
                    <small class="text-muted">' . $row['id'] . ' </small>
                </div>
                <div class="card-body">
                    <h5 class="card-title">' . $row['name'] . '</h5>
                    <p class="card-text">' . $row['description'] . '</p>
                    <a type="button" class="btn btn-primary" href="category.php?id=' . $row['id'] .'">Vezi postari</a>
                </div>
            </div>';
            
        }
    }
}

include 'footer.php';