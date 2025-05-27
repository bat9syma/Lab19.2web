<?php
$filePath = '/tmp/symovych.txt';

if (file_exists($filePath)) {
    header('Content-Type: text/plain');
    readfile($filePath);
} else {
    echo "Файл не знайдено: $filePath";
}
