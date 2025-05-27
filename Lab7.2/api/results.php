<?php
$tempPath = sys_get_temp_dir() . '/symovych.txt';

// Перевірка, чи файл існує
if (!file_exists($tempPath)) {
    echo "<p style='color: red;'>Файл не знайдено :(</p>";
    exit;
}
?>
