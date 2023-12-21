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
                        '<form method="post" action="">
                        Nume postare: <input type="text" name="post_name" /><br/>
                        <p>Categorie:';
                    echo '<select name="post_cat">';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    echo '</select><br/>';
                    echo '<p>Content: <br/><p><textarea name="post_content"/></textarea><br/><br/>
                        <p><input type="submit" value="Creaza SUBIECT"/>

                        <div id="summernote" name="content2"><p>Hello Summernote</p></div>
  <script>
    $(document).ready(function() {
        $("#summernote").summernote();
    });
  </script>
                        
                    </form>';
                }
            }
        } else {
            // incepem tranzactia
            $sql = 'INSERT INTO
                            posts(name,
                                content,
                                parent_id,
                                date)
                        VALUES("' . $_POST['post_name'] . '","' . $_POST['post_content'] . '",' . $_POST['post_cat'] . ',NOW())';

            echo $sql;
            $result = $connection->query($sql);
            
            if (!$result) {
                echo 'A aparut o eroare la crearea postarii!' . mysqli_error($connection);
            }

        }
    }
}

include 'footer.php';