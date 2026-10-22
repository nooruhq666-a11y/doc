<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$jsonFile = 'utilisateur.json';

// Lire le fichier actuel
if (!file_exists($jsonFile)) {
    echo json_encode(['success' => false, 'message' => 'Fichier inexistant']);
    exit;
}

$content = file_get_contents($jsonFile);
$data = json_decode($content, true);

// Vérifier que c'est un tableau
if (!is_array($data)) {
    $data = [];
}

// Récupérer les données POST
$input = json_decode(file_get_contents('php://input'), true);
$userId = $input['userId'] ?? null;
$newStatus = $input['status'] ?? null;

if (!$userId || !$newStatus) {
    echo json_encode(['success' => false, 'message' => 'Données manquantes']);
    exit;
}

$found = false;
foreach ($data as &$user) {
    if ($user['id'] === $userId) {
        $user['statut'] = $newStatus;
        $found = true;
        break;
    }
}

if ($found) {
    file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(['success' => true, 'message' => 'Statut mis à jour']);
} else {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non trouvé']);
}
?>