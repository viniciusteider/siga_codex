<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        Mascaras();
        $('#id_orgao_apoio').select2();


        new tempusDominus.TempusDominus(document.getElementById("hora_pedido"), {
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


    });
    function ClickSalvar(){
        var id = $('#id_ocorrencia_apoio').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=ocorrencias_apoio&app_comando=atualizar_ocorrencias_apoio&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=ocorrencias_apoio&app_comando=adicionar_ocorrencias_apoio&app_codigo";
        }

        ExecutarAcaoModalApoio(url);
    };
    function ExecutarAcaoModalApoio(url)
    {
        if (Squall.ValidateForm($("#frm_ocorrencias_apoio"))) {
            $("#bt_modal_salvar_ocorrencias_apoio").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_ocorrencias_apoio").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"]);
                        $('#modal_modulo_ocorrencias_apoio').modal('hide');
                        $('#frm_ocorrencias_apoio').each (function(){
                            this.reset();
                        });
                        AtualizarGridOcorrenciasApoio();

                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_modal_salvar_ocorrencias_apoio").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>
