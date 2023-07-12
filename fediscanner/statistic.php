<div class="statistik">
    <?php 
$start_time = microtime(true);
// wieviele erkannte instanzen
/*
$query1 = "SELECT COUNT(*) AS SUM FROM instance";
$result1 = mysqli_query($mysqli,$query1);
$rows1 = mysqli_fetch_assoc($result1);
$total_instance = $rows1['SUM'];

$query_statuscount_sum = "SELECT SUM(status_count) AS total_status_count FROM instance";
$result_statuscount_sum = mysqli_query($mysqli, $query_statuscount_sum);
$row_statuscount_sum = mysqli_fetch_assoc($result_statuscount_sum);
$total_status_count0 = $row_statuscount_sum["total_status_count"]; 
$total_status_count = number_format($total_status_count0, 0, "'", "'");

$query_usercount_sum = "SELECT SUM(user_count) AS total_user_count FROM instance";
$result_usercount_sum = mysqli_query($mysqli, $query_usercount_sum);
$row_usercount_sum = mysqli_fetch_assoc($result_usercount_sum);
$total_user_count0 = $row_usercount_sum["total_user_count"]; 
$total_user_count = number_format($total_user_count0, 0, "'", "'");

$query2 = "SELECT COUNT(*) AS SUM FROM articles";
$result2 = mysqli_query($mysqli,$query2);
$rows2 = mysqli_fetch_assoc($result2);
$total_hashtag = $rows2['SUM'];

$query3 = "SELECT COUNT(*) AS SUM FROM list_hashtag";
$result3 = mysqli_query($mysqli,$query3);
$rows3 = mysqli_fetch_assoc($result3);
$recorded_hashtag = $rows3['SUM'];
*/


$json_file = "inc/statistic.json";
$json_data = file_get_contents($json_file);

$json_inhalt = json_decode($json_data, true);

$total_hashtag = $json_inhalt[0]['total_hashtag'];
$recorded_hashtag = $json_inhalt[0]['recorded_hashtag'];
$total_instance = $json_inhalt[0]['total_instance'];
$total_status_count = $json_inhalt[0]['total_status_count'];
$total_user_count = $json_inhalt[0]['total_user_count'];


Echo "Total recorded hashtag-posts in database: $total_hashtag<br />";
Echo "Total hashtag ever used and recorded: $recorded_hashtag<br />";
Echo "Total instances in database: $total_instance<br />";
ECHO "Total messages in all recorded instances: $total_status_count<br />";
ECHO "Total user in all recorded instances: $total_user_count<br />";
  

$end_time = microtime(true);
$runtime = ($end_time - $start_time);
echo "runtime: $runtime sec";
?>
</div>