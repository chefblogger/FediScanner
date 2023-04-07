<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>URL hinzufügen</title>
    <link rel="stylesheet" href="style.css">
    <meta name='robots' content='noindex, nofollow'>
</head>
<body>
    <?php include("menu.php"); ?>
    <div class="container">
    <h1>URL hinzufügen</h1>
    <?php
    // MySQL-Verbindung aufbauen
    include("../inc/data.php");

    // Formular wurde abgeschickt
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Eingegebene URL auslesen
        $url = $_POST['url'];
        $new_url = $url . '.rss';

        // Überprüfen, ob die URL bereits in der Datenbank vorhanden ist
        $sql = "SELECT COUNT(*) AS count FROM urls WHERE urls = '$new_url'";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count > 0) {
            echo "Die URL ist bereits vorhanden.";
        } else {

            //hashtag rauslesen
            $tag1 = explode('/tags/', $url);
            $hashtag0 = $tag1[1];
            $hashtag = strtolower($hashtag0);

            // URL in die Datenbank einfügen
            $sql = "INSERT INTO urls (urls) VALUES ('$new_url')";
            if ($mysqli->query($sql)) {
                echo "Die URL wurde erfolgreich hinzugefügt.";
            } else {
                echo "Fehler beim Hinzufügen der URL: " . $mysqli->error;
            }


            //hashtag in datenbank einfügen
            $sql_check = "SELECT COUNT(*) AS count FROM hashtags WHERE hashtag='$hashtag'";

            // Ergebnis der Abfrage abrufen
            $result_check = $mysqli->query($sql_check);

            // Anzahl der gefundenen Hashtags auslesen
            $checker = $result_check->fetch_assoc()['count'];

            if ($checker == 0)
            {
                $sql2 = "INSERT INTO hashtags (hashtag) VALUES ('$hashtag')";
                    if ($mysqli->query($sql2) === TRUE) {
                //geklappt
                    }
                    else {
                //nicht geklappt
                    }
            }
            else 
            {
                //bereits in db
            }
            

        }
    }
    ?>
    <form method="post">
        <label for="url">URL:</label>
        <input type="text" name="url" id="url" required>
        <br>
        <button type="submit" class="submitbutton">Hinzufügen</button>
    </form>
    <?php
    // MySQL-Verbindung schließen
    $mysqli->close();
    ?>
    </div>
</body>
</html>
