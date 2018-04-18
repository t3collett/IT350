<?php
session_start();
if ($_SESSION['logged_in'] == NULL) {
    header("Location: login.php");
    exit();
}
include('settings.php');
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	echo passthru('curl -X PUT "http://localhost:9200/_snapshot/my_backup" -H \'Content-Type: application/json\' -d\'
{
    "type": "fs",
    "settings": {
        "location": "/mount/backups/elasticsearchBackup",
        "compress": true
    }
}
\'
"');

?>