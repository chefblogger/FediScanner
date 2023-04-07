<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List all RSS suggestions</title>
    <meta name='robots' content='noindex, nofollow'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("menu.php"); ?>
    
<?php 

include("../inc/data.php");
?>
<div class="container">
<h1>List all URL</h1>
<table>
    <tr>
        <th width='150'>Added</th>
        <th width='500'>URL</th>
        <th>Menu</th>
    </tr>
<?php 
$sql = "SELECT * FROM check_hashtag ORDER by id ASC ";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    $hashtag = $row['hashtag'];
    $origin = $row['origin'];
    $rss = $row['rss'];
    $zeit = $row['zeit'];
    $lid = $row['id'];

    $uhrzeit = date("d.m.Y H:i", $zeit);

    $link = $origin . '/tags/' . $hashtag;

    $rsslink = $link . '.rss';
    echo "<tr>";
    echo "<td>$uhrzeit</td><td><a href='$link' target='_blank' class='urls'>$rss</a></td><td><a href='add_new_rss.php?check=yes&rss=$rsslink&lid=$lid' class='add_rss'>yes</a> | <a href='add_new_rss.php?check=no&rss=$rsslink&lid=$lid' class='add_rss'>no</a></td>";
    echo "<tr>";
   
}
?>
</table>
</div>
</body>
</html>