<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hide hashtag</title>
    <meta name='robots' content='noindex, nofollow'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("menu.php"); ?>
    
<?php 

include("../inc/data.php");
?>
<div class="container">
<h1>hide Hashtag</h1>
<br /><br />
<?php 
$hide_hashtag = $_REQUEST['hide'];
echo $hide_hashtag;

$sql = "UPDATE list_hashtag SET hidden = '1' WHERE id = $hide_hashtag";
if ($mysqli->query($sql)) {
    echo "Die URL wurde erfolgreich aktualisiert.";
} else {
    echo "Fehler beim Aktualisieren der URL: " . $mysqli->error;
}
?>

</body>
</html>