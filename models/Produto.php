<?php

class Produto {
    public $Prod_id;
    public $Prod_Descricao;
    public $Prod_ValorCusto;
    public $Prod_ValorVenda;
    public $TipProd_id;
    public $Prod_DataCriacao;
    public $Sta_id;
    public $Usu_id;

    function __construct()
    {
        
    }

    function setProd_id($Prod_id){
        $this->Prod_id = $Prod_id;
    }

    function getProd_id(){
        return $this->Prod_id;
    }

    function setProd_Descricao($Prod_Descricao){
        $this->Prod_Descricao = $Prod_Descricao;
    }

    function getProd_Descricao(){
        return $this->Prod_Descricao;
    }

    function setProd_ValorCusto($Prod_ValorCusto){
        $this->Prod_ValorCusto = $Prod_ValorCusto;
    }

    function getProd_ValorCusto(){
        return $this->Prod_ValorCusto;
    }

    function setProd_ValorVenda($Prod_ValorVenda){
        $this->Prod_ValorVenda = $Prod_ValorVenda;
    }

    function getProd_ValorVenda(){
        return $this->Prod_ValorVenda;
    }

    function setTipProd_id($TipProd_id){
        $this->TipProd_id = $TipProd_id;
    }

    function getTipProd_id(){
        return $this->TipProd_id;
    }

    function setProd_DataCriacao($Prod_DataCriacao){
        $this->Prod_DataCriacao = $Prod_DataCriacao;
    }

    function getProd_DataCriacao(){
        return $this->Prod_DataCriacao;
    }

    function setSta_id($Sta_id){
        $this->Sta_id = $Sta_id;
    }

    function getSta_id(){
        return $this->Sta_id;
    }

    function setUsu_id($Usu_id){
        $this->Usu_id = $Usu_id;
    }

    function getUsu_id(){
        return $this->Usu_id;
    }
}