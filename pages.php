<?php

include 'connect.php';
include 'header.php';

//selectam toate paginile statice
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
        echo '<h2 class="p-3">Pagini</h2>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="m-4 p-3" style="background-color: white">';
            echo '<h3 class="m-3"><a class="text-decoration-none" href="page.php?id=' . $row['id'] . '">' . $row['name'] . '</a><br /></h3>';
            echo '<p class="p-2">' . $row['content'] . '</p>';
            echo '</div>';
        }
    }
}

include 'footer.php';