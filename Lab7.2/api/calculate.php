<?php
session_start();
require_once 'includes/fun.php';

$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$group = $_POST['group'];
$variant = (int)$_POST['variant'];
$x_start = (float)$_POST['x_start'];
$x_end = (float)$_POST['x_end'];

// Зчитування кроку
$config = file_get_contents('x_step.txt');
preg_match('/x_step\s*=\s*([\d.]+)/', $config, $matches);
$x_step = isset($matches[1]) ? (float)$matches[1] : 1.0;

$y = $_POST['y'] * $variant;
$z = $_POST['z'] / $variant;

$file = fopen("symovych.txt", "w");

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

exit;
?>
