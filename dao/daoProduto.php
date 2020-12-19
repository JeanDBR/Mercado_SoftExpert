<?php
include_once "../models/Conexao.php";

class DAOProduto
{
    public static $conn;

    public function __construct()
    {
        //
    }

    public function cadastrarProduto($objProduto)
    {
        $conn = new Conexao();
        $conn = $conn->AbrirConexao();
        $stmt = $conn->prepare("INSERT INTO tb_Produto (prod_descricao, prod_valorcusto, prod_valorvenda, tipprod_id, prod_datacriacao, sta_id, usu_id) 
        VALUES (:prod_descricao, :prod_valorcusto, :prod_valorvenda, :tipprod_id, CURRENT_TIMESTAMP, (select sta_id from tb_status where sta_descricao = 'Ativo'), :usu_id)");
        $stmt->bindParam(':prod_descricao', $objProduto->Prod_Descricao, PDO::PARAM_STR);
        $stmt->bindParam(':prod_valorcusto', $objProduto->Prod_ValorCusto);
        $stmt->bindParam(':prod_valorvenda', $objProduto->Prod_ValorVenda);
        $stmt->bindParam(':tipprod_id', $objProduto->TipProd_id, PDO::PARAM_INT);
        $stmt->bindParam(':usu_id', $objProduto->Usu_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
