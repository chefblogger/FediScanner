<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("google.php"); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Used Hashtag in the Fediverse - FediScanner.info </title>
    <?php 
$some_titel = "Used Hashtag in the Fediverse - FediScanner.info ";
$some_description = "here you will find many hashtags that are used in fediverse, so you know what is currently being talked about";
$some_img = "https://www.fediscanner.info/images/fediscanner.jpg";
$some_url = "https://www.fediscanner.info";

echo "<meta name='robots' content='index, follow'>";
echo "<meta name='description' content='$some_description' />";
echo "<meta property='og:type' content='website'>";
echo "<meta property='og:title' content='$some_titel'>";
echo "<meta property='og:description' content='$some_description'>";
echo "<meta property='og:image' content='$some_img' />";
echo "<meta property='og:image:alt' content='$some_img'>";
echo "<meta property='og:url' content='$some_url' />";
echo "<meta name='twitter:card' content='summary_large_image'>";
echo "<meta name='twitter:title' content='$some_titel'>";
echo "<meta name='twitter:description' content='$some_description'>";
echo "<meta name='twitter:image' content='$some_img' />";
?>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>FediScanner - Check your Hashtag</h2>
  
   <?php 
    include("inc/data.php");


   include("menu.php");
   
   ?>

  
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

$query3 = "SELECT COUNT(*) AS SUM FROM list_hashtag";
$result3 = mysqli_query($mysqli,$query3);
$rows3 = mysqli_fetch_assoc($result3);
$recorded_hashtag = $rows3['SUM'];


Echo "Total recorded hashtag-posts in database: $total_hashtag<br />";
Echo "Total hashtag ever used and recorded: $recorded_hashtag<br />";
Echo "Total instance in database: $total_instance<br />";
    ?>
</div>
   <div class="container paginator">
    Ihr habt eine Idee für einen neuen Hashtag den ich Überwachen könnte? Schreib mir eine eMail an <b>info@fediscanner.info</b> und ich schau es mir an.
   </div>


<?php 
include("footer.php");
?>

</body>
</html>