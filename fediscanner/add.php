<?php 
include("inc/data.php");

$hashtag_id = $_REQUEST['hashtag'];

$sql = "SELECT * FROM list_hashtag WHERE id = '$hashtag_id'";
$result = $mysqli->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $idee_hashtag = $row['hashtag'];
    $idee_origin = $row['origin'];
    //echo "$idee_hashtag $idee_url";

    $idee_urls = $idee_origin . '/tags/' . $idee_hashtag;
    //echo $idee_urls;

    $now = time();

    $sql_add = "INSERT INTO check_hashtag (hashtag, origin, rss, zeit) VALUES ('$idee_hashtag','$idee_origin','$idee_urls', '$now')";

    // Überprüfen, ob das Einfügen erfolgreich war
if ($mysqli->query($sql_add) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql_add . "<br>" . $mysqli->error;
}




} else {
    //echo "Es wurde kein Datensatz mit der ID $hashtg_id gefunden.";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hashtag to propose list</title>
    <meta name='robots' content='noindex, nofollow'>
    <meta http-equiv='refresh' content='1;URL=https://www.fediscanner.info/rec_hashtag.php'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    Your hashtag suggestion was registered
</body>
</html>