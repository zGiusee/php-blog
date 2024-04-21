<?php
// Definisco i dati per effettuare la connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_myblog";

// Definisco la connessione inserendo i dati
$conn = new mysqli($servername, $username, $password, $dbname);
