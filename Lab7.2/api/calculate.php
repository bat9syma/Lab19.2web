<?php
session_start();
require_once __DIR__ . '/../includes/fun.php';

// Зчитуємо дані з форми
$lastname = $_POST['lastname'] ?? '';
$firstname = $_POST['firstname'] ?? '';
$group = $_POST['group'] ?? '';
$variant = isset($_POST['variant']) ? (int)$_POST['variant'] : 1;
$x_start = isset($_POST['x_start']) ? (float)$_POST['x_start'] : 0.0;
$x_end = isset($_POST['x_end']) ? (float)$_POST['x_end'] : 0.0;
$y = isset($_POST['y']) ? $_POST['y'] * $variant : 0;
$z = isset($_POST['z']) ? $_POST['z'] / $variant : 0;

// Зчитування кроку з файлу config/x_step.txt
$config_path = __DIR__ . '/../config/x_step.txt';
$x_step = 1.0; // дефолтний крок
if (file_exists($config_path)) {
    $config = file_get_contents($config_path);
    if (preg_match('/x_step\s*=\s*([\d.]+)/', $config, $matches)) {
        $x_step = (float)$matches[1];
    }
}

// Шлях для файлу на робочому столі Windows (заміни USERNAME на своє ім'я користувача)
$userDesktopPath = 'C:\xampp\htdocs\Lab7.2\data';
$file_path = $userDesktopPath . '/symovych.txt';

// Відкриваємо файл для запису
$file = fopen($file_path, 'w');
if (!$file) {
    die("Помилка: не вдалося відкрити файл для запису: $file_path");
}

// Записуємо інформацію
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

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8" />
    <title>Результат обчислень</title>
</head>
<body>
    <h2>Файл успішно записано :)</h2>
    <p>Файл знаходиться тут: <strong><?php echo htmlspecialchars($file_path); ?></strong></p>
    <form action="/results.php" method="get">
        <button type="submit">Переглянути результат</button>
    </form>
</body>
</html>
