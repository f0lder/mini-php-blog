<?php

include 'connect.php';
include 'header.php';
//include 'left_menu.php';

$sql = 'SELECT
            categories.id,
            categories.name,
            categories.description
        FROM
            categories';

$result = $connection->query($sql);

if(!$result){
    echo 'Nu se poate afisa';
} else {
    if(mysqli_num_rows($result) == 0){
        echo 'Nu exista categorii';
    } else {

        // print all categories for now
        while($row = mysqli_fetch_assoc($result)){
            echo '<p>Categorie: '.$row['id'].', <a href = "category.php?id='.$row['id'].' " >'.$row['name'].'</a>, '.$row['description'].'</p>';
        }
    }
}

$sql_pages = 'SELECT
                        id,
                        name,
                        content
                    FROM
                        static';
$result = $connection->query($sql_pages);

if (!$result) {
    echo 'Paginile statice nu pot fi afisate';
} else {
    if (mysqli_num_rows($result) == 0) {
        echo 'Nu exista pagini statice';
    } else {
        echo '<h2>Pagini statice:</h2>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<p>' . $row['id'] . '<a href="page.php?id=' . $row['id'] . '">' . $row['name'] . '</a>  ' . $row['content'] . '</p>';
        }
    }
}

include 'footer.php';