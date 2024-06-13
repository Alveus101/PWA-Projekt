<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" type="image/x-icon" href="./img/favico.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add new | Welt</title>
</head>
<body class="main">
    <?php
        include 'mysql_connect.php';
        
        if(isset($_POST['title'])){

            $id = NULL;
            $title = NULL;
            $short_content = NULL;
            $content = NULL;
            $image_existing = NULL;
            $category = NULL;
            $archive = NULL;

            $edit = '0';

            if(isset($_POST['title'])) $title = $_POST['title'];
            if(isset($_POST['short_content'])) $short_content = $_POST['short_content'];
            if(isset($_POST['content'])) $content = $_POST['content'];
            if(isset($_POST['category'])) $category = strtolower($_POST['category']);
            if(isset($_POST['archive'])) $archive = 1; else $archive = 0;
            if(isset($_POST['edit'])) $edit = $_POST['edit'];
            if(isset($_POST['id'])) $id = $_POST['id'];
            if(isset($_POST['image-existing'])) $image_existing = $_POST['image-existing'];
            if(isset($_POST['delete-news'])) $edit = '2';

            $upload_dir = "./uploads/";
            
            if( $edit == '0' || $_FILES['image']['name'] ){
                $date = gmdate('d.m.Y.', time());
                $timestamp = gmdate('m-d-Y_H-i-s', time());

                $exploded_filename = explode(".", $_FILES['image']['name']);
                $filename = $timestamp . '.' . end($exploded_filename);
                $filepath = $upload_dir . $filename;

                $valid = 1;
                $imgFileType = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
            }
            else{
                $filename = $image_existing;
                $filepath = $upload_dir . $image_existing;
            }
            
            
        }
    ?>

    <header class="header">
        <nav id="navbar">
            <div id="logo">
                <img src="./img/logo.png" alt="Welt logo" title="Welt logo">
                <?php 
                    session_start();
                    if(isset($_SESSION['logged_in_user_id'])){
                        $hour = date("H");
                        echo '<div id="logged-user">';
                            echo '<div id="greeting">';

                                if( $hour >= 0 && $hour < 12 ) echo "Dobro jutro " . $_SESSION['logged_in_user_username'] . ".";
                                else if( $hour >= 12 && $hour < 18 ) echo "Dobar dan " . $_SESSION['logged_in_user_username'] . ".";
                                else if( $hour >= 18 && $hour < 23 ) echo "Dobra večer " . $_SESSION['logged_in_user_username'] . ".";

                            echo '</div>';
                            echo '<a href="./logout.php" id="logout-button">Odjava</a>';
                        echo '</div>';
                    }
                ?>
            </div>
            <div id="navigation">
                <ul>
                    <?php 
                        $query = "SELECT * FROM pages";
                        $result = mysqli_query($dbc, $query);
                        $is_user_logged_in = 0;
                        $is_user_admin = 0;

                        if(isset($_SESSION['logged_in_user_id'])){
                            $is_user_logged_in = 1;
                            if( $_SESSION['logged_in_user_permission'] == 1 ){
                                $is_user_admin = 1;
                            }
                        }

                        while($row = mysqli_fetch_array($result)) {
                            if($row['hidden'] == 1){
                                if($is_user_admin) echo '<a href="'. $row['href'] .'"><li>'. $row['name'] .'</li></a>';
                                else continue;
                            }
                            else if($row['hidden'] == 2 && $is_user_logged_in){
                                continue;
                            }
                            else echo '<a href="'. $row['href'] .'"><li>'. $row['name'] .'</li></a>';
                        }

                        $query = "SELECT * FROM categories";
                        $result = mysqli_query($dbc, $query);

                        while($row = mysqli_fetch_array($result)) {
                            echo '<a href="kategorija.php?id='. $row['name'] .'"><li>'. $row['display_name'] .'</li></a>';
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </header>
    <section id="new-preview">

        <div class="new-message"> 
            <?php 
                $check = NULL;
                $valid = 1;

                if( $_FILES["image"]["tmp_name"] ) {
                    $check = getimagesize($_FILES["image"]["tmp_name"]);

                    if($check !== false) $valid = 1;
                    else {
                        echo "File nije slika";
                        $valid = 0;
                    }
        
                    if($valid == 0){
                        echo "Upload nije ok";
                    }
                    else {
                        if( move_uploaded_file($_FILES["image"]["tmp_name"], $filepath)){
                            echo "File ". htmlspecialchars( basename( $_FILES["image"]["name"])) . " je uploadana.";
                        }
                        else{
                            echo "Dogodila se greška.";
                        }
                    }
                }

                
            ?>
        </div>

        <div class="database-message">
            <?php 
                if($valid == 1){
                    
                    if( $edit === '1' ){
                        #$query = "UPDATE news SET title='$title', short_content='$short_content', content='$content', category='$category', image_name='$filename', archive='$archive' WHERE id='$id'";
                        #$res = mysqli_query($dbc, $query) or die('Error kod slanja querya.');

                        $query = "UPDATE news SET title=?, short_content=?, content=?, category=?, image_name=?, archive=? WHERE id=?";
                        $stmt = mysqli_stmt_init($dbc);

                        if (mysqli_stmt_prepare($stmt, $query)){
                            mysqli_stmt_bind_param($stmt,'sssssdd', $title, $short_content, $content, $category, $filename, $archive, $id );
                            mysqli_stmt_execute($stmt);
                        }

                        echo '<div class="success-message"><p>Vijest je uređena!</p></div>';

                        header("refresh: 2; url = ./clanak.php?id=" . $id);
                    }
                    else if( $edit === '2' ){
                        $query = "DELETE FROM news WHERE id = '$id'";
                        $res = mysqli_query($dbc, $query) or die('Error kod slanja querya.');

                        if( !unlink($filepath) ){
                            echo '<div class="error">' . $filepath . 'ne može biti obrisana zbog errora.';
                        }

                        echo '<div class="deleted-message"><p>Ova vijest je obrisana!</p></div>';

                        header("refresh: 2; url = ./administracija.php");
                    }
                    else {
                        #$query = "INSERT INTO news(date, title, short_content, content, category, image_name, archive) VALUES ('$date', '$title', '$short_content', '$content', '$category', '$filename', '$archive')";
                        #$res = mysqli_query($dbc, $query) or die('Error kod slanja querya.');

                        $query = "INSERT INTO news(date, title, short_content, content, category, image_name, archive) VALUES (?,?,?,?,?,?,?)";
                        $stmt = mysqli_stmt_init($dbc);

                        if (mysqli_stmt_prepare($stmt, $query)){
                            mysqli_stmt_bind_param($stmt,'ssssssd', $date, $title, $short_content, $content, $category, $filename, $archive );
                            mysqli_stmt_execute($stmt);
                        }
                        echo '<div class="success-message"><p>Vijest je spremljena!</p></div>';

                        header("refresh: 2; url = ./clanak.php?id=" . mysqli_insert_id($dbc));
                    }
                    
                    mysqli_close($dbc);   
                }
            ?>
        </div>
    </section>
    <footer class="footer" id="f-unos">
        <div id="footer-logo">
            <img src="./img/logo.png">
        </div>
    </footer>
</body>
</html>