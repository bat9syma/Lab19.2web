<?php
session_start();
require_once __DIR__ . '/../includes/fun.php';

$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$group = $_POST['group'];
$variant = (int)$_POST['variant'];
$x_start = (float)$_POST['x_start'];
$x_end = (float)$_POST['x_end'];

// Читаємо конфіг
$configPath = __DIR__ . '/../config/x_step.txt';
if (!file_exists($configPath)) {
    die("Configuration file not found.");
}

$config = file_get_contents($configPath);
preg_match('/x_step\s*=\s*([\d.]+)/', $config, $matches);
$x_step = isset($matches[1]) ? (float)$matches[1] : 1.0;

$y = $_POST['y'] * $variant;
$z = $_POST['z'] / $variant;

// Шлях до файла в тимчасовій директорії
$outputPath = '/tmp/symovych.txt';
$file = fopen($outputPath, "w");

if (!$file) {
    die("❌ Cannot open file for writing");
}

$success = true; // прапорець успіху

$success &= fwrite($file, "Full name: $lastname $firstname\n") !== false;
$success &= fwrite($file, "Group: $group\n") !== false;
$success &= fwrite($file, "Variant: $variant\n") !== false;
$success &= fwrite($file, "Y = $y, Z = $z\n") !== false;
$success &= fwrite($file, "X_step = $x_step\n") !== false;
$success &= fwrite($file, "\nX\tf(x,y,z)\n") !== false;
$success &= fwrite($file, "-------------------\n") !== false;

// Табуляція
for ($x = $x_start; $x <= $x_end; $x += $x_step) {
    $f = calculateExpression($x, $y, $z);
    $line = "$x\t" . round($f, 4) . "\n";
    $success &= fwrite($file, $line) !== false;
}

fclose($file);

// Повідомлення про результат
if ($success) {
    echo "Дані успішно записані у файл.";
} else {
    echo "Сталася помилка під час запису у файл.";
}
?>
