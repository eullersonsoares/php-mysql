<?php

require_once 'src/conexao-db.php';
require_once 'src/Modelo/Produto.php';
require_once 'src/Repositorio/ProdutoRepositorio.php';

$produtosRepositorio = new ProdutoRepositorio($pdo);
$produtosRepositorio->deletar($_POST["id"]);

header("Location: admin.php");
exit;
