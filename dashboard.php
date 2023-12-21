<?php

include 'connect.php';
include 'header.php';

if (isset($_SESSION['signed_in'])) {
    if($_SESSION['signed_in'] == true){
        echo '<h1>Dashboard </h1>';
        echo '<h2>Aici poti crea postari!</h2>
        <a type="button" class="btn btn-primary" href="index.php">Acasa</a>
        <a type="button" class="btn btn-primary" href="create_post.php">Creaza o Postare</a>
        <a type="button" class="btn btn-primary" href="create_cat.php">Creaza o Categorie</a>
        <a type="button" class="btn btn-primary" href="create_page.php">Creaza o Pagina</a>
        <a type="button" class="btn btn-outline-secondary" href="logout.php">Deconectare</a>';


        //selectam toate paginile statice
        $sql_pages = 'SELECT
                        id,
                        name,
                        content
                    FROM
                        static';
        $result = $connection->query($sql_pages); 

        if(!$result){
            echo 'Paginile statice nu pot fi afisate';
        } else {
            if(mysqli_num_rows($result) == 0){
                echo 'Nu exista pagini statice';
            } else {
                echo '<h2>Pagini statice:</h2>';
                 while ($row = mysqli_fetch_assoc($result)) {
                    echo '<p>'.$row['id'].'<a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="page.php?id='.$row['id'].'">'.$row['name'].'</a>  '.$row['content'].'</p>';
                 }
            }
        }

        // selectam totate categoriile
        $sql_cat = 'SELECT
                        id,
                        name,
                        description
                    FROM
                        categories';
        $result = $connection->query($sql_cat);

        if (!$result) {
            echo 'Categoriile nu pot fi afisate';
        } else {
            if (mysqli_num_rows($result) == 0) {
                echo 'Nu exista categorii!';
            } else {
                echo '<h2>Categorii:</h2>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<p> Categorie:' . $row['id'] . '<a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="category.php?id=' . $row['id'] . '">' . $row['name'] . '</a>  ' . $row['description'] . '</p>';
                    //pentru fiecare categorie afisam postarile

                    $sql_posts = 'SELECT
                        id,
                        name,
                        content,
                        parent_id,
                        date
                    FROM
                        posts
                    WHERE
                        id = '.$row['id'];
                    $result_posts = $connection->query($sql_posts);

                    if(!$result_posts) {
                        echo "Nu exista postari";
                    } else {
                        if(mysqli_num_rows($result_posts) == 0) {
                            echo "<h2>Aceasta categorie nu are postari</h2>";
                        } else {
                            echo "<h2>Postari in categorie:</h2>";
                            while($row_post= mysqli_fetch_assoc($result_posts)) {
                                echo '<p>' . $row_post['id'] . '<a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="post.php?id=' . $row_post['id'] . '">' . $row_post['name'] . '</a>  ' . $row_post['content'] . '</p>';
                            }
                        }
                    }
                }
            }
        }
    } 
} else {
    echo "Nu ai permisiuni sa accesezi aceasta pagina!";
}
include 'footer.php';