<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Récupérer les données envoyées
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // Chemin du fichier JSON
    $file = 'utilisateur.json';
    
    // Lire le contenu existant
    if (file_exists($file)) {
        $existing = json_decode(file_get_contents($file), true);
        if (!is_array($existing)) {
            $existing = [];
        }
    } else {
        $existing = [];
    }
    
    // Ajouter les nouvelles données
    $existing[] = $data;
    
    // Sauvegarder dans le fichier
    if (file_put_contents($file, json_encode($existing, JSON_PRETTY_PRINT))) {
        echo json_encode(['success' => true, 'message' => 'Données sauvegardées']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'écriture']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Aucune données reçues']);
}
?>