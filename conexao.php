<?php
/*CREATE DATABASE catalogo_filmes CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE catalogo_filmes;

CREATE TABLE filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    diretor VARCHAR(255) NOT NULL,
    ano_lancamento INT NOT NULL,
    genero VARCHAR(100) NOT NULL,
    avaliacao DECIMAL(2,1) NULL
);*/ 


$servidor = 'localhost';
$banco = 'catalogo_filmes';
$usuario = 'root';
$senha = '';

try {
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha);
} catch (PDOException $erro) {
    die("Erro ao conectar ao banco de dados: " . $erro->getMessage());
}
?>
