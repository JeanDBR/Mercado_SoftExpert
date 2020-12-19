<?php

class Status {
    public $Sta_id;
    public $Sta_Descricao;
    public $Sta_DataCriacao;

    function __construct()
    {
        
    }

    function setSta_id($Sta_id){
        $this->Sta_id = $Sta_id;
    }

    function getSta_id(){
        return $this->Sta_id;
    }

    function setSta_Descricao($Sta_Descricao){
        $this->Sta_Descricao = $Sta_Descricao;
    }

    function getSta_Descricao(){
        return $this->Sta_Descricao;
    }

    function setSta_DataCriacao($Sta_DataCriacao){
        $this->Sta_DataCriacao = $Sta_DataCriacao;
    }

    function getSta_DataCriacao(){
        return $this->Sta_DataCriacao;
    }
}