<?php
$filePath = '/tmp/symovych.txt';
$file = fopen($filePath, 'w');

if (!$file) {
    echo "Cannot open file for writing at: $filePath";
    exit;
}
?>
