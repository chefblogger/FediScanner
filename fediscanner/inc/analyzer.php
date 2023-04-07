<h2>Scan for hashtags in recorded tröts</h2>
<?php 

include("../inc/data.php");

$sql = "SELECT * FROM articles ORDER BY id DESC Limit 500";
//$sql = "SELECT * FROM articles ORDER BY id";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    $summary = $row['summary'];
    $content = strip_tags($summary);
    $article_link = $row['link'];
    //echo "$content<br /><br /><br />";

    $hashtags = array();
    preg_match_all('/#(\w+)/', $content, $matches);


    //urheber auslesen
    $url_parts = parse_url($article_link);
    $article_domain = $url_parts['scheme'] . "://" . $url_parts['host']; // domain
    

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

        //echo "$link<br />";

        if ($count == 0) {
            // SQL-Abfrage zum Einfügen des Artikels in die MySQL-Datenbank
            $query_sql = "INSERT INTO list_hashtag (hashtag, origin)
                    VALUES ('$einzene_hashtag', '$article_domain')";

            // Artikel in die MySQL-Datenbank einfügen
            if ($mysqli->query($query_sql) === TRUE) {
                echo "Hashtag '$einzene_hashtag' erfolgreich in die Datenbank eingefügt. > $article_domain <br />";
            } else {
                echo "Fehler beim Einfügen des Artikels: " . $mysqli->error . "<br />";
            }
        } else {
            //echo "# '$einzene_hashtag' bereits in der Datenbank vorhanden, wird übersprungen.\n";
        }
        



    }
    


}

?>