<?php
include 'config.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM Contato WHERE ID = ?");
$stmt->execute([$id]);

file_put_contents('exclusao_log.txt', "Contato ID $id excluído em " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

header("Location: index.php");
