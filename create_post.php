<?php

include 'connect.php';
include 'header.php';

if (isset($_SESSION['signed_in'])) {
    if ($_SESSION['signed_in'] == false) {
        echo 'Trebuie sa pe autentifici pentru a crea o postare';
    } else {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $sql = 'SELECT
                        id,
                        name,
                        description
                    FROM
                        categories';
            $result = $connection->query($sql);

            if (!$result) {
                echo 'A aparut o eroare';
            } else {
                if (mysqli_num_rows($result) == 0) {
                    //TODO check for user level
                } else {
                    echo
                        '<h1>Creeaza o postare</h1>
                        <form id="postForm" method="post" action="">
                         <div class="form-row">

                         <div class="form-group col-md-6">
                            <input class="form-control" type="text" name="post_name" id="name" placeholder="Nume postare"/>
                        </div>
                        <div class="form-group col-md-6">';

                    echo '<select class="form-control" id="categorie" name="post_cat">
                    <option selected disabled hidden >Categorie</option>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    echo '</select></div></div>';
                    ?>

                    <div id="summernote">

                        <?php
                            include 'sample.php';
                        ?>

                    </div>

                    <input type="hidden" name="summernote" id="summer">

                    <div class="d-flex justify-content-center m-3">
                        <button type="button" class="btn btn-primary" onclick="submitForm()">Posteaza</button>
                    </div>

                    <script>
                        $(document).ready(function () {
                            $("#summernote").summernote({
                                height: 600,
                                tooltip: false,
                            });
                        });

                        function submitForm() {
                            // Get Summernote content and set it in the hidden input field
                            var summernoteContent = $('#summernote').summernote('code');
                            $('#summer').val(summernoteContent);

                            // Submit the form
                            $('#postForm').submit();
                        }
                    </script>

                    </form>
                    <?php
                }
            }
        } else {
            // incepem tranzactia
            $sql = 'INSERT INTO posts(name, content, parent_id, date)
                        VALUES("' . $_POST['post_name'] . '",\'' . $_POST['summernote'] . '\',' . $_POST['post_cat'] . ',NOW())';
            
            echo '<pre class="border border-success"><code class="sql">' . $sql . '</code></pre>';
            $result = $connection->query($sql);

            if (!$result) {
                echo 'A aparut o eroare la crearea postarii!' . mysqli_error($connection);
            } else {
                echo '<div class="alert alert-success" role="alert">
                            Postare creata cu succes!
                    </div>';
            }

        }
    }
}

include 'footer.php';