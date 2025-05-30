<?php
require_once 'conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do filme não informado.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM filmes WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$filme = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$filme) {
    die("Filme não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $diretor = $_POST['diretor'] ?? '';
    $ano_lancamento = $_POST['ano_lancamento'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $avaliacao = $_POST['avaliacao'] ?? null;

    if ($titulo && $diretor && $ano_lancamento && $genero) {
        $sql = "UPDATE filmes SET 
                    titulo = :titulo, 
                    diretor = :diretor, 
                    ano_lancamento = :ano_lancamento, 
                    genero = :genero, 
                    avaliacao = :avaliacao
                WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':diretor', $diretor);
        $stmt->bindParam(':ano_lancamento', $ano_lancamento);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':avaliacao', $avaliacao);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: index.php");
        exit;
    } else {
        $mensagem_erro = "Preencha todos os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Filme</title>
</head>
<body>
    <h1>Editar Filme</h1>

    <?php if (!empty($mensagem_erro)): ?>
        <p style="color: red;"><?= $mensagem_erro ?></p>
    <?php endif; ?>

    <form action="editar.php?id=<?= $id ?>" method="post">
        <p>
            <label for="titulo">Título:</label><br>
            <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($filme['titulo']) ?>" required>
        </p>
        <p>
            <label for="diretor">Diretor:</label><br>
            <input type="text" name="diretor" id="diretor" value="<?= htmlspecialchars($filme['diretor']) ?>" required>
        </p>
        <p>
            <label for="ano_lancamento">Ano de Lançamento:</label><br>
            <input type="number" name="ano_lancamento" id="ano_lancamento" value="<?= $filme['ano_lancamento'] ?>" required>
        </p>
        <p>
            <label for="genero">Gênero:</label><br>
            <input type="text" name="genero" id="genero" value="<?= htmlspecialchars($filme['genero']) ?>" required>
        </p>
        <p>
            <label for="avaliacao">Avaliação:</label><br>
            <input type="number" step="0.1" name="avaliacao" id="avaliacao" value="<?= $filme['avaliacao'] ?>">
        </p>
        <p>
            <button type="submit">Atualizar</button>
            <a href="index.php">Cancelar</a>
        </p>
    </form>
</body>
</html>
