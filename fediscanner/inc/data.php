<?php

// MySQL-Verbindung konfigurieren
$mysql_host = 'machlere.mysql.db.internal';
$mysql_user = 'machlere_masto';
$mysql_password = 'BxAapYF4aNrj?y+PA6tC';
$mysql_database = 'machlere_masto';

// MySQL-Verbindung herstellen
$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
if ($mysqli->connect_error) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
?>