<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" type="image/x-icon" href="./img/favico.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Welt News</title>
</head>
<body class="main">
    <?php 
        include 'mysql_connect.php';
        define('UPLOADPATH', './uploads/');
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
        <section class="clanak">
            <div class="container">
                <div class="row">
                    <?php 
                        $query = "SELECT * FROM news LEFT JOIN categories ON categories.name = news.category WHERE news.id=" . $_GET['id'];
                        $result = mysqli_query($dbc, $query);

                        while($row = mysqli_fetch_array($result)){
                    
                            echo '<h5 class="ar-category">'. $row['display_name'] .'</h5>';
                            echo '<h3 class="ar-title">'. $row['title'] .'</h3>';
                            echo '<div class="ar-date">Objavljeno: '. $row['date'].'</div>';
                            echo '<div class="ar-picture"><img src="'. UPLOADPATH . $row['image_name'].'"></div>';
                            echo '<section class="ar-short_content"><p>'. $row['short_content'] .'</p></section>';
                            echo '<section class="ar-content"><p>'. nl2br($row['content']).'</p></section>';
                        }                  
                    ?>
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