<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("google.php"); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instances in Database - FediScanner.info</title>
    <?php 
$some_titel = "All recorded instances in this database - FediScanner.info";
$some_description = "here you will find all hashtags ever recorded";
$some_img = "https://www.fediscanner.info/images/fediscanner.jpg";
$some_url = "https://www.fediscanner.info/res_instances.php";

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Instances in Database</h2>
<?php 
include("inc/data.php");
include("menu_mini.php");
?>
    <div class="instance">
    


    <div class="grid-home-container">
<?php 


$sql = "SELECT * FROM instance ORDER by name ASC ";
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


<a id="back-to-top" href="#">Up</a>
<script>
  // Zurück-nach-oben-Button einblenden, wenn nach unten gescrollt wird
$(window).scroll(function() {
  if ($(this).scrollTop() > 100) {
    $('#back-to-top').fadeIn();
  } else {
    $('#back-to-top').fadeOut();
  }
});

// Bei Klick auf den Zurück-nach-oben-Button zur obersten Seite scrollen
$('#back-to-top').click(function() {
  $('html, body').animate({scrollTop : 0},800);
  return false;
});

</script>

</body>
</html>