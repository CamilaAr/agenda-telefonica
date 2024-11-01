<?php
include 'config.php';

$id = $_GET['id'];

// Carregar dados do contato
$stmt = $pdo->prepare("SELECT * FROM Contato WHERE ID = ?");
$stmt->execute([$id]);
$contato = $stmt->fetch();

if (!$contato) {
    echo "Contato não encontrado.";
    exit;
}

// Carregar números de telefone associados ao contato
$stmt = $pdo->prepare("SELECT * FROM Telefone WHERE IDCONTATO = ?");
$stmt->execute([$id]);
$telefones = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-4">Editar Contato</h2>
    <form action="salvar_edicao.php" method="post">
        <input type="hidden" name="id" value="<?php echo $contato['ID']; ?>">
        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $contato['NOME']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="idade" class="form-label">Idade:</label>
            <input type="number" class="form-control" name="idade" value="<?php echo $contato['IDADE']; ?>">
        </div>
        
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefones:</label>
            <?php foreach ($telefones as $telefone): ?>
                <div class="d-flex mb-2">
                    <input type="hidden" name="telefone_ids[]" value="<?php echo $telefone['ID']; ?>">
                    <input type="text" class="form-control me-2" name="telefones[]" value="<?php echo $telefone['NUMERO']; ?>" required>
                    <button type="button" onclick="removerTelefone(this)" class="btn btn-danger btn-sm">Remover</button>
                </div>
            <?php endforeach; ?>
            <button type="button" onclick="adicionarTelefone()" class="btn btn-secondary mt-2">Adicionar Telefone</button>
        </div>
        
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>

<script>
function adicionarTelefone() {
    let container = document.createElement("div");
    container.classList.add("d-flex", "mb-2");
    container.innerHTML = `
        <input type="hidden" name="telefone_ids[]" value="">
        <input type="text" class="form-control me-2" name="telefones[]" required>
        <button type="button" onclick="removerTelefone(this)" class="btn btn-danger btn-sm">Remover</button>`;
    document.querySelector("form").insertBefore(container, document.querySelector("form button[type=submit]"));
}

function removerTelefone(button) {
    button.parentElement.remove();
}
</script>
</body>
</html>
