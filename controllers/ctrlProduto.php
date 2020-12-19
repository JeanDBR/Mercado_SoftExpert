<?php

header('Content-type: application/json');
include_once "../dao/daoProduto.php";
include_once "../models/Produto.php";

if (isset($_GET["func"])) {
    $funcao =  isset($_GET["func"]) ? trim($_GET["func"]) : null;
    $produto = isset($_POST["produto"]) ? json_decode($_POST["produto"]) : null;

    switch ($funcao) {
        case "cadastrarProduto":
            $objProduto = carregarProduto($produto);
            if (cadastrarProduto($objProduto)) {
                $retorno = array(
                    $tipo = "success",
                    $tituloRetorno = "Produto cadastrado com sucesso!",
                    $timer = 3000,
                );
            } else {
                $retorno = array(
                    $tipo = "error",
                    $tituloRetorno = "Ocorreu um erro ao inserir!",
                    $timer = 10000,
                    $descricaoRetorno = "Verifique os dados informados e se estiver tudo correto, entre em contato com o suporte!!"
                );
            }
            echo json_encode($retorno);
            break;
        default:
            break;
    }
}

function cadastrarProduto($objProduto)
{
    $daoProduto = new DAOProduto();
    return $daoProduto->cadastrarProduto($objProduto);
}

function carregarProduto($produto)
{
    $prod = new Produto();
    $prod->setProd_Descricao($produto->prod_descricao);
    $prod->setProd_ValorCusto($produto->prod_valorcusto);
    $prod->setProd_ValorVenda($produto->prod_valorvenda);
    $prod->setTipProd_id($produto->tipprod_id);
    $prod->setUsu_id($produto->usu_id);
    return $prod;
}
