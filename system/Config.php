<?php

require_once '../vendor/autoload.php';

# ------------------------------------
# Load .env file
# ------------------------------------
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

# ------------------------------------
# Set exception handler
# ------------------------------------
if($_ENV['PROJECT_ENVIRONMENT'] == 'production') {
	set_exception_handler(function($exception) {
		echo $exception->getMessage();
		exit(1);
	});
}

# ------------------------------------
# Set time zone
# ------------------------------------
date_default_timezone_set($_ENV['TIME_ZONE']);

# ------------------------------------
# Init session
# ------------------------------------
session_start();