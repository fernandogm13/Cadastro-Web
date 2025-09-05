<?php
include "connection.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara o statement
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redireciona de volta para a tabela
        header("Location: ../html/view.html");
        exit;
    } else {
        echo "Erro ao excluir: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID inválido.";
}

$conn->close();
