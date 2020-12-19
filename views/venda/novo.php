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
        <form class="row g-3 needs-validation" id="formVenda" novalidate>
            <div class="row col-12">
                <div class="col-6">
                    <label for="txtDescProduto" class="form-label">Produto</label>
                    <select class="form-control" id="selectProduto"></select>
                </div>
                <div class="col-3">
                    <label for="txtVlrCustoProduto" class="form-label">Valor Custo <small><strong>*</strong></small></label>
                    <input type="text" class="form-control maskmoney" id="txtVlrCustoProduto" placeholder="Ex: R$ 1,23" required>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo corretamente!
                    </div>
                </div>
                <div class="col-3">
                    <label for="txtVlrVendaProduto" class="form-label">Valor Venda <small><strong>*</strong></small></label>
                    <input type="text" class="form-control maskmoney" id="txtVlrVendaProduto" placeholder="Ex: R$ 4,56" required>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo corretamente!
                    </div>
                </div>
            </div>
            <div class="row col-12 pt-2">
                <div class="col-3">
                    <label for="selectTipoProduto" class="form-label">Tipo do Produto <small><strong>*</strong></small></label>
                    <select class="form-control" id="selectTipoProduto" required>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, escolha uma opção!
                    </div>
                </div>
                <div class="col-3">
                    <label class="form-label">% Juros</label>
                    <input type="text" class="form-control" id="txtPercJuros" placeholder="Ex: 2,34%" readonly />
                </div>
            </div>
            <div class="col-12 pt-2">
                <button class="btn btn-secondary" type="reset">Limpar</button>
                <button class="btn btn-primary float-right" type="submit">Salvar</button>
            </div>
        </form>
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
                _listaProdutos = data;
                let htmlOption;
                $("#selectProduto").html('');
                htmlOption = `<option value="" disabled selected>Escolha um produto</option>`;
                _listaProdutos.forEach(produto => {
                    htmlOption += `<option value="${produto.prod_id}">${produto.prod_descricao}</option>`;
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