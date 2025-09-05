<?php
$servername = "localhost";
$username = "root";
$password = "";

// Conecta ao MySQL (sem selecionar banco ainda)
$conn = new mysqli($servername, $username, $password);

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Cria banco de dados se não existir
$sql = "CREATE DATABASE IF NOT EXISTS user_db";
if ($conn->query($sql) === TRUE) {
    echo "Banco criado com sucesso!<br>";
} else {
    echo "Erro ao criar o banco: " . $conn->error . "<br>";
}

// Seleciona o banco recém-criado
$conn->select_db("user_db");

// Cria tabela users
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    idade VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cidade VARCHAR(50),
    estado CHAR(2)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela criada com sucesso!";
} else {
    echo "Erro ao criar a tabela: " . $conn->error;
}

$conn->close();
?>