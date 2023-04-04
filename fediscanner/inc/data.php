<?php

// MySQL-Verbindung konfigurieren
$mysql_host = 'localhost';
$mysql_user = 'db_user';
$mysql_password = 'db_password';
$mysql_database = 'db_name';

// MySQL-Verbindung herstellen
$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
if ($mysqli->connect_error) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
?>