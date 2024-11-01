<?php
include 'config.php';

$nome = $_POST['nome'];
$idade = $_POST['idade'];
$telefones = $_POST['telefone'];

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("INSERT INTO Contato (NOME, IDADE) VALUES (?, ?)");
    $stmt->execute([$nome, $idade]);
    $idContato = $pdo->lastInsertId();

    $stmtTelefone = $pdo->prepare("INSERT INTO Telefone (IDCONTATO, NUMERO) VALUES (?, ?)");
    foreach ($telefones as $telefone) {
        $stmtTelefone->execute([$idContato, $telefone]);
    }

    $pdo->commit();
    header("Location: index.php");
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Erro: " . $e->getMessage();
}
?>
