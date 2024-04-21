<?php
session_start();

include '../db/db_connection.php';

// Definisco i dati per effettuare la connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_myblog";

// Definisco la connessione inserendo i dati
$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo che la connessione sia avvenuta
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

// Definisco le variabili passate tramite la form
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Creo la query che verrà inserita al caricamento della pagina
    $sql =
        "SELECT * FROM `users` WHERE `username` = '$username'";

    // Applico i valori a result
    $result = $conn->query($sql);

    // Definisco la variabile in sessione per gli errori
    $_SESSION['error'] = "";

    // Effettuo un controllo sul risultato della chiamata sql
    if ($result->num_rows > 0) {
        // Recupero il risultato della chiamata 
        $row = $result->fetch_assoc();
        $password_hashed = $row['password'];

        // Effettuo un controllo sulla password hashata 
        if (password_verify($password, $password_hashed)) {

            // Applico alla sessione i dati utili dell'utente
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];
            header("Location: ../index.php");
        } else {

            $_SESSION['error'] = "Username or Password not correct.";
        }
    } else {

        $_SESSION['error'] = "Username or Password not correct.";
    }
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
    <?php include '../partials/header.php' ?>

    <main>
        <div class="container my-5">
            <div class="row justify-content-center ">
                <div class="col-12">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <h1>Login</h1>
                        <input class="mt-2" type="text" id="username" max="24" required placeholder="Username" name="username">
                        <input class="mt-2" type="password" id="password" max="16" required placeholder="Password" name="password">
                        <div class="text-danger">
                            <?php echo isset($_SESSION['error']) ? $_SESSION['error'] : "" ?>
                        </div>
                        <button class="mt-2" type="submit" name="login">Accedi</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>