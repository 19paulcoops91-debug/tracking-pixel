<?php
// Log file path
$logFile = __DIR__ . '/pixel_log.csv';

// Collect data
$time      = date('c');
$ip        = $_SERVER['REMOTE_ADDR'] ?? '';
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$id        = $_GET['id'] ?? '';

// Build CSV line
$line = sprintf(
    "\"%s\",\"%s\",\"%s\",\"%s\"\n",
    $time,
    $ip,
    str_replace('"', '""', $userAgent),
    str_replace('"', '""', $id)
);

// Append to log
file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);

// Serve the 1x1 pixel
$imgPath = __DIR__ . '/pixel.png';
header('Content-Type: image/png');
header('Content-Length: ' . filesize($imgPath));
readfile($imgPath);
exit;
