<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agenda Telefônica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-4">Agenda Telefônica</h2>

    <!-- Botão para Adicionar Contato -->
    <div class="d-flex justify-content-between mb-3">
        <form action="index.php" method="get" class="d-flex w-75">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar por nome ou número">
            <button type="submit" class="btn btn-primary ms-2">Pesquisar</button>
        </form>
        <a href="cadastrar.php" class="btn btn-success">Adicionar Contato</a>
    </div>

    <!-- Tabela de Contatos -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>Telefone(s)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'config.php';
            $search = $_GET['search'] ?? '';

            $stmt = $pdo->prepare("
                SELECT c.ID, c.NOME, c.IDADE, GROUP_CONCAT(t.NUMERO SEPARATOR ', ') AS TELEFONES
                FROM Contato c
                LEFT JOIN Telefone t ON c.ID = t.IDCONTATO
                WHERE c.NOME LIKE ? OR t.NUMERO LIKE ?
                GROUP BY c.ID
            ");
            $stmt->execute(["%$search%", "%$search%"]);

            while ($row = $stmt->fetch()) {
                echo "<tr>
                        <td>{$row['NOME']}</td>
                        <td>{$row['IDADE']}</td>
                        <td>{$row['TELEFONES']}</td>
                        <td>
                            <a href='editar.php?id={$row['ID']}' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='excluir.php?id={$row['ID']}' class='btn btn-danger btn-sm'>Excluir</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
