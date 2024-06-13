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
    <title>Add new | Welt</title>
</head>
<body class="main">
    <?php 
        include 'mysql_connect.php';
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
    <main class="content">
        <section id="input">
            <form name="add-news" action="skripta.php" method="POST" enctype="multipart/form-data">
                <label for="title">Naslov vijesti</label>
                <input type="text" name="title" id="title" />

                <label for="short_content">Kratki sadržaj vijesti (do 100 znakova)</label>
                <textarea name="short_content" id="short_content"></textarea>

                <label for="content">Sadržaj vijesti</label>
                <textarea name="content" id="content"></textarea>

                <label for="image-upload">Slika</label>
                <input type="file" accept="image/*" id="image-upload" name="image">

                <label for="category">Kategorija vijesti</label>
                
                <?php 
                    $query = "SELECT * FROM categories";

                    $res = mysqli_query($dbc, $query) or die('Error kod slanja querya.');
                    
                    if( mysqli_num_rows($res) !== 0 ){
                        echo '<input list="news-types" name="category" id="category" />';
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
                <input type="checkbox" name="archive" id="archive" />

                <button type="reset" name="clear-form" id="clear-form">Poništi</button>
                <button type="submit" id="save-news">Spremi</button>
            </form>
        </section>
    </main>
    <footer class="footer">
        <div id="footer-logo">
            <img src="./img/logo.png">
        </div>
    </footer>
</body>
</html>