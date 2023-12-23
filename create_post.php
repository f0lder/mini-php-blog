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
                        '<form id="postForm" method="post" action="">
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

                    <input type="hidden" name="summernote" id="summer">

                    <div class="d-flex justify-content-center m-3">
                        <button type="button" class="btn btn-primary" onclick="submitForm()">Posteaza</button>
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
                }
            }
        } else {
            // incepem tranzactia
            $sql = 'INSERT INTO posts(name, content, parent_id, date)
                        VALUES("' . $_POST['post_name'] . '",\'' . $_POST['summernote'] . '\',' . $_POST['post_cat'] . ',NOW())';
            
            echo '<pre><code class="sql">' . $sql . '</code></pre>';
            $result = $connection->query($sql);

            if (!$result) {
                echo 'A aparut o eroare la crearea postarii!' . mysqli_error($connection);
            }

        }
    }
}

include 'footer.php';