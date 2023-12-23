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

                         <div class="form-group">
                            <label for="name">Nume postare</label>
                            <input class="form-control" type="text" name="post_name" id="name"/>
                        </div>
                        <div class="form-group">
                             <label for="categorie">Categoie:</label>';

                    echo '<select class="form-control" id="categorie" name="post_cat">';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    echo '</select><br/>';
                    ?>

                    <div id="summernote">
                        <p>Hello Summernote</p>
                    </div>

                    <input type="hidden" name="summernote" id="summer">

                    <button type="button" onclick="submitForm()">Submit</button>
                    <script>
                        $(document).ready(function () {
                            $("#summernote").summernote();
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
            $sql = 'INSERT INTO
                            posts(name,
                                content,
                                parent_id,
                                date)
                        VALUES("' . $_POST['post_name'] . '","' . $_POST['summernote'] . '",' . $_POST['post_cat'] . ',NOW())';

            echo '<pre><code class="sql">' . $sql . '</code></pre>';
            $result = $connection->query($sql);

            if (!$result) {
                echo 'A aparut o eroare la crearea postarii!' . mysqli_error($connection);
            }

        }
    }
}

include 'footer.php';