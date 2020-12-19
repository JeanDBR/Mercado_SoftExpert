<?php

include("../../index.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Venda - Mercado SoftExpert</title>
</head>

<body>
    <div class="container pt-3">
        <div class="row col-12">
            <div class="col-6">
                <label for="txtDescProduto" class="form-label">Produto</label>
                <select class="form-control" id="selectProduto"></select>
            </div>
            <div class="col-1">
                <label for="txtQtdProduto" class="form-label">Qtd</label>
                <input type="number" class="form-control" id="txtQtdProduto" min="1" value="1" required>
            </div>
            <div class="col-3 align-self-end">
                <button class="btn btn-primary btn-block">Adicionar</button>
            </div>
        </div>
        <div class="col-12 pt-2">
            <button class="btn btn-secondary" type="reset">Limpar</button>
            <button class="btn btn-success float-right" type="submit">Finalizar</button>
        </div>
    </div>
</body>
<script src="/js/script.js"></script>

<script>
    $(document).ready(function() {
        _listaProdutos = [];
        $("#menuVenda").addClass("active");
        retornaProdutos();

    });

    function retornaProdutos() {
        $.ajax({
            url: "../../controllers/ctrlProduto.php?func=retornaProdutos",
            method: 'GET',
            dataType: "json",
            success: function(data) {
                let htmlOption;
                $("#selectProduto").html('');
                htmlOption = `<option value="" disabled selected>Escolha um produto</option>`;
                data.forEach(produto => {
                    htmlOption += `<option value="${produto.prod_id}" data-vlrVenda="${produto.prod_valorvenda}" data-juros="${produto.tipprod_juros}">${produto.prod_descricao}</option>`;
                });
                $("#selectProduto").html(htmlOption);
            },
            error: function() {
                console.log("ERRO");
            }
        });
    }
</script>

</html>