<?php
session_start();
// Ajustado para 'includes' conforme sua estrutura de pastas
include('includes/header.php');

// Conexão com Firebird
$config = require 'config/database.php';
$dbConfig = $config['firebird'];
$dsn = "firebird:dbname={$dbConfig['host']}/{$dbConfig['port']}:{$dbConfig['database']};charset={$dbConfig['charset']}";

try {
    $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erro de conexão: " . $e->getMessage() . "</div>";
}
?>

<div class="modal fade" id="insertdata" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Novo Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3"><label>Nome</label><input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label>E-mail</label><input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label>Telefone</label><input type="text" name="phone" class="form-control"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" name="save_data" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editDataModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="code.php" method="POST">
                <input type="hidden" name="user_id" id="edit_id">
                <div class="modal-body">
                    <div class="mb-3"><label>Nome</label><input type="text" name="name" id="edit_name" class="form-control" required></div>
                    <div class="mb-3"><label>E-mail</label><input type="email" name="email" id="edit_email" class="form-control" required></div>
                    <div class="mb-3"><label>Telefone</label><input type="text" name="phone" id="edit_phone" class="form-control"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" name="update_data" class="btn btn-success">Atualizar Dados</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <?php if (isset($_SESSION['status'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <strong>Legal!</strong> <?= $_SESSION['status']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php unset($_SESSION['status']);
    endif; ?>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                Lista de Usuários
                <button type="button" class="btn btn-light float-end" data-bs-toggle="modal" data-bs-target="#insertdata">Adicionar Novo</button>
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM users ORDER BY id DESC";
                    $stmt = $pdo->query($query);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td><?= $row['ID']; ?></td>
                            <td><?= $row['NAME']; ?></td>
                            <td><?= $row['EMAIL']; ?></td>
                            <td><?= $row['PHONE']; ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info text-white editBtn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editDataModal"
                                    data-id="<?= $row['ID']; ?>"
                                    data-name="<?= $row['NAME']; ?>"
                                    data-email="<?= $row['EMAIL']; ?>"
                                    data-phone="<?= $row['PHONE']; ?>">Editar</button>

                                <form action="code.php" method="POST" class="d-inline">
                                    <input type="hidden" name="user_id" value="<?= $row['ID']; ?>">
                                    <button type="submit" name="delete_data" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este registro?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('edit_id').value = this.getAttribute('data-id');
                document.getElementById('edit_name').value = this.getAttribute('data-name');
                document.getElementById('edit_email').value = this.getAttribute('data-email');

                const phoneValue = this.getAttribute('data-phone');
                document.getElementById('edit_phone').value = (phoneValue && phoneValue !== "null") ? phoneValue : "";
            });
        });
    });
</script>