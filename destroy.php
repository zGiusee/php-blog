<?php
session_start();

require_once __DIR__ . '/db/db_connection.php';

if (isset($_GET['post_id'])) {
    // Recupero l'id dalla form (input invisibile)
    $post_id = $_GET['post_id'];
    $user_id = $_SESSION['user_id'];

    $sql =
        "DELETE FROM `posts` WHERE `id` = ? AND `user_id` =  ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ii", $post_id, $user_id);

    // Se la query va a buon fine, esegue un redirect
    if ($stmt->execute() === TRUE) {
        header('Location: ./index.php');
    } else {
        die('Error in execution' . $conn->error);
    }

    $conn->close();
}
