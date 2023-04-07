<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>alles löschen</title>
    <meta name='robots' content='noindex, nofollow'>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv='refresh' content='0;URL=https://www.fediscanner.info/admin/delete.php'>
    
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
<h1>List all URL</h1>
<br />
<?php 
include("../inc/data.php");

$check = $_REQUEST['check'];

if ($check == 'all')
{
    echo "<p>Alles gelöscht</p>";
    //delete alter vorschlag
        $sql_del1 = "TRUNCATE TABLE urls";
        if ($mysqli->query($sql_del1)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags: " . $mysqli->error;
        }

        $sql_del2 = "TRUNCATE TABLE list_hashtag";
        if ($mysqli->query($sql_del2)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags: " . $mysqli->error;
        }

        $sql_del3 = "TRUNCATE TABLE instance";
        if ($mysqli->query($sql_del3)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags: " . $mysqli->error;
        }

        $sql_del4 = "TRUNCATE TABLE hashtags";
        if ($mysqli->query($sql_del4)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags: " . $mysqli->error;
        }

        $sql_del5 = "TRUNCATE TABLE check_hashtag";
        if ($mysqli->query($sql_del5)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags: " . $mysqli->error;
        }

        $sql_del6 = "TRUNCATE TABLE articles";
        if ($mysqli->query($sql_del6)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags: " . $mysqli->error;
        }


}
elseif ($check == 'suggestion')
{
    $sql_del5 = "TRUNCATE TABLE check_hashtag";
        if ($mysqli->query($sql_del5)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags: " . $mysqli->error;
        }
}
elseif($check == 'instance_usercount')
{
    $sql_del7 = "UPDATE instance SET user_count = 0, status_count = 0;";
        if ($mysqli->query($sql_del7)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags: " . $mysqli->error;
        }
}
else
{
   echo "<p>ERROR</p>"; 
}

?>
</div>
</body>
</html>