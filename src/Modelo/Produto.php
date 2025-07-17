<?php

class produto
{
    private int $id;
    private string $title;
    private string $nome;
    private string $descricao;
    private string $imagem;
    private float $preco;

    public function __construct(int $id, string $title, string $nome, string $descricao, string $imagem, float $preco)
    {
        $this->id = $id;
        $this->title = $title;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->preco = $preco;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getImagem(): string
    {
        return $this->imagem;
    }
    
    public function getPreco(): float
    {
        return $this->preco;
    }

    public function getPrecoFormatado(): string
    {
        return "R$ " . number_format($this->preco, 2);
    }

}