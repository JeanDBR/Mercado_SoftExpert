<?php

header('Content-type: application/json');
include_once "../dao/daoTipoProduto.php";
include_once "../models/TipoProduto.php";

if (isset($_GET["func"])) {
    $funcao =  isset($_GET["func"]) ? trim($_GET["func"]) : null;
    $tipoproduto = isset($_POST["tipoproduto"]) ? json_decode($_POST["tipoproduto"]) : null;

    switch ($funcao) {
        case "retornaTiposProduto":
            echo json_encode(retornaTiposProduto());
            break;
            case "cadastrarTipoProduto":
                $objTipoProduto = carregarTipoProduto($tipoproduto);
                if (cadastrarTipoProduto($objTipoProduto)) {
                    $retorno = array(
                        $tipo = "success",
                        $tituloRetorno = "Tipo de produto cadastrado com sucesso!",
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

function retornaTiposProduto(){
    $daoTipoProduto = new DAOTipoProduto();
    return $daoTipoProduto->retornaTiposProduto();
}

function cadastrarTipoProduto($objTipoProduto)
{
    $daoTipoProduto = new DAOTipoProduto();
    return $daoTipoProduto->cadastrarTipoProduto($objTipoProduto);
}

function carregarTipoProduto($tipoproduto)
{
    $tipprod = new TipoProduto();
    $tipprod->setTipProd_Descricao($tipoproduto->tipprod_descricao);
    $tipprod->setTipProd_Juros($tipoproduto->tipprod_juros);
    $tipprod->setUsu_id($tipoproduto->usu_id);
    return $tipprod;
}
