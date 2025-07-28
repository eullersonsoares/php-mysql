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

            $produtosCafe = $this->formatarDados($stmt1->fetchAll());

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

            $produtosAlmoco = $this->formatarDados($stmt2->fetchAll());

            return $produtosAlmoco;
        }catch(PDOException $err) {
            echo "Erro ao buscar produtos " . $err->getMessage();
        }
    }

    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM produtos ORDER BY preco ASC";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $todosOsProdutos = $this->formatarDados($stmt->fetchAll());
            return $todosOsProdutos;

        } catch(PDOException $err) {
            echo "Não foi possível concluir a consulta " . $err->getMessage() . PHP_EOL;
            return [];
        }

        return [];
    }

    private function formatarDados(array $dados): array
    {
        $dados = array_map(function($produto) {
                return new Produto(
                    $produto['id'],
                    $produto['tipo'],
                    $produto['nome'],
                    $produto['descricao'],
                    $produto['imagem'],
                    (float)$produto['preco']
                );
        }, $dados);

        return $dados;
    }

    public function deletar(int $id): void
    {
        $sql = "DELETE FROM produtos WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    public function cadastrar(Produto $produto): void
    {
        $sql = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES (?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $produto->getTipo());
        $stmt->bindValue(2, $produto->getNome());
        $stmt->bindValue(3, $produto->getDescricao());
        $stmt->bindValue(4, $produto->getPreco());
        $stmt->bindValue(5, $produto->getImagem());
        $stmt->execute();
    }

    public function editar(produto $produto): void
    {
        $sql = "UPDATE produtos SET tipo = ?, nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $produto->getTipo());
        $stmt->bindValue(2, $produto->getNome());
        $stmt->bindValue(3, $produto->getDescricao());
        $stmt->bindValue(4, $produto->getPreco());
        $stmt->bindValue(5, $produto->getImagem());
        $stmt->bindValue(6, $produto->getId());

        $stmt->execute();
    }

    public function buscarProduto(int $id):produto
    {
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $produto = $stmt->fetch();

        return $this->formatarDados([$produto])[0];
    }
}