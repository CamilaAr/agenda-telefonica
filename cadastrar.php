<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-4">Cadastrar Contato</h2>
    <form action="salvar_contato.php" method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="idade" class="form-label">Idade:</label>
            <input type="number" class="form-control" name="idade">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" class="form-control" name="telefone[]" required>
            <button type="button" onclick="adicionarTelefone()" class="btn btn-secondary mt-2">Adicionar Telefone</button>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

<script>
function adicionarTelefone() {
    let container = document.createElement("div");
    container.classList.add("mb-3");
    container.innerHTML = `<input type="text" class="form-control" name="telefone[]" required>`;
    document.querySelector("form").appendChild(container);
}
</script>
</body>
</html>
