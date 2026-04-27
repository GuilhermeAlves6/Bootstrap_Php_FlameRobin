<?php
// code.php

// 1. Carrega a configuração do Firebird
$config = require 'config/database.php';
$dbConfig = $config['firebird'];

try {
    // 2. Conecta ao Firebird
    $dsn = "firebird:dbname={$dbConfig['host']}/{$dbConfig['port']}:{$dbConfig['database']};charset={$dbConfig['charset']}";
    $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 3. Processa o formulário
    if (isset($_POST['save_data'])) {
        $name  = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $phone = $_POST['phone'] ?? null;

        if ($name && $email) {
            $sql = "INSERT INTO users (name, email, phone) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$name, $email, $phone]);

            if ($result) {
                echo "<h1>Dados salvos com sucesso no Firebird!</h1>";
                echo "<a href='index.php'>Voltar para o formulário</a>";
            }
        } else {
            echo "Por favor, preencha nome e email.";
        }
    }
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
