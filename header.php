<!DOCTYPE html>
<html lang="ro-RO">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Blog</title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- include summernote css/js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css"/>

    <!-- include for syntax highlight css/js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/panda-syntax-light.css">

    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="h-25 mw-100 p-5" style="background-color: #eee;">

    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Mini Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" style="justify-content: space-between;">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Acasa</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="categories.php">Categorii</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="pages.php">Pagini</a>
                    </li>
                    <?php
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
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ' . $row['name'] . '
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

                                $sql_posts = 'SELECT
                                        id,
                                        name,
                                        content,
                                        parent_id,
                                        date
                                    FROM
                                        posts
                                    WHERE
                                        parent_id = ' . $row['id'];
                                $result_posts = $connection->query($sql_posts);

                                if (!$result_posts) {
                                    echo "Nu exista postari";
                                } else {
                                    if (mysqli_num_rows($result_posts) == 0) {
                                        echo '<li><a class="dropdown-item" href="#">Nu exista pagini</a></li>';
                                    } else {
                                        while ($row_post = mysqli_fetch_assoc($result_posts)) {
                                            echo ' <li><a class="dropdown-item" href="post.php?id=' . $row_post['id'] . '">' . $row_post['name'] . '</a></li>';
                                        }
                                    }
                                }
                                echo '</ul></li>';
                            }
                        }
                    }

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
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<li class="nav-item active">
                                        <a class="nav-link" href="page.php?id=' . $row['id'] . '">' . $row['name'] . '</a>
                                    </li>';
                            }
                        }
                    }
                    ?>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php
                    if (!empty($_SESSION)) {
                        if ($_SESSION['signed_in']) {
                            echo '<li class="nav-item">
                                <a class="nav-link" href="dashboard.php">Salut, ' . $_SESSION['username'] . '</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Deconectare</a>
                            </li>';
                        } else {
                            echo '<li class="nav-item">
                                <a class="nav-link" href="login.php">Conectare</a>
                            </li>';
                        }
                    } else {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="login.php">Conectare</a>
                            </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="mb-4" style="background-color: #eee">

        <div class="w-50 mx-auto p-3">