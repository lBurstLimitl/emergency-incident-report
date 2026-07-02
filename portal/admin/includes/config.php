<?php
$mysql_hostname = getenv('DB_HOST') ?: 'localhost';
$mysql_user     = getenv('DB_USER') ?: 'root';
$mysql_password = getenv('DB_PASS') ?: '';
$mysql_database = getenv('DB_NAME') ?: 'db_ems';

$db = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysqli_select_db($db, $mysql_database) or die("Could not select database");