<?php
    error_reporting(0);

    // Conexión al host y a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'demo');
    session_start();
    // Ajustes de la página web
    $sitename = "CutUrl";
    $site = "http://localhost";
    $colorsv = "#14b3e2";

    if(isset($_SESSION['id'])){
        $sql_user = "SELECT * FROM users WHERE id='". $_SESSION[id] ."'";
        $result_sql_user = $conn->query($sql_user);
        $user = $result_sql_user->fetch_array();
    }
?>