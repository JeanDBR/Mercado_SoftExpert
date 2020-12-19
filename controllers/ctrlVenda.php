<?php

header('Content-type: application/json');

if (isset($_GET["func"])) {
    $funcao =  isset($_GET["func"]) ? trim($_GET["func"]) : null;

    switch ($funcao) {
        case "cadastrarVenda":
            break;
        default:
            break;
    }
}
