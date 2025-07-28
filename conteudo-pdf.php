<?php

require_once 'src/conexao-db.php';
require_once 'src/Modelo/Produto.php';
require_once 'src/Repositorio/ProdutoRepositorio.php';

$produtosRepositorio = new ProdutoRepositorio($pdo);
$todosOsProdutos = $produtosRepositorio->buscarTodos();

function asset($path)
{
    return '/' . ltrim($path, '/');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos</title>

    <style>
        table{
            width: 90%;
            margin: auto 0;
        }
        table, th, td{
            border: 1px solid #000;
        }

        table th{
            padding: 11px 0 11px;
            font-weight: bold;
            font-size: 18px;
            text-align: left;
            padding: 8px;
        }

        table tr{
            border: 1px solid #000;
        }

        table td{
            font-size: 18px;
            padding: 8px;
        }
        .container-admin-banner h1{
            margin-top: 40px;
            font-size: 30px;
        }
    </style>
</head>
<body> 
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Tipo</th>
                <th>Descricão</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todosOsProdutos as $produto): ?>
                <tr>
                    <td><?= $produto->getNome(); ?></td>
                    <td><?= $produto->getTipo(); ?></td>
                    <td><?= $produto->getDescricao(); ?></td>
                    <td><?= $produto->getPrecoFormatado(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </body>
</html>