<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "marketeste";

    //Conectar ao banco de dados
    try {
        $conn = new mysqli($hostname, $username, $password, $database);
    } catch (Exception $e) {
        die("Erro ao conectar:" . $e->getMessage());
    }
?>