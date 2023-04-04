<h2>Scan for hashtags in recorded tröts</h2>
<?php 

include("../inc/data.php");

$sql = "SELECT * FROM articles DESC LIMIT 250 ORDER by id DESC ";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    $summary = $row['summary'];
    $content = strip_tags($summary);
    //echo "$content<br /><br /><br />";

    $hashtags = array();
    preg_match_all('/#(\w+)/', $content, $matches);

    foreach ($matches[1] as $match) {
        array_push($hashtags, $match);
    }

    foreach ($hashtags as $einzene_hashtag) {
        //echo "#: $einzene_hashtag<br />";

        
        // SQL-Abfrage zum Überprüfen, ob der Link bereits in der Datenbank vorhanden ist
        $query_sql = "SELECT COUNT(*) as count FROM list_hashtag WHERE hashtag = '$einzene_hashtag'";

        // Überprüfen, ob der Link bereits in der Datenbank vorhanden ist
        $result2 = $mysqli->query($query_sql);
        $row2 = $result2->fetch_assoc();
        $count = $row2['count'];

        echo "$link<br />";

        if ($count == 0) {
            // SQL-Abfrage zum Einfügen des Artikels in die MySQL-Datenbank
            $query_sql = "INSERT INTO list_hashtag (hashtag)
                    VALUES ('$einzene_hashtag')";

            // Artikel in die MySQL-Datenbank einfügen
            if ($mysqli->query($query_sql) === TRUE) {
                echo "Hashtag '$einzene_hashtag' erfolgreich in die Datenbank eingefügt.\n";
            } else {
                echo "Fehler beim Einfügen des Artikels: " . $mysqli->error . "\n";
            }
        } else {
            //echo "# '$einzene_hashtag' bereits in der Datenbank vorhanden, wird übersprungen.\n";
        }
        



    }
    


}

?>