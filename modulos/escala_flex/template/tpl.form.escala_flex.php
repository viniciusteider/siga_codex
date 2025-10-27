<form action="#" name="frm_escala_flex" id="frm_escala_flex" method="post">
    <input type="hidden" name="id" id="id">
    <div class="form-body">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Local</th>
                    <th>Efetivo</th>
                    <th>Função</th>
                    <th>Entrada</th>
                    <th>Saída</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $locais  = new EscalaLocais();
                foreach ($locais->ListarComboComRecursos($_SESSION['usuario']['id_grupo']) as $row) { ?>
                    <!-- Linha PAI -->
                    <tr class="linha-pai">
                        <td rowspan="1" data-row="<?= $row['id'] ?>" class="table-active">
                            <input type="hidden" name="id_local[]" value="<?= $row['id'] ?>">
                            <?= $row['nome'] ?>
                        </td>
                        <td>
                            <select name="id_efetivo" class="form-select" data-escala="id_efetivo" data-placeholder="Selecione Efetivo">
                            </select>
                        </td>
                        <td>
                            <select name="id_funcao" class="form-select" data-escala="id_funcao" data-placeholder="Selecione Função">
                                <?php
                                $objFuncao = new Funcao();
                                foreach ($objFuncao->ComboFuncao() as $row) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nome'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><input type="text" name="data_hora_entrada" data-escala="data_hora_entrada" class="form-control mask-datetime" autocomplete="off"></td>
                        <td><input type="text" name="data_hora_saida" data-escala="data_hora_saida" class="form-control mask-datetime" autocomplete="off"></td>
                        <td>
                            <a href="javascript:;" class="btn btn-light-primary btn-icon btn-add-filho">
                                <i class="ki-duotone ki-plus fs-3"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- Fim Linha PAI -->
                <?php } ?>
            </tbody>
        </table>
    </div>
</form>

