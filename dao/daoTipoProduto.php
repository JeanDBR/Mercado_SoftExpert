<?php
include_once "../models/Conexao.php";

class DAOTipoProduto
{
    public static $conn;

    public function __construct()
    {
        //
    }

    public function retornaTiposProduto()
    {
        $retorno = [];
        $conn = new Conexao();
        $objTipoProduto = new TipoProduto();
        $conn = $conn->AbrirConexao();
        $stmt = $conn->prepare("SELECT * FROM tb_tipoproduto");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        foreach ($result as $item) {
            $objTipoProduto = $item;
            array_push($retorno, $objTipoProduto);
        }
        return $retorno;
    }

    public function cadastrarTipoProduto($objTipoProduto)
    {
        $conn = new Conexao();
        $conn = $conn->AbrirConexao();
        $stmt = $conn->prepare("INSERT INTO tb_tipoproduto(tipprod_descricao, tipprod_juros, 
        tipprod_datacriacao, sta_id, usu_id) VALUES (:tipprod_descricao, :tipprod_juros, CURRENT_TIMESTAMP, 
        (select sta_id from tb_status where sta_descricao = 'Ativo'), :usu_id)");
        $stmt->bindParam(':tipprod_descricao', $objTipoProduto->TipProd_Descricao, PDO::PARAM_STR);
        $stmt->bindParam(':tipprod_juros', $objTipoProduto->TipProd_Juros);
        $stmt->bindParam(':usu_id', $objTipoProduto->Usu_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
