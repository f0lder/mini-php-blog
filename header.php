<!DOCTYPE html>
<html lang="ro-RO">

<head>
    <meta charset="utf-8">
    <title>Mini Blog</title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
                                            echo ' <li><a class="dropdown-item" href="post.php?id='.$row_post['id'].'">'.$row_post['name'].'</a></li>';
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