<?php
include("../inc/data.php");

$check = $_REQUEST['check'];
$id_unchecked = $_REQUEST['id'];
$id_validated = preg_replace('/[^a-zA-Z0-9_\-]/', '', $id_unchecked);
$id_input = htmlspecialchars($id_validated, ENT_QUOTES, 'UTF-8');


if ($check == '0')
{
$sql = "UPDATE articles SET status='0' WHERE id=$id_input";

    if ($mysqli->query($sql) === TRUE) {
        //echo "ok\n";
    } else {
        //echo "Error: " . $mysqli->error . "\n";
    }
}
elseif ($check == '3')
{
    $sql = "UPDATE articles SET status='3' WHERE id=$id_input";

    if ($mysqli->query($sql) === TRUE) {
        //echo "ok\n";
    } else {
        //echo "Error: " . $mysqli->error . "\n";
    }   
}
else
{}
?>
<meta http-equiv="refresh" content="0;url=https://www.fediscanner.info/admin/check_reports.php" />

