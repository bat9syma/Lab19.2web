<?php
// Задаємо той самий шлях, що й у calculate.php
$userDesktopPath = 'C:\xampp\htdocs\Lab7.2\data';
$file_path = $userDesktopPath . '/symovych.txt';

if (!file_exists($file_path)) {
    die("Файл результатів не знайдено за шляхом: $file_path");
}

// Зчитуємо вміст файлу
$content = file_get_contents($file_path);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8" />
    <title>Результати табуляції</title>
    <style>
        pre {
            background: #f0f0f0;
            padding: 15px;
            border: 1px solid #ccc;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <h2>Результати табуляції з файлу</h2>
    <pre><?php echo htmlspecialchars($content); ?></pre>
    <a href="/">Повернутися до форми</a>
</body>
</html>
