<?php
// Pobranie projekt_id z żądania POST
// $projectID = 1;

// var_dump($POST['projekt_id']);

$projectID = $_POST['projectID'];

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

// Pobranie uczestników dla wybranego projektu

if($projectID == 'all'){
    $query = "SELECT * FROM uczestnicy";
}   else {
    $query = "SELECT * FROM uczestnicy WHERE projekt_id = $projectID";
}

$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $participants = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $participants[] = $row;
    }
} else {
    $participants = array();
}

// Zamknięcie połączenia z bazą danych
mysqli_close($connection);

// Zwrócenie uczestników jako odpowiedź AJAX w formacie JSON
echo json_encode($participants);
?>

