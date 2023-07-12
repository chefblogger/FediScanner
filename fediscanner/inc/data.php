<?php

// MySQL-Verbindung konfigurieren
$mysql_host = 'xxx';
$mysql_user = 'xxx';
$mysql_password = 'xxx';
$mysql_database = 'xxx';

// MySQL-Verbindung herstellen
$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
if ($mysqli->connect_error) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
?>