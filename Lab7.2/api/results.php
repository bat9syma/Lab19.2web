<?php
if (file_exists("../data/symovych.txt")) {
    echo htmlspecialchars(file_get_contents("../data/symovych.txt"));
} else {
    echo "Results file not found :(";
}
?>
