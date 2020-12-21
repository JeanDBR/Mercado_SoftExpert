<?php

include("../../index.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Venda - Mercado SoftExpert</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />
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
                <input type="number" class="form-control" id="txtQtdProduto" min="1" value="1">
            </div>
            <div class="col-3 align-self-end">
                <button class="btn btn-primary btn-block" id="btnAdicionarProduto">Adicionar</button>
            </div>
            <div class="col-12 pt-5">
                <table id="tbProdutos" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descrição</th>
                            <th>Qtd</th>
                            <th>% Juros</th>
                            <th>Vlr Unitário</th>
                            <th>Vlr Total Juros</th>
                            <th>Vlr Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row col-12">
            <div class="col-12">
                <div class="float-right pl-3">
                    <label for="txtVlrTotal" class="form-label">Vlr Total</label>
                    <input type="text" class="form-control" disabled id="txtVlrTotal">
                </div>
                <div class="float-right">
                    <label for="txtJurosTotal" class="form-label">Juros Total</label>
                    <input type="text" class="form-control" disabled id="txtJurosTotal">
                </div>
            </div>
        </div>
        <div class="row col-12 pt-3">
            <div class="col-12">
                <button class="btn btn-secondary" type="reset">Limpar</button>
                <button class="btn btn-success float-right" type="submit">Finalizar</button>
            </div>
        </div>
    </div>
</body>
<script src="/js/script.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        var _listaProdutos = [],
            _listaItensVenda = [],
            contador = 0,
            jurosAcumulado = 0,
            vlrTotalCompra = 0,
            tabela = $('#tbProdutos').DataTable({
                "language": {
                    "emptyTable": "Nenhum registro encontrado",
                    "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "infoFiltered": "(Filtrados de _MAX_ registros)",
                    "infoThousands": ".",
                    "loadingRecords": "Carregando...",
                    "processing": "Processando...",
                    "zeroRecords": "Nenhum registro encontrado",
                    "search": "Pesquisar",
                    "paginate": {
                        "next": "Próximo",
                        "previous": "Anterior",
                        "first": "Primeiro",
                        "last": "Último"
                    },
                    "aria": {
                        "sortAscending": ": Ordenar colunas de forma ascendente",
                        "sortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        },
                        "1": "%d linha selecionada",
                        "_": "%d linhas selecionadas",
                        "cells": {
                            "1": "1 célula selecionada",
                            "_": "%d células selecionadas"
                        },
                        "columns": {
                            "1": "1 coluna selecionada",
                            "_": "%d colunas selecionadas"
                        }
                    },
                    "buttons": {
                        "copySuccess": {
                            "1": "Uma linha copiada com sucesso",
                            "_": "%d linhas copiadas com sucesso"
                        },
                        "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
                        "colvis": "Visibilidade da Coluna",
                        "colvisRestore": "Restaurar Visibilidade",
                        "copy": "Copiar",
                        "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
                        "copyTitle": "Copiar para a Área de Transferência",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "Mostrar todos os registros",
                            "1": "Mostrar 1 registro",
                            "_": "Mostrar %d registros"
                        },
                        "pdf": "PDF",
                        "print": "Imprimir"
                    },
                    "autoFill": {
                        "cancel": "Cancelar",
                        "fill": "Preencher todas as células com",
                        "fillHorizontal": "Preencher células horizontalmente",
                        "fillVertical": "Preencher células verticalmente"
                    },
                    "lengthMenu": "Exibir _MENU_ resultados por página",
                    "searchBuilder": {
                        "add": "Adicionar Condição",
                        "button": {
                            "0": "Construtor de Pesquisa",
                            "_": "Construtor de Pesquisa (%d)"
                        },
                        "clearAll": "Limpar Tudo",
                        "condition": "Condição",
                        "conditions": {
                            "date": {
                                "after": "Depois",
                                "before": "Antes",
                                "between": "Entre",
                                "empty": "Vazio",
                                "equals": "Igual",
                                "not": "Não",
                                "notBetween": "Não Entre",
                                "notEmpty": "Não Vazio"
                            },
                            "moment": {
                                "after": "Depois",
                                "before": "Antes",
                                "between": "Entre",
                                "empty": "Vazio",
                                "equals": "Igual",
                                "not": "Não",
                                "notBetween": "Não Entre",
                                "notEmpty": "Não Vazio"
                            },
                            "number": {
                                "between": "Entre",
                                "empty": "Vazio",
                                "equals": "Igual",
                                "gt": "Maior Que",
                                "gte": "Maior ou Igual a",
                                "lt": "Menor Que",
                                "lte": "Menor ou Igual a",
                                "not": "Não",
                                "notBetween": "Não Entre",
                                "notEmpty": "Não Vazio"
                            },
                            "string": {
                                "contains": "Contém",
                                "empty": "Vazio",
                                "endsWith": "Termina Com",
                                "equals": "Igual",
                                "not": "Não",
                                "notEmpty": "Não Vazio",
                                "startsWith": "Começa Com"
                            }
                        },
                        "data": "Data",
                        "deleteTitle": "Excluir regra de filtragem",
                        "logicAnd": "E",
                        "logicOr": "Ou",
                        "title": {
                            "0": "Construtor de Pesquisa",
                            "_": "Construtor de Pesquisa (%d)"
                        },
                        "value": "Valor"
                    },
                    "searchPanes": {
                        "clearMessage": "Limpar Tudo",
                        "collapse": {
                            "0": "Painéis de Pesquisa",
                            "_": "Painéis de Pesquisa (%d)"
                        },
                        "count": "{total}",
                        "countFiltered": "{shown} ({total})",
                        "emptyPanes": "Nenhum Painel de Pesquisa",
                        "loadMessage": "Carregando Painéis de Pesquisa...",
                        "title": "Filtros Ativos"
                    },
                    "searchPlaceholder": "Digite um termo para pesquisar",
                    "thousands": "."
                }
            });

        $("#menuVenda").addClass("active");
        retornaProdutos();

        $("#btnAdicionarProduto").attr("disabled", "disabled");

        $("#selectProduto").change(function() {
            $("#btnAdicionarProduto").removeAttr("disabled");
        });

        $("#btnAdicionarProduto").click(function() {
            let idProduto = $("#selectProduto").val(),
                descProduto = $("#selectProduto :selected").text(),
                qtd = $("#txtQtdProduto").val(),
                juros = $("#selectProduto :selected").data('juros'),
                juroscalculo = juros / 100,
                vlrvendaunitario = $("#selectProduto :selected").data('vlrvenda'),
                vlrvendacalculo = parseFloat(vlrvendaunitario.replace(".", "").replace("R$ ", "").replace(",", ".")),
                vlrtotalproduto = parseFloat(vlrvendacalculo * qtd).toFixed(2),
                vlrtotaljuros = parseFloat(vlrtotalproduto * juroscalculo).toFixed(2);

            vlrTotalCompra = parseFloat(parseFloat(vlrTotalCompra) + parseFloat(vlrtotalproduto)).toFixed(2);
            jurosAcumulado = parseFloat(parseFloat(jurosAcumulado) + parseFloat(vlrtotaljuros)).toFixed(2);

            $("#txtJurosTotal").val(`R$ ${jurosAcumulado}`);
            $("#txtVlrTotal").val(`R$ ${vlrTotalCompra}`);

            _listaItensVenda.push(idProduto, qtd, juros, vlrvendaunitario);
            tabela.row.add([
                contador++,
                descProduto,
                qtd,
                juros,
                vlrvendaunitario,
                `R$ ${vlrtotaljuros}`,
                `R$ ${vlrtotalproduto}`
            ]).draw(false);
        });
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