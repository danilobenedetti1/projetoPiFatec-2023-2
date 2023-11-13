<?php

$host = "localhost"; // nome do servidor MySQL
$user = "id21539908_admin"; // usuário do MySQL
$pass = "Pi_12345"; // senha do MySQL
$dbname = "id21539908_netcar"; // nome do banco de dados

// Conexão com o banco de dados MySQL
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Verifica se houve erro na conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}