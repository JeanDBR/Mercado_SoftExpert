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

    public function retornaProdutos()
    {
        $retorno = [];
        $conn = new Conexao();
        $objProduto = new Produto();
        $conn = $conn->AbrirConexao();
        $stmt = $conn->prepare("SELECT 
                                    prod.*, 
                                    tipprod.tipprod_juros
                                FROM tb_produto prod
                                JOIN tb_tipoproduto tipprod on tipprod.tipprod_id = prod.tipprod_id");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        foreach ($result as $item) {
            $objProduto = $item;
            array_push($retorno, $objProduto);
        }
        return $retorno;
    }
}
