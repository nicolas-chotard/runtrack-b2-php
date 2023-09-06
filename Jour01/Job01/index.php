<?php
function my_str_search(string $haystack, string $needle): int {
    $count = 0;
    for ($i = 0; $i < strlen($haystack); $i++) {
        if ($haystack[$i] === $needle) {
            $count++;
        }
    }
    return $count;
}

$haystack = "La Plateforme";
$needle = "a";
$result = my_str_search($haystack, $needle);
echo "Le nombre d'occurrences de '$needle' dans la chaîne est : $result";
?>
