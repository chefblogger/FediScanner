<!DOCTYPE html>
<html lang="en">
<head>
<?php 
include("google.php"); 
$thema = $_REQUEST['hashtag'];
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $thema ?> Timeline - FediScanner</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="style.css">
</head>
<body>

<?php 

echo "<h2>$thema</h2>";

include("themen.php");
?>

   
    
<?php 



    include("inc/data.php");

/*
// SQL-Abfrage zum Abrufen der Artikel aus der Datenbank
$sql = "SELECT * FROM articles WHERE title = '$thema'";

// Artikel aus der MySQL-Datenbank abrufen
$result = $mysqli->query($sql);

// Durch jeden Artikel in der Datenbank iterieren
while ($row = $result->fetch_assoc()) {
    $artikel_id = $row['id'];
    $link = $row['link'];
    $summary = $row['summary'];
    $published = $row['published'];
    $media = $row['media'];

    // Veröffentlichungsdatum in einen Unix-Timestamp umwandeln
    $uhrzeit = date("d.m.Y H:i", $published);

    // Link, Zusammenfassung und Veröffentlichungsdatum ausgeben
    echo "<div class='grid-item'>";
    echo "$uhrzeit<br />";
    //echo "Link: $link<br>";
    echo "Zusammenfassung: $summary<br><br>";

    if (isset($media))
    {
        echo "<img src='$media' width='200'><br />";
    }
    echo "<a href='$link' target='_blank'>Link $artikel_id</a>";
    echo "</div>";
}

// MySQL-Verbindung schließen
$mysqli->close();

*/

// Definiere die Anzahl der Ergebnisse pro Seite
$results_per_page = 20;

// Hole die Anzahl der Datensätze
$sql = "SELECT COUNT(*) AS total FROM articles WHERE title = '$thema'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$total_results = $row['total'];

// Berechne die Anzahl der Seiten
$total_pages = ceil($total_results / $results_per_page);

// Überprüfe, ob eine Seitenzahl übergeben wurde
if (!isset($_GET['page'])) {
  $current_page = 1;
} else {
  $current_page = $_GET['page'];
}

// Berechne den Offset
$offset = ($current_page - 1) * $results_per_page;

// Holen Sie die Daten aus der Datenbank mit LIMIT und OFFSET
$sql = "SELECT * FROM articles WHERE title = '$thema'  ORDER by published DESC LIMIT $results_per_page OFFSET $offset";
$result = $mysqli->query($sql);

// Gib die Daten in deiner HTML-Seite aus

// Gib die Paginierung aus
echo "<div class='paginator'>";
for ($page = 1; $page <= $total_pages; $page++) {
  echo "<a href='show.php?hashtag=$thema&page=$page' class='seiten'>$page</a> ";
}
echo "</div>";


echo "<div class='grid-container'>";
// Durch jeden Artikel in der Datenbank iterieren
while ($row = $result->fetch_assoc()) {
    $artikel_id = $row['id'];
    $link = $row['link'];
    $summary = $row['summary'];
    $published = $row['published'];
    $media = $row['media'];

    // Veröffentlichungsdatum in einen Unix-Timestamp umwandeln
    $uhrzeit = date("d.m.Y H:i", $published);

    //urheber auslesen
    $url_parts = parse_url($link);
    $domain = $url_parts['scheme'] . "://" . $url_parts['host']; // domain
    
    $domain_leer = str_replace('https://', '', $domain);

    $username = str_replace('@', '', explode('/', $url_parts['path'])[1]); // username

    //https://muenster.im/@tro
    // Link, Zusammenfassung und Veröffentlichungsdatum ausgeben
    echo "<div class='grid-item'>";
    echo "$uhrzeit<br />";
    echo "$username (<a href='$domain/@$username' target='_blank' class='nickname'>@$username@$domain_leer</a>)<br/>";
    //echo "Link: $link<br>";
    //echo "$domain<br /><br />";
    echo "$summary<br><br>";

    if (isset($media))
    {
        //echo "<img src='$media' width='200'><br />";

        // checken ob media is bild oder video
        $path = parse_url($media, PHP_URL_PATH);
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        $supported_image_formats = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $supported_video_formats = array('mp4', 'webm', 'ogg');

        if (in_array($extension, $supported_image_formats)) {
          // Es handelt sich um ein Bild
          echo "<img src='$media' width='200'><br />";
        } else if (in_array($extension, $supported_video_formats)) {
          // Es handelt sich um ein Video
          echo "<video width='200' controls><source src='$media' ></video><br />";
        } else {
    // Unbekanntes Format
        }



    }
    
    echo "<br />";
    //echo "<a href='$link' target='_blank'>Link $artikel_id</a>"; //mit link id
    echo "<a href='$link' target='_blank' class='button'>Link</a>"; //ohne link id
    echo "</div>";
}

// Gib die Paginierung aus
/*
for ($page = 1; $page <= $total_pages; $page++) {
  //echo "<a href='show.php?hashtag=$thema&page=$page'>$page</a> ";
}
*/

// MySQL-Verbindung schließen
$mysqli->close();
?>

    </div>
<a id="back-to-top" href="#">Nach oben</a>
<script>
  // Zurück-nach-oben-Button einblenden, wenn nach unten gescrollt wird
$(window).scroll(function() {
  if ($(this).scrollTop() > 100) {
    $('#back-to-top').fadeIn();
  } else {
    $('#back-to-top').fadeOut();
  }
});

// Bei Klick auf den Zurück-nach-oben-Button zur obersten Seite scrollen
$('#back-to-top').click(function() {
  $('html, body').animate({scrollTop : 0},800);
  return false;
});

</script>
</body>
</html>