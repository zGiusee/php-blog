<?php
session_start();

require_once __DIR__ . '/db/db_connection.php';
var_dump($_GET['post_id']);

if (isset($_GET['post_id'])) {

    $post_id = $_GET['post_id'];

    $sql =
        "DELETE FROM `posts` WHERE `id` = ?";


    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $post_id);

    if ($stmt->execute() === TRUE) {
        header('Location: ./index.php');
    } else {
        die('Error in execution' . $conn->error);
    }

    $conn->close();
}
