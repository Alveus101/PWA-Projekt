<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" type="image/x-icon" href="./img/favico.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>
    <title>Administration | Welt</title>
</head>
<body class="main">
    <?php 
        session_start();
        include 'mysql_connect.php';
        define('UPLOADPATH', './uploads/');

        if( !$_SESSION['logged_in_user_id'] ){
            header("Location: ./login.php");
        }
        else if( $_SESSION['logged_in_user_permission'] != 1 ){
            header("Location: ./no_perm.php");
        }
    ?>
    <header class="header">
        <nav id="navbar">
            <div id="logo">
                <img src="./img/logo.png" alt="Welt logo" title="Welt logo">
                <?php 
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
    <?php 
        $article = NULL;

        $title = NULL;
        $short_content = NULL;
        $content = NULL;
        $image_name = NULL;
        $image_path = NULL;
        $category = NULL;
        $archive = NULL;
        $selected = NULL;
            
        if(isset($_POST['selected-news'])) {
            $selected = $_POST['selected-news'];

            $query = "SELECT * FROM news WHERE id = '$selected'";
            $result = mysqli_query($dbc, $query) or die('Error kod slanja querya.');
            
            $article = mysqli_fetch_array($result);

            $title = $article['title'];
            $short_content = $article['short_content'];
            $content = $article['content'];
            $image_name = $article['image_name'];
            $image_path = UPLOADPATH . $article['image_name'];
            $category = $article['category'];
            $archive = $article['archive'];
            
        }

    ?>
    <main class="content">
        <section id="administration">
            <div class="container">
                <div class="row">
                    <div id="add-new-button" class="col-lg-12"> 
                        <a class="large-button" href="./unos.php">+ Dodaj novu vijest</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Uredi vijest</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form name="choose-news-form" action="administracija.php" method="POST" id="choose-news-form">
                            <?php 
                                $query = "SELECT id, title FROM news";
                                $res = mysqli_query($dbc, $query) or die('Error kod slanja querya.');

                                $i = 0;
                                
                                if( mysqli_num_rows($res) !== 0 ){
                                    echo '<select id="edit-selection" name="selected-news" form="choose-news-form">';
                                    while($row = mysqli_fetch_array($res)){
                                        
                                        $i++;
                                        if( $row['id'] == number_format($selected) ) echo '<option value="'. $row['id'] . '" selected>'. $row['id'] . ' | ' . $row['title'] . '</option>';
                                        else echo '<option value="'. $row['id'] . '">'. $row['id'] . ' | ' . $row['title'] . '</option>';

                                    }
                                    echo '</select>';
                                    echo '<button type="submit" id="choose-submit" class="large-button">Odaberi</button>';
                                }
                                else echo '<div class="no-categories">U bazi nije pronađena niti jedna vijest.</div>';
                            ?>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div id="input" class="col-lg-12">
                        <?php 
                            if( $selected === NULL ){
                                echo '<style> #edit-form{ display: none; }</style>';
                            }
                        ?>
                                
                        <form name="edit-news" action="skripta.php" method="POST" enctype="multipart/form-data" id="edit-form">
                            <label for="title">Naslov vijesti</label>
                            <input type="text" name="title" id="title" value="<?php echo $title; ?>" />

                            <label for="short_content">Kratki sadržaj vijesti (do 100 znakova)</label>
                            <textarea name="short_content" id="short_content"><?php echo $short_content; ?></textarea>

                            <label for="content">Sadržaj vijesti</label>
                            <textarea name="content" id="content"><?php echo $content; ?></textarea>

                            <label for="image-upload">Slika</label>
                            <?php 
                                if(UPLOADPATH !== $image_path) 
                                    echo '<img src="' . $image_path . '" class="editing-image" /> ';
                                else echo '<div class="image-none">Nije uploadana niti jedna slika.</div>';
                            ?>
                            <input type="hidden" name="image-existing" value="<?php echo $image_name; ?>">
                            <input type="file" accept="image/*" id="image-upload" name="image">

                            <label for="category">Kategorija vijesti</label>
                            
                            <?php 
                                $query = "SELECT * FROM categories";

                                $res = mysqli_query($dbc, $query) or die('Error kod slanja querya.');
                                
                                if( mysqli_num_rows($res) !== 0 ){
                                    echo '<input list="news-types" name="category" id="category" value="' . $category . '" />';
                                    echo '<datalist id="news-types">';
                                    while($row = mysqli_fetch_array($res)){
                                        echo '<option value="'. $row['display_name'] . '"></option>';
                                    }
                                    echo '</datalist>';
                                }
                                else echo '<div class="no-categories">U bazi nije pronađena niti jedna kategorija.</div>';

                                mysqli_close($dbc);
                            ?>

                            <label for="archive">Spremiti u arhivu?</label>
                            <?php
                                if( $archive == 1 ) echo '<input type="checkbox" name="archive" id="archive" checked/>';
                                else echo '<input type="checkbox" name="archive" id="archive" />';
                            ?>

                            <input type="hidden" name="id" value="<?php echo $selected; ?>">
                            <input type="hidden" name="edit" value="1">
                            
                            <button type="sumbit" name="delete-news" id="delete-news">Izbriši</button>
                            <button type="submit" name="save-news" id="save-news">Spremi</button>
        
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div id="footer-logo">
            <img src="./img/logo.png">
        </div>
    </footer>
</body>
</html>