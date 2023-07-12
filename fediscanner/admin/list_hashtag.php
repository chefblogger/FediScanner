<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List hashtag</title>
    <meta name='robots' content='noindex, nofollow'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("menu.php"); ?>
    
<?php 

include("../inc/data.php");
?>
<div class="container">
<h1>List all Hashtag</h1>
<table>
    <tr>
        <th width='800'>URL</th>
        <th>Menu</th>
    </tr>
<?php 


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
          
        }
        else 
        {
          echo "<a href='hide_hashtag.php?hide=$hashtag_id' class='weiss' target='_blank'>";
          
          echo "$hashtag_name";
          
          echo "</a><br />";
        }
	}
    
     
}
?>
</table>
</div>

</body>
</html>