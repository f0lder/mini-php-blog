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

                <h1 class="">Postarea poate avea</h1>
                <p><br></p>
                <ul>
                    <li><u>Liste</u></li>
                    <li>Fara</li>
                    <li><b>Numar</b></li>
                </ul>
                <p>SAU</p>
                <ol>
                    <li>Liste&nbsp;</li>
                    <li>Cu&nbsp;</li>
                    <li>Numar</li>
                </ol>
                <p><br></p>
                <p><span style="background-color: rgb(255, 0, 0);">TEXT </span><span
                        style="background-color: rgb(0, 255, 255);">COLORAT</span></p>
                <p>
                    <font color="#ff0000">SAU ASA</font>
                </p>
                <p>
                    <font color="#ff0000"><br></font>
                </p>
                <p><a href="http://google.com" target="_blank">link uri</a>
                    <font color="#ff0000"><br></font>
                </p>

            </div>
            <input type="hidden" name="page_content" id="summer">
            <div class="d-flex justify-content-center m-3">
                <button type="button" class="btn btn-primary" onclick="submitForm()">Posteaza pagina</button>
            </div>
            <script>
                $(document).ready(function () {
                    $("#summernote").summernote({
                        height: 600
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
            echo $sql;
            $result = $connection->query($sql);
            if (!$result) {
                echo 'Eroare' . mysqli_error($connection) . '';
            } else {
                echo 'Pagina adaugata cu succes!';
            }
        }
    }
} else {
    echo "Nu esti connectat!";
}

include 'footer.php';