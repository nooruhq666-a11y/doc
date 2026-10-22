<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$jsonFile = 'utilisateur.json';

if (file_exists($jsonFile)) {
    $content = file_get_contents($jsonFile);
    // On renvoie directement le contenu (qui est déjà un tableau)
    echo $content;
} else {
    echo json_encode([]);
}
?>