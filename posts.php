<?php
session_start();

require_once __DIR__ . '/db/db_connection.php';


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Creo la query che verrà inserita al caricamento della pagina
    $sql =
        "SELECT 
        `posts`.`id`, 
        `posts`.`title`, 
        `posts`.`content`,
        `posts`.`image`,
        `posts`.`user_id`,
        `categories`.`id` AS `category_id`,
        `categories`.`name` AS `category_name`, 
        `users`.`username` AS `user_name`
        FROM `posts`
        JOIN `categories` ON `categories`.`id` = `posts`.`category_id`
        JOIN `users` ON `users`.`id`= `posts`.`user_id`
        WHERE `posts`.`user_id` = '$user_id'";

    // Applico i valori a result
    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>php-myblog</title>
</head>

<body>
    <!-- HEADER -->
    <?php include './partials/header.php' ?>

    <main>
        <div class="container my-5">
            <div class="row">
                <?php foreach ($result as $post) { ?>
                    <div class="col-6 my-3">
                        <div class="my-card">
                            <div class="p-4 text-end">
                                <form class="d-inline-block" action="./update.php" method="get">
                                    <input type="hidden" value="<?php echo $post['id'] ?>" id="update_post_id" name="update_post_id">
                                    <button type="submit" class="my-a-btn">Modifica</button>
                                </form>
                                <button class="my-a-btn" type="button" data-bs-toggle="modal" data-bs-target="#delete_modal" data-postid="<?php echo $post['id'] ?>" data-title="<?php echo $post['title'] ?>" class="btn btn-danger delete-button">
                                    Elimina
                                </button>
                            </div>
                            <img src="<?php echo $post['image']  ? $post['image'] : 'https://www.romeduckstore.it/wp-content/uploads/2020/05/paperella-di-gomma-gialla-classica.png'; ?>" class="card-img-top" alt="...">
                            <div class="my-card-body">
                                <h4 class="my-card-title mb-2"><?php echo $post['title'] ?></h4>
                                <span class="my-card-text bg-danger text-white p-1 px-2 rounded-3"><?php echo $post['category_name'] ?></span>
                                <p class="my-card-text mt-2"><?php echo $post['content'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <?php include './delete_modal.php' ?>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" src="./main.js"></script>

</html>