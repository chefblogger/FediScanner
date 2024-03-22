<!DOCTYPE html>
<html lang="en">
<head>
<?php 
include("google.php"); 
//$thema = $_REQUEST['hashtag'];

/*
    XSS SÄUBERUNG
*/
// Benutzereingabe validieren und bereinigen
$hashtag_input = $_GET['hashtag'];
$hashtag_validated = preg_replace('/[^a-zA-Z0-9_\-]/', '', $hashtag_input);

// Benutzereingabe für die sichere Ausgabe vorbereiten
$thema = htmlspecialchars($hashtag_validated, ENT_QUOTES, 'UTF-8');

?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $thema ?> Timeline - FediScanner.info</title>

    <?php 
$some_titel = "$thema Timeline - FediScanner.info";
$some_description = "A list of all recorded post that have used this hashtag $thema in Fediverse";
$some_img = "https://www.fediscanner.info/images/fediscanner.jpg";
$some_url = "https://www.fediscanner.info/show.php?hashtag=$thema";

echo "<meta name='robots' content='index, follow'>";

echo "<meta name='description' content='$some_description' />";

echo "<meta property='og:type' content='website'>";

echo "<meta property='og:title' content='$some_titel'>";

echo "<meta property='og:description' content='$some_description'>";

echo "<meta property='og:image' content='$some_img' />";

echo "<meta property='og:image:alt' content='$some_img'>";

echo "<meta property='og:url' content='$some_url' />";

echo "<meta name='twitter:card' content='summary_large_image'>";

echo "<meta name='twitter:title' content='$some_titel'>";

echo "<meta name='twitter:description' content='$some_description'>";

echo "<meta name='twitter:image' content='$some_img' />";
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="style.css">
</head>
<body>

<?php 

echo "<h2>$thema</h2>";

include("menu_show.php");
echo "<a href='index.php' class='menu'>Back</a> ";
?>

   
    
<?php 



    include("inc/data.php");


// Definiere die Anzahl der Ergebnisse pro Seite
$results_per_page = 12;

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
// Gib die Paginierung aus
echo "<div class='paginator'>";
$start_page = max($current_page - 5, 1);
$end_page = min($current_page + 5, $total_pages);

if ($start_page > 1) {
  echo "<a href='show.php?hashtag=$thema&page=1' class='seiten'>1</a> ";
  if ($start_page > 2) {
    echo "<span class='dots'>...</span>";
  }
}

for ($page = $start_page; $page <= $end_page; $page++) {
  $active_class = ($page == $current_page) ? 'active' : '';
  echo "<a href='show.php?hashtag=$thema&page=$page' class='seiten $active_class'>$page</a> ";
}

if ($end_page < $total_pages) {
  if ($end_page < $total_pages - 1) {
    echo "<span class='dots'>...</span>";
  }
  echo "<a href='show.php?hashtag=$thema&page=$total_pages' class='seiten'>$total_pages</a> ";
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
          echo "<img src='$media' width='200' loading='lazy'><br />";
        } else if (in_array($extension, $supported_video_formats)) {
          // Es handelt sich um ein Video
          echo "<video width='200' controls><source src='$media' ></video><br />";
        } else {
    // Unbekanntes Format
        }



    }
    
    echo "<br />";
    //echo "<a href='$link' target='_blank'>Link $artikel_id</a>"; //mit link id
    echo "<a href='$link' target='_blank' class='button'>$lang_link</a>"; //ohne link id
    echo "<br /><br />";

    //copy inhalt zusammenstellen
    $copy_name = "@$username@$domain_leer ";
    $copy_link = $link;
    $copy = $copy_name . $copy_link;
    
    ?>
    <button onclick="copyToClipboard('<?php echo $copy ?>')" class="button_copy"><?php echo $lang_copy ?></button>
    <?php 
    echo "<br />";

    echo "</div>";
}

// Gib die Paginierung aus

echo "<div class='paginator'>";
$start_page = max($current_page - 5, 1);
$end_page = min($current_page + 5, $total_pages);

if ($start_page > 1) {
  echo "<a href='show.php?hashtag=$thema&page=1' class='seiten'>1</a> ";
  if ($start_page > 2) {
    echo "<span class='dots'>...</span>";
  }
}

for ($page = $start_page; $page <= $end_page; $page++) {
  $active_class = ($page == $current_page) ? 'active' : '';
  echo "<a href='show.php?hashtag=$thema&page=$page' class='seiten $active_class'>$page</a> ";
}

if ($end_page < $total_pages) {
  if ($end_page < $total_pages - 1) {
    echo "<span class='dots'>...</span>";
  }
  echo "<a href='show.php?hashtag=$thema&page=$total_pages' class='seiten'>$total_pages</a> ";
}

echo "</div>";



// MySQL-Verbindung schließen
$mysqli->close();
?>

    </div>

  
<a id="back-to-top" href="#">UP</a>
<?php include("javascript.php"); ?>

<?php 
include("footer.php");
?>
</body>
</html>
