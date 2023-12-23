<?php

include 'connect.php';
include 'header.php';

$sql = 'SELECT
            id,
            name,
            content
        FROM
            static
        WHERE
            id = ' . $_GET['id'];

$result = $connection->query($sql);

if (!$result) {
    echo "Postarea nu poate fi afisata!";
} else {
    if (mysqli_num_rows($result) == 0) {
        echo "Aceasta postare nu exista!";
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="m-4 p-3" style="background-color: white">';
            echo '<h3 class="m-3 text-center">' . $row['name'] . '</h3>';
            echo '<p class="p-2">' . $row['content'] . '</p>';
            echo '</div>';

            echo '<h4 class="p-3"><a class="text-decoration-none" href="pages.php">&larr; Inapoi la pagini</a> </h4>';
        }
    }
}

include 'footer.php';