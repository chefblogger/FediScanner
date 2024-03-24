<div class="themen">

<?php 

include("inc/data.php");
include("inc/lang.php");

// anzahl erfasste instances
    $sql_inst = "SELECT COUNT(*) AS count_instances FROM instance";
    $result_inst = $mysqli->query($sql_inst);
    $row_inst = $result_inst->fetch_assoc();
    $anz_incstances = $row_inst['count_instances'];

// anzahl erfasste hashtags
    $sql_hashtag = "SELECT COUNT(*) AS count_hashtag FROM list_hashtag";
    $result_hashtag = $mysqli->query($sql_hashtag);
    $row_hashtag = $result_hashtag->fetch_assoc();
    $anz_hashtag = $row_hashtag['count_hashtag'];

// anzahl erfasste posts
    $sql_articles = "SELECT COUNT(*) AS count_articles FROM articles";
    $result_articles = $mysqli->query($sql_articles);
    $row_articles = $result_articles->fetch_assoc();
    $anz_articles = $row_articles['count_articles'];


echo "<a href='https://www.fediscanner.info' class='menu'>Home</a> ";
echo "<a href='rec_instances.php' class='menu'>All recorded Instances ($anz_incstances)</a> ";
echo "<a href='rec_hashtag.php' class='menu'>All recorded Hashtags ($anz_hashtag)</a> ";
echo "<br /><br />";

/* monitored hashtag list einbauen*/
include("search_active_hashtag.php");
?>

<?php 
echo "<br />";
echo "<a href='all.php' class='menu'>All Records ($anz_articles)</a> ";
echo "<a href='#' class='klappenButton'>Open monitored list of hashtags</a>";
// SQL-Abfrage zum Abrufen der Artikel aus der Datenbank
$sql = "SELECT * FROM hashtags ORDER by hashtag ASC";

// Artikel aus der MySQL-Datenbank abrufen
$result = $mysqli->query($sql);

/* json monitored hashtag list einbauen */
echo "<div class='list_hashtag' style='display:none;'>";
/*
// Durch jeden Hashtag in der Datenbank iterieren
while ($row = $result->fetch_assoc()) {
    $hashtag = $row['hashtag'];
    
    // SQL-Abfrage zum Abrufen der Anzahl der Artikel für das Hashtag aus der Datenbank
    $sql2 = "SELECT COUNT(*) AS count FROM articles WHERE title LIKE '%$hashtag%'";
    $result2 = $mysqli->query($sql2);
    $row2 = $result2->fetch_assoc();
    $count = $row2['count'];
    
    echo "<a href='show.php?hashtag=$hashtag' class='menu'>$hashtag ($count)</a> "; 
}
echo "</div>";
*/

$json_file = "inc/monitored_hashtags.json";
$json_data = file_get_contents($json_file);

$json_inhalt = json_decode($json_data, true);

if ($json_inhalt != null){

    foreach ($json_inhalt as $hashtag) {
        $hashtag_name = $hashtag['hashtag_name'];
        $hashtag_count = $hashtag['hashtag_count'];
        echo "<a href='show.php?hashtag=$hashtag_name' class='menu'>$hashtag_name ($hashtag_count)</a> ";

    }
}




?>

</div>

<script>
    // Referenz zum Button und zum Div
const klappenButton = document.querySelector('.klappenButton');
const listHashtagDiv = document.querySelector('.list_hashtag');

// Event-Handler für den Klick auf den Button
klappenButton.addEventListener('click', () => {
    // Überprüfen, ob das Div sichtbar ist
    if (listHashtagDiv.style.display === 'none') {
        // Wenn es ausgeblendet ist, dann einblenden
        listHashtagDiv.style.display = 'block';
        // ändert text in schliessen
        klappenButton.textContent = "Close monitored list of hashtags"
    } else {
        // Wenn es sichtbar ist, dann ausblenden
        listHashtagDiv.style.display = 'none';
        klappenButton.textContent = "Open monitored list of hashtags"
    }
});

</script>