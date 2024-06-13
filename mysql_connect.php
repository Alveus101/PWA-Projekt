<?php 
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'welt';

    $dbc = mysqli_connect($hostname, $username, $password, $database) or die('Dogodila se greška kod spajanja na MySQL server.' . mysqli_connect_error());
?>