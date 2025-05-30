<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $diretor = $_POST['diretor'] ?? '';
    $ano_lancamento = $_POST['ano_lancamento'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $avaliacao = $_POST['avaliacao'] ?? null;

    if ($titulo && $diretor && $ano_lancamento && $genero) {
        $sql = "INSERT INTO filmes (titulo, diretor, ano_lancamento, genero, avaliacao)
                VALUES (:titulo, :diretor, :ano_lancamento, :genero, :avaliacao)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':diretor', $diretor);
        $stmt->bindParam(':ano_lancamento', $ano_lancamento);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':avaliacao', $avaliacao);

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
    <title>Adicionar Filme</title>
</head>
<body>
    <h1>Adicionar Novo Filme</h1>

    <?php if (!empty($mensagem_erro)): ?>
        <p style="color: red;"><?= $mensagem_erro ?></p>
    <?php endif; ?>

    <form action="criar.php" method="post">
        <p>
            <label for="titulo">Título:</label><br>
            <input type="text" name="titulo" id="titulo" required>
        </p>
        <p>
            <label for="diretor">Diretor:</label><br>
            <input type="text" name="diretor" id="diretor" required>
        </p>
        <p>
            <label for="ano_lancamento">Ano de Lançamento:</label><br>
            <input type="number" name="ano_lancamento" id="ano_lancamento" required>
        </p>
        <p>
            <label for="genero">Gênero:</label><br>
            <input type="text" name="genero" id="genero" required>
        </p>
        <p>
            <label for="avaliacao">Avaliação (0.0 a 10.0):</label><br>
            <input type="number" name="avaliacao" id="avaliacao" step="0.1" min="0" max="10">
        </p>
        <p>
            <button type="submit">Salvar Filme</button>
            <a href="index.php">Cancelar</a>
        </p>
    </form>
</body>
</html>
