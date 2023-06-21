<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Formularz rejestracji</title>
    <link rel="stylesheet" href="styles.css">
    <script src="ckeditor5-build-classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>

</head>
<body>
    <header>
        <h1>Formularz rejestracji</h1>
    </header>


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

        // Pobranie projektów z bazy danych
        $query = "SELECT * FROM projekty";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $projects = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $projects[] = $row;
            }
        } else {
            $projects = array();
        }

        // Zamknięcie połączenia z bazą danych
        mysqli_close($connection);
        ?>

    <nav>
        <ul id="projectList">
        <li><a href="#" onclick="loadParticipants('all', 'Wszyscy')" class="projectLink" data-project="Wszyscy">Wszyscy</a></li>
        <?php foreach ($projects as $project): ?>
                <li><a href="#" onclick="loadParticipants(<?php echo $project['id']; ?>, '<?php echo $project['nazwa']; ?>')" class="projectLink" data-project="<?php echo $project['nazwa']; ?>"><?php echo $project['nazwa']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <section id="registration">
    <h2>Rejestracja ucznia</h2>
    <form id="registrationForm" method="post" enctype="multipart/form-data" action="dodaj_ucznia.php">
        <label for="imie">Imię:</label>
        <input type="text" id="imie" name="imie" required>

        <label for="nazwisko">Nazwisko:</label>
        <input type="text" id="nazwisko" name="nazwisko" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="projekt">Projekt:</label>
        <select id="projekt" name="projekt" required>
            <?php foreach ($projects as $project): ?>
                <option value="<?php echo $project['nazwa']; ?>"><?php echo $project['nazwa']; ?></option>
            <?php endforeach; ?>
        </select>

        <!-- <label for="plik">Plik PDF:</label> -->
        <!-- <input type="file" id="plik" name="plik" accept="application/pdf" required> -->

        <button type="submit">Zarejestruj</button>
    </form>
    
</section>


        <section id="participants">
        <h2>Lista uczestników</h2>
        <table id="participantsTable">
            <thead>
                <tr>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Email</th>
                    <!-- <th>Projekt</th> -->
                    <!-- <th>Nazwa pliku</th> -->
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody id="participantsList">
                <!-- Tutaj możesz wstawić dynamicznie generowaną listę uczestników z bazy danych -->
            </tbody>
        </table>
    </section>

    <footer>
        &copy; 2023 Moja Strona
    </footer>

    <script>

        $(document).ready(function () {
            loadParticipants('all', 'Wszyscy')
        });
        


    </script>
                
</body>
</html>