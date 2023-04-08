<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List all URL</title>
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
        <th width='800'>URL</th>
        <th>Menu</th>
    </tr>
<?php 
$sql = "SELECT * FROM urls ORDER by id DESC ";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    $url_name = $row['urls'];
    $id = $row['id'];
$urls = substr($url_name, 0, -4);

    echo "<tr>";
    echo "<td><a href='$urls' target='_blank' class='urls'>$url_name</a></td><td><a href='del_hashtag.php?id=$id' class='urls'>Delete</a></td>";
    echo "<tr>";
   
}
?>
</table>
</div>
</body>
</html>