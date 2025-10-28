<script type="text/javascript">
    $(function () {
        var camposDatas = $("#periodo");
        if (camposDatas.length) {
            camposDatas.daterangepicker({
                showDropdowns: true,
                autoUpdateInput: false,
                autoApply: true,
                locale: {
                    "format": 'DD/MM/YYYY',
                    "separator": ' - ',
                    "applyLabel": 'Confirmar',
                    "cancelLabel": 'Cancelar',
                    "daysOfWeek": [
                        "Dom",
                        "Seg",
                        "Ter",
                        "Qua",
                        "Qui",
                        "Sex",
                        "Sab"
                    ],
                    "monthNames": [
                        "Jan",
                        "Fev",
                        "Mar",
                        "Abr",
                        "Mai",
                        "Jun",
                        "Jul",
                        "Ago",
                        "Set",
                        "Out",
                        "Nov",
                        "Dez"
                    ],
                    "firstDay": 0
                }
            });

            camposDatas.on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + " - " + picker.endDate.format('DD/MM/YYYY'));
            });

            camposDatas.on('cancel.daterangepicker', function () {
                $(this).val('');
            });
        }

        $("#frm_pesquisa_ocorrencias").on("submit", function (event) {
            event.preventDefault();
            AtualizarGridPesquisaOcorrencias(0, '', $('#filtro').val(), $('#ordem').val());
        });

        $("#btn-resetar-pesquisa").on("click", function () {
            var form = $("#frm_pesquisa_ocorrencias")[0];
            form.reset();
            $("#periodo").val('');
            $("#pagina").val(0);
            $("#filtro").val('');
            $("#ordem").val('');
            $("#numero_registro_hidden").val('');
            AtualizarGridPesquisaOcorrencias(0);
        });

        AtualizarGridPesquisaOcorrencias($("#pagina").val(), '', $("#filtro").val(), $("#ordem").val());
    });

    function AtualizarGridPesquisaOcorrencias(pagina, busca, filtro, ordem) {
        if (typeof pagina === 'undefined' || pagina === '') {
            pagina = $("#pagina").val();
        }
        if (typeof filtro !== 'undefined' && filtro !== '') {
            $("#filtro").val(filtro);
        }
        if (typeof ordem !== 'undefined' && ordem !== '') {
            $("#ordem").val(ordem);
        }
        $("#pagina").val(pagina);

        var registros = $('#numero_registros').val();
        if (typeof registros !== 'undefined') {
            $('#numero_registro_hidden').val(registros);
        }

        $("#conteudo_pesquisa_ocorrencias").load("index_xml.php?app_modulo=ocorrencias&app_comando=ajax_pesquisa_ocorrencias", $('#frm_pesquisa_ocorrencias').serializeArray());
    }

    function VisualizarOcorrencia(id) {
        window.location = "#index_xml.php?app_modulo=ocorrencias&app_comando=view_ocorrencia&app_codigo=" + id;
    }
</script>
