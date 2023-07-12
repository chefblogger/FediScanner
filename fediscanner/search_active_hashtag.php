<datalist id="hashtags">
<?php 

// SQL-Abfrage zum Abrufen der Artikel aus der Datenbank
$sql = "SELECT * FROM hashtags ORDER by hashtag ASC";

// Artikel aus der MySQL-Datenbank abrufen
$result = $mysqli->query($sql);

// Durch jeden Hashtag in der Datenbank iterieren
while ($row = $result->fetch_assoc()) {
    $res = $row['hashtag'];
	echo "<option value='$res'></option>";
}


?>
</datalist>
<h4>Search for active hashtags</h4>
<form action="show.php" method="post">
<input list="hashtags" type="search" placeholder="demo" name="hashtag" class="searchfield">
<input type="submit" name="anschauen" value="search" class="searchbutton">
</form>