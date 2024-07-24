<?php

require_once __DIR__ . '/_Config.php';

use System\Log\Logs;

$log = new Logs();
$log->critical("Class_Method", "User account register success!", [
    "user_id" => 1,
    "user_name" => "John Doe",
    "user_email" => "john.doe@example.com",
    "date" => date("Y-m-d H:i:s"),
    "time" => time()
]);