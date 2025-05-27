<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filename'])) {
    $filename = basename($_POST['filename']);
    $filepath = sys_get_temp_dir() . '/' . $filename;

    if (file_exists($filepath)) {
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        readfile($filepath);
        exit;
    } else {
        echo "Файл не знайдено.";
    }
} else {
    echo "Неправильний запит.";
}
