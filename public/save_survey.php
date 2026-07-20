<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];

// Check ob Daten über das Formular (POST) kamen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // DB einbinden
    require_once __DIR__ . '/../private/db_connect.php';

    // --- DATEN ALS JSON SPEICHERN ---
    
    // Benutzername, Timestamp und Response in ein Array
    $survey_data = [
        'username' => $username,
        'timestamp' => date('Y-m-d H:i:s'),
        'answers' => $_POST 
    ];

    // Speicherort
    $results_dir = __DIR__ . '/../private/results';
    
    // Falls Ordner nicht existiert, erstellen wir ihn
    if (!is_dir($results_dir)) {
        mkdir($results_dir, 0777, true);
    }
    
    // Dateinamen generieren: Username wird Sonderzeichen gefiltert
    $safe_username = preg_replace('/[^a-zA-Z0-9_-]/', '_', $username);
    $filename = $results_dir . '/survey_' . $safe_username . '_' . time() . '.json';
    
    // Daten in lesbaren Format in Datei schreiben
    file_put_contents($filename, json_encode($survey_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));


    // --- DATENBANK UPDATE (TEILNAHME SPERREN) ---
    
    // hat_teilgenommen auf 1 setzen
    $stmt = $pdo->prepare("UPDATE users SET hat_teilgenommen = 1 WHERE username = :username");
    $stmt->execute(['username' => $username]);


    // --- LOGOUT ---
    
    // Session zerstören
    session_unset();
    session_destroy();
    
} else {
    // Zugang auf survey.php ohne Formular sperren
    header("Location: survey.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vielen Dank!</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="login-box" style="text-align: center; max-width: 500px;">
        <h2 style="color: var(--accent-color); font-size: 32px; margin-bottom: 10px;">Vielen Dank! 🎉</h2>
        <p style="margin-bottom: 25px; line-height: 1.6; font-size: 16px;">
            Deine Antworten wurden erfolgreich übermittelt.
        </p>
        <p style="color: var(--text-secondary); font-size: 14px;">
            Du kannst dieses Browserfenster nun einfach schließen.
        </p>
    </div>

</body>
</html>