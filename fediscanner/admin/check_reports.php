<!DOCTYPE html>
<html lang="en">
<head>
<?php 

//$thema = $_REQUEST['hashtag'];
// Benutzereingabe validieren und bereinigen
$hashtag_input = $_GET['hashtag'];
$hashtag_validated = preg_replace('/[^a-zA-Z0-9_\-]/', '', $hashtag_input);

// Benutzereingabe für die sichere Ausgabe vorbereiten
$thema = htmlspecialchars($hashtag_validated, ENT_QUOTES, 'UTF-8');

//filename der current seite
$currentPage = basename($_SERVER['PHP_SELF']);
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Reports</title>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<link rel="stylesheet" href="../style.css">
<style>
    .adminmenu_1 {
    padding: 10px;
}

.adminmenu_1 a {
    color: #fff;
    text-decoration: none;
    border: 1px #000 solid;
    background-color: #000;
    margin: 5px;
}

.adminmenu_1 a:hover {
    background-color: var(--farbe1);
    color: var(--hell);
}

.adminmenu_2 a {
    color: #fff;
    text-decoration: none;
    border: 1px #000 solid;
    background-color: #000;
    margin: 5px;
}

.adminmenu_2 a:hover {
    background-color: var(--farbe1);
    color: var(--hell);
}

.adminmenu_2 {
    padding: 10px;
}

.adminmenu_3 a {
    color: #fff;
    text-decoration: none;
    border: 1px #000 solid;
    background-color: #000;
    margin: 5px;
}

.adminmenu_3 a:hover {
    background-color: var(--farbe1);
    color: var(--hell);
}

.adminmenu_3 {
    padding: 10px;
}

.adminmenu_4 a {
    color: #fff;
    text-decoration: none;
    border: 1px #000 solid;
    background-color: #000;
    margin: 5px;
}

.adminmenu_4 a:hover {
    background-color: var(--farbe1);
    color: var(--hell);
}

.adminmenu_4 {
    padding: 10px;
}

.report {
    padding: 20px;
}

</style>
</head>
<body>

<?php 

include("menu.php");
?>

   
    
<?php 



    include("../inc/data.php");




// Holen Sie die Daten aus der Datenbank mit LIMIT und OFFSET
$sql = "SELECT * FROM articles WHERE status = '1' ORDER by published DESC";
$result = $mysqli->query($sql);

// Gib die Daten in deiner HTML-Seite aus



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
    
    //if (strpos($deine_variable, "NSFW") !== false || strpos($deine_variable, "Porno") !== false) {
if (strpos($summary, 'NSFW') !== false) {
        //ja nsfw enthalten
        
        echo "<div class='porn'>This post may contain porn material!!</div>";
        
}
    else
{
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
}


    
    echo "<br />";
    //echo "<a href='$link' target='_blank'>Link $artikel_id</a>"; //mit link id
    echo "<a href='$link' target='_blank' class='button'>Zum Post gehen</a>"; //ohne link id
    echo "<br /><br />";

    //copy inhalt zusammenstellen
    $copy_name = "@$username@$domain_leer ";
    $copy_link = $link;
    $copy = $copy_name . $copy_link;
    
    ?>
    <div class="report"><a href="check_reports_done.php?id=<?php echo $artikel_id ?>&check=0">freigeben</a><br /><br /><a href="check_reports_done.php?id=<?php echo $artikel_id ?>&check=3">sperren</a></div>
    <?php 
    echo "</div>";
}
echo "</div>";

// MySQL-Verbindung schließen
$mysqli->close();
?>

    </div>
<a id="back-to-top" href="#">UP</a>
<?php include("../javascript.php"); ?>
</body>
</html>