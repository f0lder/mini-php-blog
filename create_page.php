<?php

include 'connect.php';
include 'header.php';

echo '<h1>Creeaza o pagina</h1>';

if (isset($_SESSION['signed_in'])) {
    if ($_SESSION['signed_in'] == true) {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo '<form method="post" action="" id="postForm">';
            ?>
            <div class="form-group">
                <input class="form-control" type="text" name="page_name" id="name" placeholder="Nume pagina" />
            </div>
            <div id="summernote">

              <?php
                include 'sample.php';
              ?>

            </div>
            <input type="hidden" name="page_content" id="summer">
            <div class="d-flex justify-content-center m-3">
                <button type="button" class="btn btn-primary" onclick="submitForm()">Posteaza pagina</button>
            </div>
            <script>
                $(document).ready(function () {
                    $("#summernote").summernote({
                        height: 600,
                        tooltip: false
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
        } else {

            $sql = 'INSERT INTO static(name,content)
            VALUES("' . $_POST['page_name'] . '",\'' . $_POST['page_content'] . '\')';
            echo '<pre class="border border-success"><code class="sql">' . $sql . '</code></pre>';
            $result = $connection->query($sql);
            if (!$result) {
                echo 'Eroare' . mysqli_error($connection) . '';
            } else {
                echo '<div class="alert alert-success" role="alert">
                            Pagina creata cu succes!
                    </div>';
            }
        }
    }
} else {
    echo "Nu esti connectat!";
}

include 'footer.php';