<?php 

include("../inc/data.php");

$id = $_REQUEST['id'];

$sql = "SELECT * FROM urls WHERE id = $id";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$url = $row['urls'];

$tag1 = explode('/tags/', $url);
$link0 = $tag1[0];
$hashtag0 = $tag1[1];
$hashtag = strtolower($hashtag0);
$hashtag_kleingeschrieben = strtolower($hashtag0);

$hashtag_ohne_rss = substr($hashtag0, 0, -4);

$link = $link0 . '/tags/';

// delete from urls twitter


$sql_del1 = "DELETE FROM urls WHERE id = $id";
        if ($mysqli->query($sql_del1)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags in urls: " . $mysqli->error;
        }

// delete from list_hashtag

$sql_del2 = "DELETE FROM list_hashtag WHERE hashtag = '$hashtag_ohne_rss' AND origin = '$link0'";
        if ($mysqli->query($sql_del2)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags in list_hashtag: " . $mysqli->error;
        }


//delete article mit url
$sql_del2 = "DELETE FROM articles WHERE rss_feed_url = '$url'";
        if ($mysqli->query($sql_del2)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags in list_hashtag: " . $mysqli->error;
        }



/*
//delete from hashtags

        $sql_del4 = "DELETE FROM hashtags WHERE hashtag = '$hashtag_kleingeschrieben'";
        if ($mysqli->query($sql_del4)) {
            echo "Der Eintrag wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags in hashtag: " . $mysqli->error;
        }
*/
//<meta http-equiv='refresh' content='10;URL=https://www.fediscanner.info/admin/list_url.php'>
?>
<meta http-equiv='refresh' content='0;URL=https://www.fediscanner.info/admin/list_url.php'>
<br>
id: <?php echo $id ?><br>
url: <?php echo $url ?><br>
link0: <?php echo $link0 ?><br>
link: <?php echo $link ?><br>
hashtag: <?php echo $hashtag ?><br>
hashtag0: <?php echo $hashtag0 ?><br>
hashtag_ohne_rss: <?php echo $hashtag_ohne_rss ?><br>

