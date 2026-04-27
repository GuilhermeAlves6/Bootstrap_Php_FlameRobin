<?php
// Exibir erros caso algo dê errado
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host     = '127.0.0.1'; // Use o IP para evitar problemas de DNS local
$port     = '3050';
$database = 'C:\\database\\BANCO.FDB';
$user     = 'SYSDBA';
$pass     = 'masterkey';

// Formato padrão para conexões Firebird via PDO
$dsn = "firebird:dbname=$host/$port:$database;charset=UTF8";

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2 style='color: green;'>✅ Conexão bem-sucedida!</h2>";
    echo "Conectado ao Firebird em: <b>$database</b> na porta <b>$port</b>";
} catch (PDOException $e) {
    echo "<h2 style='color: red;'>❌ Erro na conexão:</h2>";
    echo "<b>Mensagem:</b> " . $e->getMessage();
}
