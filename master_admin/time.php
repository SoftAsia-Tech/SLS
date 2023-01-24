<?php

date_default_timezone_set('Asia/Karachi');

$timestamp = time();
$formatted_date = date("Y-m-d H:i:s", $timestamp);
echo $formatted_date;
?>