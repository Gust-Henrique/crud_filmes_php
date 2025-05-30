<?php
require_once 'conexao.php';

$sql = "SELECT * FROM filmes";
$consulta = $conexao->query($sql);
$filmes = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Filmes</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f2f2f2; }
        a { text-decoration: none; color: blue; }
    </style>
</head>
<body>
    <h1>Catálogo de Filmes</h1>

    <p><a href="criar.php">Adicionar novo filme</a></p>

    <?php if (count($filmes) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Diretor</th>
                    <th>Ano</th>
                    <th>Gênero</th>
                    <th>Avaliação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filmes as $filme): ?>
                    <tr>
                        <td><?= htmlspecialchars($filme['titulo']) ?></td>
                        <td><?= htmlspecialchars($filme['diretor']) ?></td>
                        <td><?= $filme['ano_lancamento'] ?></td>
                        <td><?= htmlspecialchars($filme['genero']) ?></td>
                        <td><?= $filme['avaliacao'] ?? '-' ?></td>
                        <td>
                            <a href="editar.php?id=<?= $filme['id'] ?>">Editar</a> |
                            <a href="deletar.php?id=<?= $filme['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este filme?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum filme cadastrado ainda.</p>
    <?php endif; ?>
</body>
</html>
