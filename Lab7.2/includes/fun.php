<?php
function calculateExpression($x, $y, $z) {
    $numerator1 = pow(abs(sin(pow($x, 2) - 1)), 0.3);
    $numerator2 = sqrt(pow(cos(abs($y + 2 * $z)), 2));
    $numerator = $numerator1 - $numerator2;

    $denominator = 1 + ($z / 1) + (pow($y, 2) / 2) + (pow(abs($x), 3) / 6); 
    return $numerator / $denominator;
}
?>
    