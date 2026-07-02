<?php

/*
 * Database config — Railway-ready version
 * Reads credentials from environment variables set in Railway dashboard.
 * Falls back to localhost defaults for local development.
 */

$db_host     = getenv('DB_HOST')     ?: 'localhost';
$db_user     = getenv('DB_USER')     ?: 'root';
$db_pass     = getenv('DB_PASS')     ?: '';
$db_database = getenv('DB_NAME')     ?: 'db_ems';

include "idiorm.php";

ORM::configure("mysql:host=" . $db_host . ";dbname=" . $db_database);
ORM::configure("username", $db_user);
ORM::configure("password", $db_pass);

$db = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$conn = mysqli_connect($db_host, $db_user, $db_pass);
mysqli_select_db($conn, $db_database);

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_database);

class App
{
    public static function message($type, $message, $code = '')
    {
        if ($type == 'error') {
            return '<div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                       ' . $message . ' <a class="alert-link" href="#">' . $code . '</a>.
                    </div>';
        } else {
            return '<div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                       ' . $message . ' <a class="alert-link" href="#">' . $code . '</a>.
                    </div>';
        }
    }
}

function get($val)
{
    return @$_GET[$val];
}
