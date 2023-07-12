<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("google.php"); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instances in the Database - FediScanner.info</title>
    <?php 
$some_titel = "All instances in this database - FediScanner.info";
$some_description = "here you will find all instances ever recorded";
$some_img = "https://www.fediscanner.info/images/fediscanner.jpg";
$some_url = "https://www.fediscanner.info/res_hashtag.php";

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
    <h2>Hashtags in the Database</h2>
<?php 
$start_time = microtime(true);

include("inc/data.php");
include("menu_mini.php");
?>
    <div class="instance">
    If you would like to have a hashtag recorded that is in this list, then click on the button and I will check it and release it if possible.
    <br /><br />


    <div class="grid-home-container">
<?php 

/*
$sql = "SELECT * FROM list_hashtag ORDER by hashtag ASC ";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) 
{
    $hashtag_name0 = $row['hashtag'];
    $hashtag_name = strtolower($hashtag_name0);
    $hashtag_id = $row['id'];
    $hashtag_origin = $row['origin'];
	$hashtag_hidden = $row['hidden'];

    
    //https://mastodon.social/tags/wordpress.rss
    $check_hashtag = $hashtag_origin . '/tags/' . $hashtag_name . '.rss';
    //echo "$check_hashtag - $hashtag_name<br />";
    
	// ist der hashtag versteck?
	if ($hashtag_hidden == '1')
	{
		//vesteckt ignorerein
	}
	else
	{


    // Überprüfen, ob die URL bereits in der Datenbank vorhanden ist
        $sql_check = "SELECT COUNT(*) AS count FROM urls WHERE urls = '$check_hashtag'";
        $result_check = $mysqli->query($sql_check);
        $row_check = $result_check->fetch_assoc();
        $count = $row_check['count'];
        if ($count > 0) {
          //echo "$hashtag_name <b>ist da</b>";
          echo "<div class='grid-home-item-checked'>";
          echo "$hashtag_name";
          echo "</div>";
        }
        else 
        {
          echo "<a href='add.php?hashtag=$hashtag_id' class='add'>";
          echo "<div class='grid-home-item'>";
          echo "$hashtag_name";
          echo "</div>";
          echo "</a>";
        }
	}
    
     
}

*/

//json file auslesen
$jsonData = file_get_contents('inc/hashtags.json');

$data = json_decode($jsonData, true);

if ($data !== null){
	foreach ($data as $hashtag) {
		$hashtag_id = $hashtag['hashtag_id'];
		$hashtag_name = $hashtag['hashtag_name'];
		$hashtag_active = $hashtag['active'];

		if ($hashtag_active == '0')
		{
			echo "<a href='add.php?hashtag=$hashtag_id' class='add'>";
          	echo "<div class='grid-home-item'>";
          	echo "$hashtag_name";
          	echo "</div>";
          	echo "</a>";
		}
		else
		{
			echo "<div class='grid-home-item-checked'>";
          	echo "$hashtag_name";
          	echo "</div>";
		}
		
		/*
		echo "<div class='grid-home-item'>";
		echo $hashtag_name;
		echo "</div>";
		*/

	}
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
<?php 
$end_time = microtime(true);
$runtime = ($end_time - $start_time);
//echo "runtime: $runtime sec";
?>
</body>
</html>