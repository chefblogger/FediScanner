<h2>generate json file for hashtag</h2>
<?php 
include("data.php");


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


$data = array(
	array (
            'total_hashtag' => $total_hashtag,
            'recorded_hashtag' => $recorded_hashtag,
			'total_instance' => $total_instance,
			'total_status_count' => $total_status_count,
			'total_user_count' => $total_user_count
			
	)
	);

//json file erstellen
$json_data = json_encode($data);

//json speichern
$file = 'statistic.json';
file_put_contents($file, $json_data);

echo "json datei wurde erfolgreich generiert";





?>