<?php
session_start();

// Підключення функцій
require_once __DIR__ . '/../includes/fun.php';

// Отримання даних з POST
$lastname = $_POST['lastname'] ?? '';
$firstname = $_POST['firstname'] ?? '';
$group = $_POST['group'] ?? '';
$variant = isset($_POST['variant']) ? (int)$_POST['variant'] : 1;
$x_start = isset($_POST['x_start']) ? (float)$_POST['x_start'] : 0;
$x_end = isset($_POST['x_end']) ? (float)$_POST['x_end'] : 0;
$y = isset($_POST['y']) ? $_POST['y'] * $variant : 0;
$z = isset($_POST['z']) ? $_POST['z'] / $variant : 0;

// Зчитування кроку з файлу config/x_step.txt
$stepFile = __DIR__ . '/../config/x_step.txt';
if (!file_exists($stepFile)) {
    die("Помилка: файл x_step.txt не знайдено.");
}
$config = file_get_contents($stepFile);
preg_match('/x_step\s*=\s*([\d.]+)/', $config, $matches);
$x_step = isset($matches[1]) ? (float)$matches[1] : 1.0;

$outputPath = sys_get_temp_dir() . '/symovych.txt';
$file = fopen($outputPath, "w");

if (!$file) {
    die("Помилка: не вдалося створити файл.");
}

// Запис у файл
fwrite($file, "Full name: $lastname $firstname\n");
fwrite($file, "Group: $group\n");
fwrite($file, "Variant: $variant\n");
fwrite($file, "Y = $y, Z = $z\n");
fwrite($file, "X_step = $x_step\n");
fwrite($file, "\nX\tf(x,y,z)\n");
fwrite($file, "-------------------\n");

// Табуляція
for ($x = $x_start; $x <= $x_end; $x += $x_step) {
    $f = calculateExpression($x, $y, $z); 
    fwrite($file, "$x\t" . round($f, 4) . "\n");
}

fclose($file);

$_SESSION['result_file'] = $outputPath;

exit("Розрахунок завершено. Файл збережено.");
