<?php
$filePath = dirname(__DIR__) . '/data/symovych.txt';

if (file_exists($filePath)) {
    echo nl2br(htmlspecialchars(file_get_contents($filePath)));
} else {
    echo "Results file not found :(";
}
?>
