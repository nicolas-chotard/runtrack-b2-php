<?php
function my_str_reverse($str) {
    if (!isset($str)) {
        return "Chaîne non définie.";
    }

    $reversed = '';
    $length = strlen($str);

    for ($i = $length - 1; $i >= 0; $i--) {
        $reversed .= $str[$i];
    }

    return $reversed;
}


$chaine = "La Plateforme";
$resultat = my_str_reverse($chaine);
var_dump($resultat);
?>
