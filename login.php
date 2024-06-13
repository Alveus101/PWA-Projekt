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
    <title>Login | Welt</title>
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
    <section id="login">
        <div class="container">
            <form name="login_form" id="login_form" action="login.php" method="POST" >
                <div class="row">
                    <div class="col-lg-12"> 
                        <label for="username">Korisničko ime:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"> 
                        <input type="text" name="username" id="username" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"> 
                        <label for="password">Lozinka:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"> 
                        <input type="password" name="password" id="password" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"> 
                        <button type="submit" id="login_button">Login</button>
                    </div>
                </div>         
            </form>
        </div>
    </section>
    <section id="register">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <a class="large-button" id="register_button" href="./registracija.php">Registracija</a>
                </div>
            </div>
        </div>
    </section>
    <section id="message">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php 
                        if(isset($_POST['username'])){
                            $username = NULL;
                            $password = NULL;

                            $password_stored = NULL;
                            $permission = NULL;

                            if(isset($_POST['username'])) $username = $_POST['username'];
                            if(isset($_POST['password'])) $password = $_POST['password'];

                            $query = "SELECT id, username, password, permission FROM korisnik WHERE username = ? LIMIT 1";
                            $stmt = mysqli_stmt_init($dbc);

                            if(mysqli_stmt_prepare($stmt, $query)){
                                mysqli_stmt_bind_param($stmt,'s',$username);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_store_result($stmt);
                            }

                            mysqli_stmt_bind_result($stmt, $id, $username, $password_stored, $permission);
                            mysqli_stmt_fetch($stmt);

                            if( $id ){
                                if( password_verify($password, $password_stored) ){
                                    echo 'Login uspješan!';

                                    session_start();
                                    $_SESSION['logged_in_user_id'] = $id;
                                    $_SESSION['logged_in_user_username'] = $username;
                                    $_SESSION['logged_in_user_permission'] = $permission;

                                    header("Location: ./index.php");
                                }
                                else{
                                    echo '<div class="error">Netočna lozinka.</div>';
                                }
                            }
                            else{
                                echo '<div class="error">Netočno korisničko ime ili lozinka.</div>';
                            }
                        }

                        mysqli_close($dbc);
                    ?>
                </div>
            </div>
        </div>
    </section>
    <footer id="f-unos" class="footer">
        <div id="footer-logo">
            <img src="./img/logo.png">
        </div>
    </footer>
</body>
</html>