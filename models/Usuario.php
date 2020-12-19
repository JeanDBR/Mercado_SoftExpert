<?php

class Usuario {
    public $Usu_id;
    public $Usu_Nome;
    public $Usu_Login;
    public $Usu_Email;
    public $Usu_Senha;
    public $Sta_id;
    public $Usu_DataCriacao;

    function __construct()
    {
        
    }

    function setUsu_id($Usu_id){
        $this->Usu_id = $Usu_id;
    }

    function getUsu_id(){
        return $this->Usu_id;
    }

    function setUsu_Nome($Usu_Nome){
        $this->Usu_Nome = $Usu_Nome;
    }

    function getUsu_Nome(){
        return $this->Usu_Nome;
    }

    function setUsu_Login($Usu_Login){
        $this->Usu_Login = $Usu_Login;
    }

    function getUsu_Login(){
        return $this->Usu_Login;
    }

    function setUsu_Email($Usu_Email){
        $this->Usu_Email = $Usu_Email;
    }

    function getUsu_Email(){
        return $this->Usu_Email;
    }

    function setUsu_Senha($Usu_Senha){
        $this->Usu_Senha = $Usu_Senha;
    }

    function getUsu_Senha(){
        return $this->Usu_Senha;
    }

    function setSta_id($Sta_id){
        $this->Sta_id = $Sta_id;
    }

    function getSta_id(){
        return $this->Sta_id;
    }

    function setUsu_DataCriacao($Usu_DataCriacao){
        $this->Usu_DataCriacao = $Usu_DataCriacao;
    }

    function getUsu_DataCriacao(){
        return $this->Usu_DataCriacao;
    }
}