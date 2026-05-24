<?php
// api-token.php - Backend proxy untuk fetch token
// Deploy file ini di server Anda, kemudian panggil dari HTML

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

try {
    // Fetch dari mydeena.com
    $url = 'https://mydeena.com/70k3n.php';
    $response = @file_get_contents($url, false, stream_context_create([
        'http' => ['timeout' => 10],
        'ssl' => ['verify_peer' => false]
    ]));
    
    if ($response === false) {
        http_response_code(502);
        die(json_encode(['error' => 'Tidak bisa connect ke mydeena.com']));
    }
    
    // Decode dan return
    $data = json_decode($response);
    echo json_encode($data);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
