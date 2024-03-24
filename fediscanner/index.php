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
    <h2>FediScanner - Check Hashtag in the Fediverse</h2>
  
   <?php 
    include("inc/data.php");


   include("menu.php");
   
   ?>

  
<!-- statistic start --->
<?php 
include"statistic.php";
?>
<!-- statistic end --->

   <div class="container paginator">
    Do you have an idea for a new hashtag that I could monitor? Drop me an email at <b>info@fediscanner.info</b> and I'll take a look at it.
   </div>


<?php 
include("footer.php");
?>

</body>
</html>