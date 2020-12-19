<?php
include("../../index.php"); //Menu
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Cadastro de Produto - Mercado SoftExpert</title>
</head>

<body>
    <div class="container pt-3">
        <div class="row col-12">
            <small class="form-text text-muted">Campos com * são de preenchimento obrigatório!</small> <label></label>
        </div>
        <hr />
        <form class="row g-3 needs-validation" id="formProduto" novalidate>
            <div class="row col-12">
                <div class="col-6">
                    <div class="row">
                        <div class="col-8">
                            <label for="txtDescProduto" class="form-label">Descrição <small><strong>*</strong></small></label>
                        </div>
                        <div class="col-4">
                            <label class="float-right"><small id="contador">100 carac. restantes</small></label>
                        </div>
                    </div>
                    <input type="text" class="form-control" maxlength="100" id="txtDescProduto" placeholder="Ex: Produto 01" required>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo corretamente!
                    </div>
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
    class Produto {
        constructor(prod_descricao, prod_valorcusto, prod_valorvenda, tipprod_id, usu_id) {
            this.prod_descricao = prod_descricao;
            this.prod_valorcusto = prod_valorcusto;
            this.prod_valorvenda = prod_valorvenda;
            this.tipprod_id = tipprod_id;
            this.usu_id = usu_id;
        }
    }

    $(document).ready(function() {
        $("#menuProduto").addClass("active");
        retornaTiposProduto();

        $("#selectTipoProduto").change(function() {
            $("#txtPercJuros").val($("#selectTipoProduto :selected").data("percjuros").toString().replace(".", ",") + "%");
        });

        $('#formProduto').submit(function(e) {
            e.preventDefault();
            if($("#txtDescProduto").val().trim()!="" && $("#txtPercJuros").val().trim()!="" && $("#selectTipoProduto").val().trim()!="" && $("#txtVlrCustoProduto").val().trim()!="" && $("#txtVlrVendaProduto").val().trim()!="")
            cadastrarProduto();
        });

        $("#txtDescProduto").keyup(function(e) {
            if ($(this).val().trim().length === 0 && e.keyCode == 32) {
                $("#txtDescProduto").val("");
            }

            let limite = 100,
                informativo = "carac. restantes",
                caracteresDigitados = $(this).val().length,
                caracteresRestantes = limite - caracteresDigitados;

            if ($(this).val().trim().length > 0) {
                if (caracteresRestantes <= 0) {
                    $("#contador").text("0 " + informativo);
                } else if (caracteresRestantes >= 16) {
                    $("#btnRegistro").removeAttr("disabled");
                    $("#contador").css("color", "#404040");
                    $("#contador").text(caracteresRestantes + " " + informativo);
                    if (caracteresRestantes == 100) {
                        $("#btnRegistro").attr("disabled", "disabled");
                    }
                } else if (caracteresRestantes >= 0 && caracteresRestantes <= 10) {
                    $("#contador").css("color", "red");
                    $("#contador").text(caracteresRestantes + " " + informativo);
                } else {
                    $("#contador").css("color", "#404040");
                    $("#contador").text(caracteresRestantes + " " + informativo);
                }
            } else {
                $("#contador").css("color", "#404040");
                $("#contador").text("100 " + informativo);
            }
        });
    });

    function retornaTiposProduto() {
        $.ajax({
            url: "../../controllers/ctrlTipoProduto.php?func=retornaTiposProduto",
            method: 'GET',
            dataType: "json",
            success: function(data) {
                let htmlOption;
                $("#selectTipoProduto").html('');
                htmlOption = `<option value="" disabled selected>Escolha uma opção</option>`;
                data.forEach(tipoproduto => {
                    htmlOption += `<option value="${tipoproduto.tipprod_id}" data-percjuros="${tipoproduto.tipprod_juros}">${tipoproduto.tipprod_descricao}</option>`;
                });
                $("#selectTipoProduto").html(htmlOption);
            },
            error: function() {
                console.log("ERRO");
            }
        });
    }

    function cadastrarProduto() {
        let produto = new Produto(
            $("#txtDescProduto").val(),
            $("#txtVlrCustoProduto").val().replace("R$ ", ""),
            $("#txtVlrVendaProduto").val().replace("R$ ", ""),
            $("#selectTipoProduto").val(),
            8 //fixo pois não temos controle de acesso - a intenção é sempre saber quem foi o usuário que cadastrou
        );

        $.ajax({
            url: "../../controllers/ctrlProduto.php?func=cadastrarProduto",
            type: 'POST',
            data: 'produto=' + JSON.stringify(produto),
            dataType: "json",
            success: function(data) {
                if (data[0] == "success") {
                    window.parent.msgRefresh(data);
                } else {
                    window.parent.msg(data);
                }
            },
            error: function() {
                console.log("ERRO");
            }
        });
    }
</script>

</html>