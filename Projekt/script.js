// Funkcja ładowania uczestników dla wybranego projektu
function loadParticipants(projectID, nazwa) {
  // Wykonanie żądania AJAX
  $('#participants h2').text("Lista uczestników: " + nazwa);

  // Funkcja usuwania uczestnika
  function deleteParticipant(participantID) {
    // Wykonanie żądania AJAX
    $.ajax({
      url: 'usun_ucznia.php', // Adres URL do pliku PHP usuwającego uczestnika
      method: 'POST',
      data: { participantID: participantID }, // Przesłanie participantID jako danych żądania
      success: function(response) {
        // Obsługa odpowiedzi z serwera
        console.log(response);
        // Wywołanie ponownego ładowania uczestników
        loadParticipants(projectID, nazwa);
      },
      error: function() {
        // Obsługa błędu żądania AJAX
        alert('Wystąpił błąd podczas komunikacji z serwerem.');
      }
    });
  }

  $.ajax({
    url: 'pobierz_uczestnikow.php', // Adres URL do skryptu PHP pobierającego uczestników
    method: 'POST',
    data: { projectID: projectID }, // Przesłanie projectID jako danych żądania
    success: function(response) {
      // Obsługa odpowiedzi z serwera
      var participants = JSON.parse(response);

      // Wyczyszczenie listy uczestników
      $('#participantsList').empty();

      // Generowanie wierszy z uczestnikami
      participants.forEach(function(participant, index) {
        // Tworzenie wiersza i dodawanie do tabeli
        var row = $('<tr>');
        row.append($('<td>').text(participant.imie));
        row.append($('<td>').text(participant.nazwisko));
        row.append($('<td>').text(participant.email));

        // Dodanie przycisku usuwania uczestnika
        var deleteButton = $('<button>').text('Usuń');
        deleteButton.click(function() {
          deleteParticipant(participant.id);
        });
        row.append($('<td>').append(deleteButton));

        // Dodanie wiersza do tabeli
        $('#participantsList').append(row);
      });
    },
    error: function() {
      // Obsługa błędu żądania AJAX
      alert('Wystąpił błąd podczas komunikacji z serwerem.');
    }
  });
}




