<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("google.php"); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Startseite - FediScanner </title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>FediScanner - Check your Hashtag</h2>
  
   <?php 
   include("themen.php");
   include("inc/data.php");
   ?>
   <div class="container paginator">
    Ihr habt eine Idee für einen neuen Hashtag den ich Überwachen könnte? Schreib mir eine eMail an <b>info@maechler.cloud</b> und ich schau es mir an.
   </div>
  
<div class="statistik">
    <?php 
// wieviele erkannte instanzen
$query1 = "SELECT COUNT(*) AS SUM FROM instance";
$result1 = mysqli_query($mysqli,$query1);
$rows1 = mysqli_fetch_assoc($result1);
$total_instance = $rows1['SUM'];

$query2 = "SELECT COUNT(*) AS SUM FROM articles";
$result2 = mysqli_query($mysqli,$query2);
$rows2 = mysqli_fetch_assoc($result2);
$total_hashtag = $rows2['SUM'];

Echo "Total Instance in DB: $total_instance<br />";
Echo "Total Hashtag Posts in DB: $total_hashtag<br />";
    ?>
</div>


<div class="instance">
    <h3>Instances in Database</h3>
<div class="grid-home-container">
<?php 

$sql = "SELECT * FROM instance ORDER by name DESC ";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    $instance_name = $row['name'];

    $domain = parse_url($instance_name, PHP_URL_HOST);
echo "<div class='grid-home-item'>";
//echo "$instance_name - $domain<br />";
echo "<a href='$instance_name' target='_blank'>$domain</a>";
echo "</div>";
}
?>
    </div>
</div>


</body>
</html>