<?php

$DB_HOST = "localhost"; // sql200.ezyro.com
$DB_USER = "root"; // ezyro_40695927
$DB_PASS = "";// 941eea93507e
$DB_NAME = "freespace"; // ezyro_40695927_Freespace_DB

$link = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($link->connect_error) {
    die("Database connection failed: " . $link->connect_error);
}

?>