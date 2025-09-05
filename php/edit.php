<?php
include "connection.php";

// Pega o id do GET
if (!isset($_GET['id'])) {
    die("ID do usuário não fornecido.");
}
$id = intval($_GET['id']);

// Busca os dados do usuário
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("Usuário não encontrado.");
}

$user = $result->fetch_assoc();

// Se enviou o formulário, atualiza o usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome   = $conn->real_escape_string($_POST['nome']);
    $idade  = intval($_POST['idade']);
    $email  = $conn->real_escape_string($_POST['email']);
    $cidade = $conn->real_escape_string($_POST['cidade']);
    $estado = $conn->real_escape_string($_POST['estado']);

    $update = "UPDATE users SET 
                nome='$nome', idade=$idade, email='$email', 
                cidade='$cidade', estado='$estado' 
               WHERE id=$id";

    if ($conn->query($update) === TRUE) {
        // Redireciona para a tela de cadastro
        header("Location: ../html/view.html");
        exit;
    } else {
        $error = "Erro ao atualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <header id="site-header">
        <h1>Editar Usuário</h1>
    </header>
    <main id="form-page">
        <div id="form-container">
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form action="" method="post">
                <!-- Mantém o id em hidden -->
                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($user['nome']) ?>" required>

                <label for="idade">Idade:</label>
                <input type="number" name="idade" id="idade" value="<?= $user['idade'] ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>

                <label for="cidade">Cidade:</label>
                <input type="text" name="cidade" id="cidade" value="<?= htmlspecialchars($user['cidade']) ?>">

                <label for="estado">Estado:</label>
                <select name="estado" id="estado" required>
                    <?php
                    $estados = ["AC","AL","AP","AM","BA","CE","DF","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO"];
                    foreach ($estados as $uf) {
                        $selected = ($uf === $user['estado']) ? "selected" : "";
                        echo "<option value='$uf' $selected>$uf</option>";
                    }
                    ?>
                </select>

                <button type="submit">Atualizar</button>
            </form>
        </div>
    </main>
</body>
</html>

<?php $conn->close(); ?>