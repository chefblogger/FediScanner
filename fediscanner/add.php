<?php 
include("inc/data.php");



$check = $_REQUEST['check'];

if ($check == 'add')
{
    $hashtag_id = $_REQUEST['hashtag'];
    $addcaptcha = $_REQUEST['addcaptcha']; // zahl von user
    $captcha = $_REQUEST['captcha']; // richtiges resultat

    if ($addcaptcha == $captcha)
    {

        $sql = "SELECT * FROM list_hashtag WHERE id = '$hashtag_id'";
        $result = $mysqli->query($sql);

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $idee_hashtag = $row['hashtag'];
                    $idee_origin = $row['origin'];
                    //echo "$idee_hashtag $idee_url";

                    $idee_urls = $idee_origin . '/tags/' . $idee_hashtag;
                    //echo $idee_urls;

                    $now = time();

                    $sql_add = "INSERT INTO check_hashtag (hashtag, origin, rss, zeit) VALUES ('$idee_hashtag','$idee_origin','$idee_urls', '$now')";

                    // Überprüfen, ob das Einfügen erfolgreich war
                if ($mysqli->query($sql_add) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql_add . "<br>" . $mysqli->error;
                }

        } else 
        {
            //echo "Es wurde kein Datensatz mit der ID $hashtg_id gefunden.";
        }

        echo "<meta http-equiv='refresh' content='1;URL=https://www.fediscanner.info/rec_hashtag.php'>";
    }
    else 
    {
     echo "<meta http-equiv='refresh' content='0;URL=https://www.fediscanner.info/rec_hashtag.php'>";   
    }
    }
else
{
$hashtag_id = $_REQUEST['hashtag'];

$zahl1 = rand(1,10);
$zahl2 = rand(1,10);

$captcha = $zahl1 + $zahl2;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hashtag to propose list</title>
    <meta name='robots' content='noindex, nofollow'>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Security Check</h2>
        <form method="post">
            <?php 
            echo "$zahl1 + $zahl2 =";
            ?>
            <input type="number" name="addcaptcha">
            <input type="hidden" name="check" value="add">
            <input type="hidden" name="captcha" value="<?php echo $captcha ?>">
            <input type="hidden" name="hashtag_id" value="<?php echo $hashtag_id ?>">
            <button type="submit">Check</button>
        </form>
    </div>
</body>
</html>
<?php 
//<meta http-equiv='refresh' content='1;URL=https://www.fediscanner.info/rec_hashtag.php'>
}
?>