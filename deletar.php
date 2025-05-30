<?php
require_once 'conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do filme não informado.");
}

$id = $_GET['id'];

$sql = "DELETE FROM filmes WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

header("Location: index.php");
exit;
?>
