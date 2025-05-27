<?php
session_start();
require_once __DIR__ . '/../includes/fun.php';  

// Забираємо дані з форми
$lastname = $_POST['lastname'] ?? '';
$firstname = $_POST['firstname'] ?? '';
$group = $_POST['group'] ?? '';
$variant = isset($_POST['variant']) ? (int)$_POST['variant'] : 1;
$x_start = isset($_POST['x_start']) ? (float)$_POST['x_start'] : 0.0;
$x_end = isset($_POST['x_end']) ? (float)$_POST['x_end'] : 0.0;
$y_input = isset($_POST['y']) ? (float)$_POST['y'] : 0.0;
$z_input = isset($_POST['z']) ? (float)$_POST['z'] : 0.0;

// Зчитуємо x_step 
$configPath = __DIR__ . '/../config/x_step.txt';
$x_step = 1.0; // дефолт
if (file_exists($configPath)) {
    $config = file_get_contents($configPath);
    if (preg_match('/x_step\s*=\s*([\d\.]+)/', $config, $matches)) {
        $x_step = (float)$matches[1];
    }
}

$y = $y_input * $variant;
$z = $z_input / $variant;

$filePath = '/tmp/symovych.txt';

// Відкриваємо файл для запису
$file = fopen($filePath, 'w');
if (!$file) {
    echo "Помилка: не вдалось відкрити файл для запису!";
    exit;
}

// Записуємо дані у файл
fwrite($file, "Full name: $lastname $firstname\n");
fwrite($file, "Group: $group\n");
fwrite($file, "Variant: $variant\n");
fwrite($file, "Y = $y, Z = $z\n");
fwrite($file, "X_step = $x_step\n");
fwrite($file, "\nX\tf(x,y,z)\n");
fwrite($file, "-------------------\n");

for ($x = $x_start; $x <= $x_end; $x += $x_step) {
    $f = calculateExpression($x, $y, $z);
    fwrite($file, "$x\t" . round($f, 4) . "\n");
}

fclose($file);
echo "Файл успішно записано :)";
