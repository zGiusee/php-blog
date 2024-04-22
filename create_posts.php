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

if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['image']) && isset($_POST['category'])) {

    // Recupero i dati dalla form
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $category = $_POST['category'];

    // Creo la query
    $create_sql =
        "INSERT INTO posts (title, content, image, user_id, category_id)
        VALUES ('$title', '$content', '$image', '$user_id', '$category')";

    if ($conn->query($create_sql) === TRUE) {
        header('Location: ./posts.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
                    <!-- Post Form -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group mt-2">
                            <label class="fw-bold" for="title">Titolo * :</label>
                            <input type="text" class="form-control" required id="title" name="title">
                        </div>
                        <div class="form-group mt-2">
                            <label class="fw-bold" for="content">Contenuto * :</label>
                            <input type="text" class="form-control" required id="content" name="content">
                        </div>
                        <div class="form-group mt-2">
                            <label class="fw-bold" for="image">Immagine * :</label>
                            <input type="text" class="form-control" required id="image" name="image">
                        </div>
                        <div class="form-grup mt-2">
                            <label class="fw-bold" for="category">Categoria * :</label>
                            <select class="form-select mt-2" name="category" id="category">
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category['id'] ?>"> <?php echo $category['name'] ?> </option>
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