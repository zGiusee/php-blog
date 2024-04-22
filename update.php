<?php
session_start();

require_once __DIR__ . '/db/db_connection.php';

$sql =
    "SELECT * FROM `categories`";

$categories = $conn->query($sql);

// Controllo che la connessione sia avvenuta
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['update_post_id'])) {

    $post_id = $_GET['update_post_id'];

    $post_sql = "SELECT * FROM `posts` WHERE `id` = ?";

    $stmt = $conn->prepare($post_sql);

    $stmt->bind_param("i", $post_id);

    $stmt->execute();

    $post_result = $stmt->get_result();

    // Effettuo un controllo sul risultato della chiamata sql
    if ($post_result->num_rows > 0) {
        // Recupero il risultato della chiamata 
        $post = $post_result->fetch_assoc();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recuper i dati dalla form
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $category = $_POST['category_id'];

    $stmt = $conn->prepare("UPDATE posts SET title=?, content=?, image=?, category_id=? WHERE id=?");

    $stmt->bind_param("sssii", $title, $content, $image, $category, $post_id);

    if ($stmt->execute()) {
        header('Location: ./posts.php');
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
    }

    $conn->close();
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
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" value="<?php echo $post['id'] ?>" id="post_id" name="post_id">
                        <div class="form-group mt-2">
                            <label class="fw-bold" for="title">Titolo * :</label>
                            <input type="text" class="form-control" required value="<?php echo $post['title'] ?>" id="title" name="title">
                        </div>
                        <div class="form-group mt-2">
                            <label class="fw-bold" for="content">Contenuto * :</label>
                            <input type="text" class="form-control" required value="<?php echo $post['content'] ?>" id="content" name="content">
                        </div>
                        <div class="form-group mt-2">
                            <label class="fw-bold" for="image">Immagine * :</label>
                            <input type="text" class="form-control" value="<?php echo $post['image'] ?>" id="image" name="image">
                        </div>
                        <div class="form-grup mt-2">
                            <label class="fw-bold" for="category_id">Categoria * :</label>
                            <select class="form-select mt-2" name="category_id" id="category_id">
                                <?php foreach ($categories as $category) { ?>
                                    <option <?php echo $post['category_id'] == $category['id'] ? 'selected' : '' ?> value="<?php echo $category['id'] ?>"> <?php echo $category['name'] ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Invia</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>