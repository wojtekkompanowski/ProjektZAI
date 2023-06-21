<?php
// Połączenie z bazą danych
$host = 'localhost';
$db = 'projekty';
$user = 'root';
$password = '';
$charset = 'utf8mb4';

$connection = mysqli_connect($host, $user, $password, $db);

if (!$connection) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Pobranie ID uczestnika do usunięcia
$participantID = $_POST['participantID'];

// Usunięcie uczestnika z bazy danych
$deleteQuery = "DELETE FROM uczestnicy WHERE id = $participantID";
$deleteResult = mysqli_query($connection, $deleteQuery);

if ($deleteResult) {
    echo "Uczestnik został usunięty z bazy danych.";
} else {
    echo "Błąd podczas usuwania uczestnika z bazy danych: " . mysqli_error($connection);
}

// Zamknięcie połączenia z bazą danych
mysqli_close($connection);
?>
