<h2>generate json file for hashtag</h2>
<?php 
include("data.php");

$sql = "SELECT * FROM list_hashtag ORDER by hashtag ASC ";
$result = $mysqli->query($sql);
if (mysqli_num_rows($result) > 0) {

	$data = array();

	// Ergebniszeilen durchlaufen
    while ($row = mysqli_fetch_assoc($result)) {

		$hashtag_name0 = $row['hashtag'];
    	$hashtag_name = strtolower($hashtag_name0);
    	$hashtag_id = $row['id'];
    	$hashtag_origin = $row['origin'];
		$hashtag_hidden = $row['hidden'];

		$check_hashtag = $hashtag_origin . '/tags/' . $hashtag_name . '.rss';

		//checken ob url in der db ist also hashtag bereits erfasst

		$sql_check = "SELECT COUNT(*) AS count FROM urls WHERE urls = '$check_hashtag'";
        $result_check = $mysqli->query($sql_check);
        $row_check = $result_check->fetch_assoc();
        $count = $row_check['count'];
		if ($count > 0) {
		//in der db
		$hashtag = array(
            'hashtag_id' => $row['id'],
            'hashtag_name' => $row['hashtag'],
			'active' => '1'
        );
		}
		else {
			//nicht in der db
			$hashtag = array(
            'hashtag_id' => $row['id'],
            'hashtag_name' => $row['hashtag'],
			'active' => '0'
        );
		}


        // Einzelne Hashtag-Daten hinzufügen
		/*
        $hashtag = array(
            'hashtag_id' => $row['id'],
            'hashtag_name' => $row['hashtag'],
			'active' => 'no'
        );
		*/

        // Hashtag-Daten zum JSON-Array hinzufügen
        $data[] = $hashtag;
    }

	// JSON-Array in eine JSON-Datei konvertieren
    $json = json_encode($data, JSON_PRETTY_PRINT);

    // JSON-Datei speichern
    $file = 'hashtags.json';
    file_put_contents($file, $json);
	
	   echo "Die JSON-Datei wurde erfolgreich generiert und gespeichert.";
} else {
    echo "Keine Hashtags gefunden.";
}



?>