<?php
// Połączenie z bazą danych
$host = 'localhost'; // Adres serwera
$db = 'projekty'; // Nazwa bazy danych
$user = 'root'; // Użytkownik bazy danych
$password = ''; // Hasło użytkownika bazy danych
$charset = 'utf8mb4'; // Kodowanie znaków serwera

$connection = mysqli_connect($host, $user, $password, $db);

if (!$connection) {
    // Obsługa błędu połączenia z bazą danych
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Pobranie danych z formularza
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$email = $_POST['email'];
$projekt = $_POST['projekt'];
// $plik = $_FILES['plik'];

// Przetwarzanie pliku
// $plik_nazwa = $plik['name'];
// $plik_tmp = $plik['tmp_name'];
// $plik_sciezka = 'prace_uczniow' . $plik_nazwa;

    // Sprawdzenie czy istnieje projekt o podanej nazwie
    $query = "SELECT id FROM projekty WHERE nazwa = '$projekt'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $projekt_id = $row['id'];

        // Dodanie uczestnika do bazy danych
        $insertQuery = "INSERT INTO uczestnicy (projekt_id, imie, nazwisko, email) VALUES ($projekt_id, '$imie', '$nazwisko', '$email')";
        $insertResult = mysqli_query($connection, $insertQuery);

        if ($insertResult) {
            echo "Uczestnik został dodany do bazy danych.";
        } else {
            echo "Błąd dodawania uczestnika do bazy danych: " . mysqli_error($connection);
        }
    } else {
        echo "Nie znaleziono projektu o podanej nazwie.";
    }


// Zamknięcie połączenia z bazą danych
mysqli_close($connection);
?>







