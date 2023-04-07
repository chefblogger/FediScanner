<?php

include("data.php");

/*
$sql = "SELECT name FROM instance ORDER BY id LIMIT 10";

// Ergebnis der SQL-Abfrage abrufen
$result = $mysqli->query($sql);

if ($result->num_rows > 0)
{
    while($row = $result->fetch_assoc()){
        $name = $row['name'];
        
        //json file generieren https://wpbuilds.social/api/v1/instance
        $json_url = $name . '/api/v1/instance';
        
        //json datei laden
        $json = file_get_contents($json_url);
        $data = json_decode($json, true);
        $user_count = $data['stats']['user_count'];
        
        
        
        
        
        echo "$name - $user_count </br>";


    }
}
*/


// Anzahl der Datensätze, die gleichzeitig abgerufen werden sollen
$batch_size = 3;

// SQL-Abfrage, um Datensätze in Batches abzurufen
$sql = "SELECT name FROM instance ORDER BY id LIMIT $batch_size OFFSET %d";

// Gesamtzahl der Datensätze in der Tabelle "instance" abrufen
$total_rows = $mysqli->query("SELECT COUNT(*) FROM instance")->fetch_row()[0];

// Schleife durchlaufen, um alle Datensätze in Batches abzurufen
for ($offset = 0; $offset < $total_rows || $offset == 0; $offset += $batch_size) {
    // SQL-Abfrage mit dem aktuellen Offset ausführen
    $query = sprintf($sql, $offset);
    $result = $mysqli->query($query);

    // Ergebnis der SQL-Abfrage verarbeiten
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];

            // JSON-URL generieren
            $json_url = $name . '/api/v1/instance';

            //timeout nach 10 sek
            $context = stream_context_create([
                'http' => [
                    'timeout' => 10
                ]
                ]);
            

            // JSON-Datei laden
            $json = file_get_contents($json_url, false, $context);

            if ($json === false)
                {
                    $user_count = 0;
                    $status_count = 0;
                } else 
                {
                    $data = json_decode($json, true);
                    $user_count = $data['stats']['user_count'];
                    $status_count = $data['stats']['status_count']; 
                }


            if (is_numeric($user_count) && is_numeric($status_count)) {


                    $update_sql = "UPDATE instance SET user_count = '$user_count', status_count = '$status_count' WHERE name = '$name'";
                        if ($mysqli->query($update_sql) === TRUE) {
                    //echo "User-Count für $name erfolgreich aktualisiert.";
                        } else {
                    //echo "Fehler beim Aktualisieren des User-Counts für $name: " . $mysqli->error;
                        }
                }
                else
                {
                    // Wenn der User-Count keine Zahl ist, wird 0 in die Datenbank eingefügt
                    $update_sql = "UPDATE instance SET user_count = '0', status_count = '$status_count' WHERE name = '$name'";
                        if ($mysqli->query($update_sql) === TRUE) {
                            //echo "User-Count für $name erfolgreich auf 0 gesetzt.";
                        } else {
                            //echo "Fehler beim Setzen des User-Counts für $name auf 0: " . $mysqli->error;
                        }

                }

            echo "$name - $user_count </br>";
        }
    }
}





// MySQL-Verbindung schließen
$mysqli->close();

?>