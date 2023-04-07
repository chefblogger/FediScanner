<?php 
include("../inc/data.php");


    if (($_REQUEST['check']) == 'yes')
    {
        $new_url = $_REQUEST['rss'];
        $lid = $_REQUEST['lid'];

        // Überprüfen, ob die URL bereits in der Datenbank vorhanden ist
        $sql = "SELECT COUNT(*) AS count FROM urls WHERE urls = '$new_url'";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count > 0) {
            echo "Die URL ist bereits vorhanden.";

            //delete alter vorschlag
                $sql_del = "DELETE FROM check_hashtag WHERE id = $lid";

                if ($mysqli->query($sql_del)) {
                    echo "Der Eintrag wurde erfolgreich gelöscht.";
                } else {
                    echo "Fehler beim Löschen des Eintrags: " . $mysqli->error;
                }


        } else {


                echo "yes";
                echo "<br />";
                $rsslink = $_REQUEST['rss'];
                $lid = $_REQUEST['lid'];
                echo $rsslink;

                //hashtag rauslesen
            $tag1 = explode('/tags/', $rsslink);
            $tag2 = $tag1[1];
            $hashtag0 = substr($tag2, 0, -4);
            $hashtag = strtolower($hashtag0);

                //add rss into db
                $sql = "INSERT INTO urls (urls) VALUES ('$rsslink')";
                    if ($mysqli->query($sql)) {
                        echo "Die URL wurde erfolgreich hinzugefügt.";
                    } else {
                        echo "Fehler beim Hinzufügen der URL: " . $mysqli->error;
                    }

                // add hashtg in db
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
                ECHO "HT $hashtag erfolgreich eingetragen in hashtags-tabelle";
                    }
                    else {
                //nicht geklappt
                ECHO "ERROR Hashtag $hashtag";
                    }
            }
            else 
            {
                //bereits in db
            }


                //delete alter vorschlag
                $sql_del = "DELETE FROM check_hashtag WHERE id = $lid";

                if ($mysqli->query($sql_del)) {
                    echo "Der Eintrag wurde erfolgreich gelöscht.";
                } else {
                    echo "Fehler beim Löschen des Eintrags: " . $mysqli->error;
                }

        }

    }
    elseif  (($_REQUEST['check']) == 'no')
    {
        echo "no";
        echo "<br />";
        $lid = $_REQUEST['lid'];

        //delete alter vorschlag
        $sql_del2 = "DELETE FROM check_hashtag WHERE id = $lid";

        if ($mysqli->query($sql_del2)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags: " . $mysqli->error;
        }
    }
    else {
        //error
    }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rss</title>
    <meta name='robots' content='noindex, nofollow'>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv='refresh' content='0;URL=https://www.fediscanner.info/admin/list_futur_rss.php'>
</head>
<body>
    
</body>
</html>