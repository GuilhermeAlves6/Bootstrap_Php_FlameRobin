<?php
session_start();

$config = require 'config/database.php';
$dbConfig = $config['firebird'];

try {
    $dsn = "firebird:dbname={$dbConfig['host']}/{$dbConfig['port']}:{$dbConfig['database']};charset={$dbConfig['charset']}";
    $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // --- SALVAR (CREATE) ---
    if (isset($_POST['save_data'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $query = "INSERT INTO users (name, email, phone) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $result = $stmt->execute([$name, $email, $phone]);

        if ($result) {
            $_SESSION['status'] = "Cadastrado com sucesso!";
            header("Location: index.php");
            exit(0);
        }
    }

    // --- ATUALIZAR (UPDATE) ---
    if (isset($_POST['update_data'])) {
        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $query = "UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $result = $stmt->execute([$name, $email, $phone, $user_id]);

        if ($result) {
            $_SESSION['status'] = "Atualizado com sucesso!";
            header("Location: index.php");
            exit(0);
        }
    }

    // --- DELETAR (DELETE) ---
    if (isset($_POST['delete_data'])) {
        $user_id = $_POST['user_id'];

        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $result = $stmt->execute([$user_id]);

        if ($result) {
            $_SESSION['status'] = "Registro excluído!";
            header("Location: index.php");
            exit(0);
        }
    }
} catch (PDOException $e) {
    $_SESSION['status'] = "Erro: " . $e->getMessage();
    header("Location: index.php");
    exit(0);
}
