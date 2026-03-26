<?php
$host = 'ep-fragrant-mode-amj94hw9-pooler.c-5.us-east-1.aws.neon.tech';
$db   = 'neondb;endpoint=ep-fragrant-mode-amj94hw9-pooler';
$user = 'neondb_owner';
$pass = 'npg_NcSxl1PT8vaC';

$dsn = "pgsql:host=$host;port=5432;dbname=$db;sslmode=require";

echo "Testing DSN: $dsn\n";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "SUCCESS!\n";
} catch (Exception $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
}
