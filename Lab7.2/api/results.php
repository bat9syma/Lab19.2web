<?php
$filePath = '/tmp/symovych.txt';

if (file_exists($filePath)) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="symovych.txt"');
    readfile($filePath);
    exit;
} else {
    echo "File not found: $filePath";
?>
