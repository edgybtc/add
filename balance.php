<?php

$db_host = 'localhost'; // Server Name
$db_user = 'root'; // Username
$db_pass = "7.}B-ysJXMnnB@'C"; // Password
$db_name = 'bitlendobot'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$sql = 'SELECT chat_id
                FROM udetails';

$query = mysqli_query($conn, $sql);

if (!$query) {
        die ('SQL Error: ' . mysqli_error($conn));
}

$text=$argv[1];
$text=urlencode($text);
$url='https://api.telegram.org/bot600164611:AAEtaJJqpHnBdZ8UiWGR04aF1HKRPIzed4o/';


while ($row = mysqli_fetch_array($query))

{
$chat_id=intval($row['chat_id']);

file_get_contents($url."sendmessage?chat_id=".$chat_id."&parse_mode=markdown&reply_markup=$inkeyboard&text=$text");
sleep(1);
}


?>
