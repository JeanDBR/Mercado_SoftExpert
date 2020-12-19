<?php

class TipoProduto {
    public $TipProd_id;
    public $TipProd_Descricao;
    public $TipProd_Juros;
    public $TipProd_DataCriacao;
    public $Sta_id;
    public $Usu_id;

    function __construct()
    {
        
    }

    function setTipProd_id($TipProd_id){
        $this->TipProd_id = $TipProd_id;
    }

    function getTipProd_id(){
        return $this->TipProd_id;
    }

    function setTipProd_Descricao($TipProd_Descricao){
        $this->TipProd_Descricao = $TipProd_Descricao;
    }

    function getTipProd_Descricao(){
        return $this->TipProd_Descricao;
    }

    function setTipProd_Juros($TipProd_Juros){
        $this->TipProd_Juros = $TipProd_Juros;
    }

    function getTipProd_Juros(){
        return $this->TipProd_Juros;
    }

    function setTipProd_DataCriacao($TipProd_DataCriacao){
        $this->TipProd_DataCriacao = $TipProd_DataCriacao;
    }

    function getTipProd_DataCriacao(){
        return $this->TipProd_DataCriacao;
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