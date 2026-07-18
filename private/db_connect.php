<?php
// Pfad zur Datenbank
$dbPath = __DIR__ . '/database.sqlite';

try {
    // Verbindung herstellen
    $pdo = new PDO("sqlite:" . $dbPath);
    
    // Exceptions aktivieren
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Datenbank-Antworten als saubere Arrays returnen
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Fehler: Datenbankverbindung konnte nicht hergestellt werden.");
}
?>