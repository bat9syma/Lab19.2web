<?php
$tempPath = sys_get_temp_dir() . '/symovych.txt';

// Перевірка, чи файл існує
if (!file_exists($tempPath)) {
    echo "<p style='color: red;'>Файл не знайдено :(</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <title>Результати обчислень</title>
</head>
<body>
  <h2>Результати</h2>

  <p style="color: green;"> Файл успішно записано у тимчасову папку: <code><?= htmlspecialchars($tempPath) ?></code></p>

  <h3>Вміст файлу:</h3>
  <pre><?= htmlspecialchars(file_get_contents($tempPath)) ?></pre>

  <form method="post" action="download.php">
    <input type="hidden" name="filename" value="symovych.txt">
    <button type="submit">⬇ Завантажити файл</button>
  </form>

</body>
</html>
