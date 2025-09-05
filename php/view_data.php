<?php
include "connection.php";

$search = "";
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
}

$sql = "SELECT * FROM users";
if ($search !== "") {
    $sql .= " WHERE nome LIKE '%$search%'
              OR email LIKE '%$search%'
              OR CAST(idade AS CHAR) LIKE '%$search%'
              OR cidade LIKE '%$search%'
              OR estado LIKE '%$search%'";
}

$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($users);

$conn->close();
?>