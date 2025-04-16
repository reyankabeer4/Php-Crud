<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = (int) $_POST["id"];

    $stmt = $conn->prepare("DELETE FROM STUDENTS WHERE ID = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: read.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}


?>