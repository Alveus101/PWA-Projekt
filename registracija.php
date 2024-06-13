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
    <title>Register | Welt</title>
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
    <section id="register">
        <div class="container">
            <div class="center-container">
                <form name="register_form" id="register_form" action="registracija.php" method="POST" >
                    <div class="row">
                        <div class="col-lg-12"> 
                            <label for="username">Ime:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12"> 
                            <input type="text" name="name" id="name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12"> 
                            <label for="username">Prezime:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12"> 
                            <input type="text" name="surname" id="surname" />
                        </div>
                    </div>
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
                            <label for="repeat_password">Ponovljena lozinka:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12"> 
                            <input type="password" name="repeat_password" id="repeat_password" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12"> 
                            <button type="submit" id="login_button">Registracija</button>
                        </div>
                    </div>         
                </form>
            </div>
        </div>
    </section>
    <?php 
        if(isset($_POST['username'])){
            
            $id = NULL;
            $name = NULL;
            $surname = NULL;
            $username = NULL;
            $permission = 0;
            $password = NULL;
            $password_repeat = NULL;
            $password_hash = NULL;


            if(isset($_POST['name'])) $name = $_POST['name'];
            if(isset($_POST['surname'])) $surname = $_POST['surname'];
            if(isset($_POST['username'])) $username = $_POST['username'];
            if(isset($_POST['password'])) $password = $_POST['password'];
            if(isset($_POST['repeat_password'])) $password_repeat = $_POST['repeat_password'];


            $query = "SELECT * FROM korisnik WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($dbc, $query);
            if( $result ) $user = mysqli_fetch_array($result);

            if( $user && $user['username'] == $username ){
                echo '<div class="error">Korisničko ime je zauzeto. </div>';
            }
            else{        
                if($password === $password_repeat){
                    $password_hash = password_hash($password, CRYPT_BLOWFISH);

                    $query = "INSERT INTO korisnik(name,surname,username,password,permission) VALUES(?,?,?,?,?)";
                    
                    $stmt = mysqli_stmt_init($dbc);

                    if (mysqli_stmt_prepare($stmt, $query)){
                        mysqli_stmt_bind_param($stmt,'ssssd', $name, $surname, $username, $password_hash, $permission );
                        mysqli_stmt_execute($stmt);
                    }

                    $query = "SELECT id FROM korisnik WHERE username = '$username'";
                    $result = mysqli_query($dbc, $query);
                    if( $result ) $id = mysqli_fetch_array($result);

                    $_SESSION['logged_in_user_id'] = $id;
                    $_SESSION['logged_in_user_username'] = $username;
                    $_SESSION['logged_in_user_permission'] = $permission;

                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-lg-12">';
                                echo '<div class="register-message">Registracija je uspješna!</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                        
                }
                else{
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-lg-12">';
                                echo '<div class="error">Unesene lozinke se ne podudaraju.</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            }
        }

        mysqli_close($dbc);
    ?>
    <footer id="f-unos" class="footer">
        <div id="footer-logo">
            <img src="./img/logo.png">
        </div>
    </footer>
</body>
</html>