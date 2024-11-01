<?php
include 'config.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$telefones = $_POST['telefones'];
$telefone_ids = $_POST['telefone_ids'];

try {
    $pdo->beginTransaction();

    // Atualizar informações do contato
    $stmt = $pdo->prepare("UPDATE Contato SET NOME = ?, IDADE = ? WHERE ID = ?");
    $stmt->execute([$nome, $idade, $id]);

    // Atualizar telefones existentes e inserir novos telefones
    $stmtUpdate = $pdo->prepare("UPDATE Telefone SET NUMERO = ? WHERE ID = ?");
    $stmtInsert = $pdo->prepare("INSERT INTO Telefone (IDCONTATO, NUMERO) VALUES (?, ?)");

    foreach ($telefones as $index => $numero) {
        $telefoneId = $telefone_ids[$index];
        if ($telefoneId) {
            // Atualiza telefone existente
            $stmtUpdate->execute([$numero, $telefoneId]);
        } else {
            // Insere novo telefone
            $stmtInsert->execute([$id, $numero]);
        }
    }

    // Remover números de telefone excluídos
    $telefonesExistentes = array_filter($telefone_ids);
    if (!empty($telefonesExistentes)) {
        $placeholders = implode(',', array_fill(0, count($telefonesExistentes), '?'));
        $stmtDelete = $pdo->prepare("DELETE FROM Telefone WHERE IDCONTATO = ? AND ID NOT IN ($placeholders)");
        $stmtDelete->execute(array_merge([$id], $telefonesExistentes));
    } else {
        // Se não há telefones existentes, remove todos os telefones associados
        $stmtDelete = $pdo->prepare("DELETE FROM Telefone WHERE IDCONTATO = ?");
        $stmtDelete->execute([$id]);
    }

    $pdo->commit();
    echo "Contato atualizado com sucesso!";
    header("Location: index.php");
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Erro: " . $e->getMessage();
}
?>
