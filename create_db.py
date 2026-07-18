import sqlite3
import json
import os

# Pfade definieren
db_path = os.path.join('private', 'database.sqlite')
json_path = 'users.json'

print("Starte Datenbank-Generierung...")

# JSON-Datei einlesen
try:
    with open(json_path, 'r', encoding='utf-8') as f:
        users_data = json.load(f)
except FileNotFoundError:
    print(f"Fehler: Die Datei '{json_path}' wurde nicht gefunden.")
    exit(1)

# Verbindung zur SQLite-DB herstellen (Erstellt Datei 'database.sqlite' automatisch in /private)
conn = sqlite3.connect(db_path)
cursor = conn.cursor()

# Tabelle 'users' erstellen
cursor.execute('''
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password_hash TEXT NOT NULL,
    hat_teilgenommen BOOLEAN NOT NULL DEFAULT 0
)
''')

# Tabelle leeren falls Skript mehrfach gestartet wird (verhindert doppelete Einträge)
cursor.execute('DELETE FROM users')

# Benutzer aus JSON in DB einfügen
inserted_count = 0

for username, data in users_data.items():
    password_hash = data.get('password_hash', '')
    hat_teilgenommen = data.get('hat_teilgenommen', False)
    
    # Daten in Tabelle schreiben
    cursor.execute('''
        INSERT INTO users (username, password_hash, hat_teilgenommen)
        VALUES (?, ?, ?)
    ''', (username, password_hash, hat_teilgenommen))
    
    inserted_count += 1

# Änderungen speichern, Verbindung schließen
conn.commit()
conn.close()

print(f"Erfolg! {inserted_count} Benutzer wurden in die Datenbank '{db_path}' importiert.")