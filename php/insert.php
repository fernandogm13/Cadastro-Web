<?php
include "connection.php";

$nome = $_POST['nome'];
$idade = $_POST['idade'];
$email = $_POST['email'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];

$sql = "INSERT INTO users (nome, idade, email, cidade, estado)
VALUES ('$nome', '$idade', '$email', '$cidade', '$estado')";

if ($conn->query($sql) === True) {
    header("Location: ../html/index.html?success=1");
    exit;
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

header("Location: ../html/index.html");
exit;

$conn->close();
?>