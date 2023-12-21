<?php

include 'connect.php';
include 'header.php';

if (isset($_GET['id'])) {
    $sql = "SELECT
                id,
                name,
                description
            FROM
                categories
            WHERE
                id=" . $_GET["id"];
    $result = $connection->query($sql);

    if (!$result) {
        echo 'Aceasta categorie nu poate fi afisata';
    } else {
        if (mysqli_num_rows($result) == 0) {
            echo 'Categoria nu exista!';
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<h3 class="p-3">'. $row['name'] . ' <small class="text-muted">(Categorie)</small></h3>';
            }
            //extragem postarile din cat

            $sql = 'SELECT
                        id,
                        name,
                        content,
                        date,
                        parent_id
                    FROM
                        posts
                    WHERE
                        parent_id =' . $_GET['id'] . '
                    ORDER BY date
                    DESC';
            //echo $sql;
            $result = $connection->query($sql);
            if (!$result) {
                echo 'Aceasta postare nu poate fi accesata momentan!';
            } else {
                if (mysqli_num_rows($result) == 0) {
                    echo 'Aceasta categorie nu are postari';
                } else {
                    //afiseaza postarile
                   
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="m-4 p-3" style="background-color: white">';
                        echo '<h3 class="m-3"><a class="text-decoration-none" class="" href="post.php?id=' . $row['id'] . '">' . $row['name'] . '</a><br /></h3>';
                        echo '<p class="p-2">Postat la ' . $row['date'] . '</p>';
                        echo '<p class="p-2">'.$row['content'].'</p>';
                        echo '</div>';
                    }
                    
                }
            }
        }
    }
}

include 'footer.php';