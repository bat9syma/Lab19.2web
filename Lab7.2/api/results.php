<?php
$filePath = '/tmp/symovych.txt';

if (file_exists($filePath)) {
    header('Content-Type: text/plain; charset=utf-8');
    readfile($filePath);
} else {
    echo "Файл результату не знайдено :(";
}
