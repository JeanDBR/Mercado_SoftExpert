<?php

include("../../index.php"); //Menu

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Cadastro de Tipo de Produto - Mercado SoftExpert</title>
</head>

<body>
    <div class="container pt-3">
        <div class="row col-12">
            <small class="form-text text-muted">Campos com * são de preenchimento obrigatório!</small> <label></label>
        </div>
        <hr />
        <form class="row g-3 needs-validation" id="formTipoProduto" novalidate>
            <div class="row col-12">
                <div class="col-8">
                    <div class="row">
                        <div class="col-8">
                            <label for="txtDescTipoProduto" class="form-label">Descrição <small><strong>*</strong></small></label>
                        </div>
                        <div class="col-4">
                            <label class="float-right"><small id="contador">100 carac. restantes</small></label>
                        </div>
                    </div>
                    <input type="text" class="form-control" maxlength="100" id="txtDescTipoProduto" placeholder="Ex: Tipo 01" required>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo corretamente!
                    </div>
                </div>
                <div class="col-4">
                    <label for="txtJurosTipoProduto" class="form-label">% Juros <small><strong>*</strong></small></label>
                    <input type="text" class="form-control percent" id="txtJurosTipoProduto" placeholder="Ex: 2,04%" required>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo corretamente!
                    </div>
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
    class TipoProduto {
        constructor(tipprod_descricao, tipprod_juros, usu_id) {
            this.tipprod_descricao = tipprod_descricao;
            this.tipprod_juros = tipprod_juros;
            this.usu_id = usu_id;
        }
    }

    $(document).ready(function() {
        $("#menuTipoProduto").addClass("active");
        $('.percent').mask('##0,00%', {
            reverse: true
        });

        $('#formTipoProduto').submit(function(e) {
            e.preventDefault();
            if ($("#txtDescTipoProduto").val().trim() != '' && $("#txtJurosTipoProduto").val().trim()) {
                cadastrarTipoProduto();
            }
        });

        $("#txtDescTipoProduto").keyup(function(e) {
            if ($(this).val().trim().length === 0 && e.keyCode == 32) {
                $("#txtDescTipoProduto").val("");
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

    function cadastrarTipoProduto() {
        let tipoproduto = new TipoProduto(
            $("#txtDescTipoProduto").val(),
            $("#txtJurosTipoProduto").val().replace("%", "").replace(",", "."),
            8 //fixo pois não temos controle de acesso - a intenção é sempre saber quem foi o usuário que cadastrou
        );
        $.ajax({
            url: "../../controllers/ctrlTipoProduto.php?func=cadastrarTipoProduto",
            type: 'POST',
            data: 'tipoproduto=' + JSON.stringify(tipoproduto),
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