<script>
    Squall.autoComplete($('[data-escala="id_efetivo"]'), 'index_xml.php?app_modulo=usuario&app_comando=popup_localizar_usuarios');
    $('[data-escala="id_local"]').select2();
    $('[data-escala="data_hora_entrada"]').tempusDominus({
        localization: {
            locale: "pt-br",
            startOfTheWeek: 1,
            format: "dd/MM/yyyy HH:mm:ss"
        },
        display: {
            icons: {
                time: "ki-outline ki-time fs-1",
                date: "ki-outline ki-calendar fs-1",
                up: "ki-outline ki-up fs-1",
                down: "ki-outline ki-down fs-1",
                previous: "ki-outline ki-left fs-1",
                next: "ki-outline ki-right fs-1",
                today: "ki-outline ki-check fs-1",
                clear: "ki-outline ki-trash fs-1",
                close: "ki-outline ki-cross fs-1",
            },
            buttons: {
                today: true,
                clear: true,
                close: true,
            },
        }
    });
    $('[data-escala="data_hora_saida"]').tempusDominus({
        localization: {
            locale: "pt-br",
            startOfTheWeek: 1,
            format: "dd/MM/yyyy HH:mm:ss"
        },
        display: {
            icons: {
                time: "ki-outline ki-time fs-1",
                date: "ki-outline ki-calendar fs-1",
                up: "ki-outline ki-up fs-1",
                down: "ki-outline ki-down fs-1",
                previous: "ki-outline ki-left fs-1",
                next: "ki-outline ki-right fs-1",
                today: "ki-outline ki-check fs-1",
                clear: "ki-outline ki-trash fs-1",
                close: "ki-outline ki-cross fs-1",
            },
            buttons: {
                today: true,
                clear: true,
                close: true,
            },
        }
    });

    // Evento de clique no botão "+"
    document.querySelectorAll("tr.linha-pai").forEach(function(linhaPai) {
        const validator = FormValidation.formValidation(linhaPai, {
            fields: {
                data_hora_entrada: {
                    validators: {
                        notEmpty: {
                            message: "Informe a data/hora de entrada"
                        },
                        callback: {
                            message: "A entrada deve ser menor que a saída",
                            callback: function(input) {
                                const entrada = input.value;
                                const saida = linhaPai.querySelector('input[name="data_hora_saida"]').value;

                                console.log(entrada);
                                console.log(saida);

                                if (!entrada || !saida) {
                                    return true; // deixa o notEmpty cuidar
                                }

                                // Converte dd/MM/yyyy HH:mm:ss para Date
                                const partsE = entrada.split(/[/ :]/);
                                const partsS = saida.split(/[/ :]/);

                                const dataEntrada = new Date(partsE[2], partsE[1] - 1, partsE[0], partsE[3], partsE[4], partsE[5] || 0);
                                const dataSaida = new Date(partsS[2], partsS[1] - 1, partsS[0], partsS[3], partsS[4], partsS[5] || 0);

                                return dataEntrada < dataSaida;
                            }
                        }
                    }
                },
                data_hora_saida: {
                    validators: {
                        notEmpty: {
                            message: "Informe a data/hora de saída"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".form-control, .form-select"
                })
            }
        });

        // Botão de adicionar filho dentro da linha pai
        linhaPai.querySelector(".btn-add-filho").addEventListener("click", function() {
            validator.validate().then(function(status) {
                if (status === "Valid") {
                    const tabela = linhaPai.closest("tbody");
                    const selectEfetivo = linhaPai.querySelector("select[name='id_efetivo']");
                    const efetivoValue = selectEfetivo.value;
                    const efetivoText = selectEfetivo.options[selectEfetivo.selectedIndex].text;
                    const entrada = linhaPai.querySelector("input[name='data_hora_entrada']").value;
                    const saida = linhaPai.querySelector("input[name='data_hora_saida']").value;

                    const selectFuncao = linhaPai.querySelector("select[name='id_funcao']");
                    const funcaoValue = selectFuncao.value;

                    // Clona as opções do pai
                    const optionsFuncao = Array.from(selectFuncao.options).map(opt => {
                        const selected = opt.value === funcaoValue ? "selected" : "";
                        return `<option value="${opt.value}" ${selected}>${opt.text}</option>`;
                    }).join("");

                    const idLocal = linhaPai.querySelector("td:first-child").getAttribute("data-row");
                    // Nova linha filho
                    const novaLinha = document.createElement("tr");
                    novaLinha.classList.add("linha-filho");
                    novaLinha.innerHTML = `
                            <td>
                              <input type="hidden" name="id_efetivo_${idLocal}[]" value="${efetivoValue}">
                              <input type="hidden" name="nome_efetivo_${idLocal}_${efetivoValue}" value="${efetivoText}">
                              ${efetivoText}
                            </td>
                            <td>
                              <select name="id_funcao_${idLocal}_${efetivoValue}" class="form-select" data-escala="id_funcao" data-placeholder="Selecione Função">
                                ${optionsFuncao}
                              </select>
                            </td>
                            <td><input type="text" name="data_hora_entrada_${idLocal}_${efetivoValue}" class="form-control mask-datetime" data-escala="data_hora_entrada" value="${entrada}" autocomplete="off"></td>
                            <td><input type="text" name="data_hora_saida_${idLocal}_${efetivoValue}" class="form-control mask-datetime" data-escala="data_hora_saida" value="${saida}" autocomplete="off"></td>
                            <td>
                              <a href="javascript:;" class="btn btn-light-danger btn-icon btn-delete-filho">
                              
                                <i class="ki-duotone ki-trash fs-5">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                              </a>
                            </td>
                        `;

                    // Insere depois do pai
                    tabela.insertBefore(novaLinha, linhaPai.nextSibling);

                    // Ajusta rowspan
                    const cellLocal = linhaPai.querySelector("td[rowspan]");
                    let rowspanAtual = parseInt(cellLocal.getAttribute("rowspan")) || 1;
                    cellLocal.setAttribute("rowspan", rowspanAtual + 1);

                    // Botão excluir filho
                    novaLinha.querySelector(".btn-delete-filho").addEventListener("click", function() {
                        novaLinha.remove();
                        let atual = parseInt(cellLocal.getAttribute("rowspan"));
                        cellLocal.setAttribute("rowspan", atual - 1);
                    });

                    $(selectEfetivo).val(null).trigger("change");
                }
            });
        });
    });
</script>