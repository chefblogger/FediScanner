<div class="themen">
<?php 

include("inc/data.php");


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


echo "<a href='https://www.fediscanner.info' class='menu'>Home</a> ";
echo "<a href='rec_instances.php' class='menu'>All recorded Instances ($anz_incstances)</a> ";
echo "<a href='rec_hashtag.php' class='menu'>All recorded Hashtags ($anz_hashtag)</a> ";
echo "<br /><br />";


// SQL-Abfrage zum Abrufen der Artikel aus der Datenbank
$sql = "SELECT * FROM hashtags ORDER by hashtag ASC";

// Artikel aus der MySQL-Datenbank abrufen
$result = $mysqli->query($sql);

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


?>
</div>