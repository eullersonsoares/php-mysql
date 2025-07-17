<?php

class ProdutoRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function opcoesCafe(): array
    {
        $sql1 = 'SELECT * FROM produtos WHERE tipo = "Café" ORDER BY preco ASC';
        
        try {
            $stmt1 = $this->pdo->prepare($sql1);
            $stmt1->execute();

            $produtosCafe = $stmt1->fetchAll();

            $produtosCafe = array_map(function ($produto) {
                return new Produto(
                    $produto['id'],
                    $produto['tipo'],
                    $produto['nome'],
                    $produto['descricao'],
                    $produto['imagem'],
                    (float)$produto['preco']
                );
            }, $produtosCafe);

            return $produtosCafe;

        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
            exit;
        }
    }

    public function opcoesAlmoco(): array
    {
        $sql2 = 'SELECT * FROM produtos WHERE tipo = "Almoço" ORDER BY preco ASC';

        try {
            $stmt2 = $this->pdo->prepare($sql2);
            $stmt2->execute();

            $produtosAlmoco = $stmt2->fetchAll();

            $produtosAlmoco = array_map(function ($produto) {
                return new Produto(
                    $produto['id'],
                    $produto['tipo'],
                    $produto['nome'],
                    $produto['descricao'],
                    $produto['imagem'],
                    (float)$produto['preco']
                );
            }, $produtosAlmoco);

            return $produtosAlmoco;
        }catch(PDOException $err) {
            echo "Erro ao buscar produtos " . $err->getMessage();
        }
    }
}