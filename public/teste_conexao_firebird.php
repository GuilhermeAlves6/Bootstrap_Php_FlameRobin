<?php
// Configurações (Baseadas no seu array)
$host     = 'localhost';
$port     = '3050'; // Sua porta customizada
$database = 'C:\\database\\BANCO.FDB';
$user     = 'SYSDBA';
$pass     = 'masterkey';

// No Firebird, o DSN (Data Source Name) tem um formato específico
$dsn = "firebird:dbname=$host/$port:$database;charset=UTF8";

try {
    $conn = new PDO($dsn, $user, $pass);

    // Configura o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h1>Sucesso!</h1>";
    echo "O PHP conseguiu se conectar ao Firebird via FlameRobin na porta $port.<br>";
    echo "Arquivo acessado: $database";
} catch (PDOException $e) {
    echo "<h1>Erro na conexão com Firebird:</h1>";
    echo "<p style='color:red;'>" . $e->getMessage() . "</p>";

    echo "<h3>Dicas para resolver:</h3>";
    echo "<ul>
            <li>Verifique se a extensão <b>php_pdo_firebird</b> está ativa no seu php.ini.</li>
            <li>Certifique-se que o serviço do Firebird está rodando na porta $port.</li>
            <li>Verifique se o caminho do banco está correto e o PHP tem permissão de leitura na pasta.</li>
          </ul>";
}
