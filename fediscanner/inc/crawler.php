<?php

include("data.php");





// Array mit RSS-Feed-URLs
/*
$rss_urls = [
    'https://mastodon.social/tags/silentsunday.rss',
    'https://mastodon.social/tags/wordpress.rss',
    'https://mastodon.digitalsuccess.dev/tags/wordpress.rss'
];
*/

$sql = "SELECT urls FROM urls";

// Ergebnis der SQL-Abfrage abrufen
$result = $mysqli->query($sql);

// Array für die URLs erstellen
$rss_urls = array();

// Durch jedes Ergebnis iterieren und die URLs dem Array hinzufügen
while ($row = $result->fetch_assoc()) {
    $rss_urls[] = $row['urls'];
}







// Durch jeden RSS-Feed iterieren
foreach ($rss_urls as $rss_url) {
    // RSS-Feed lesen und XML-Objekt erstellen
    $rss = simplexml_load_file($rss_url);

    echo "<br /><b>$rss_url</b><br />";
    //hashtag rauslesen
    $tag1 = explode('/tags/', $rss_url);
    $title = substr($tag1[1], 0, -4);


    // Durch jeden Artikel im RSS-Feed iterieren
    foreach ($rss->channel->item as $item) {
        // Daten des Artikels aus dem XML-Objekt extrahieren
        //$title = $mysqli->real_escape_string($item->title);
        $link = $mysqli->real_escape_string($item->link);
        //$published = date('Y-m-d H:i:s', strtotime($item->pubDate));
        $published0 = $mysqli->real_escape_string($item->pubDate);
        $summary = $mysqli->real_escape_string($item->description);

        // gibts ne media url
        $media_url = (string) $item->children('media', true)->content->attributes()->url;
        

        // zeit säubern
        $published =  strtotime($published0);

        // SQL-Abfrage zum Überprüfen, ob der Link bereits in der Datenbank vorhanden ist
        $sql = "SELECT COUNT(*) as count FROM articles WHERE link = '$link'";

        // Überprüfen, ob der Link bereits in der Datenbank vorhanden ist
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        $count = $row['count'];

        echo "$link<br />";

        if ($count == 0) {
            // SQL-Abfrage zum Einfügen des Artikels in die MySQL-Datenbank
            $sql = "INSERT INTO articles (title, link, published, summary, media, rss_feed_url)
                    VALUES ('$title', '$link', '$published', '$summary', '$media_url',  '$rss_url')";

            // Artikel in die MySQL-Datenbank einfügen
            if ($mysqli->query($sql) === TRUE) {
                echo "Artikel '$title' erfolgreich in die Datenbank eingefügt.\n";
            } else {
                echo "Fehler beim Einfügen des Artikels: " . $mysqli->error . "\n";
            }
        } else {
            echo "Artikel '$title' bereits in der Datenbank vorhanden, wird übersprungen.\n";
        }

        // link aufbereiten
        $url_parts = parse_url($link);
        $domain = $url_parts['scheme'] . "://" . $url_parts['host']; // domain
        // neue instanze in db eintragen $link
        $link_sql ="SELECT COUNT(*) as count FROM instance WHERE name = '$domain'";
        $link_result = $mysqli->query($link_sql);
        $row_result = $link_result->fetch_assoc();
        $count_result = $row_result['count'];

        if ($count_result == 0) {
            $linksql = "INSERT INTO instance (name)
                    VALUES ('$domain')";

                if ($mysqli->query($linksql) === TRUE)
                {
                    //eintrag hat geklappt
                }
                else
                {
                    //error
                }

        }
        

    }
}

// MySQL-Verbindung schließen
$mysqli->close();
?>
