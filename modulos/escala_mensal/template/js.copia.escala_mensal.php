<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        $('.setdate').tempusDominus({
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
                components: {
                    calendar: true,
                    date: true,
                    month: true,
                    year: true,
                    decades: true,
                    clock: true,
                    hours: true,
                    minutes: true,
                    seconds: true,
                    useTwentyfourHour: undefined
                }
            }
        });
    });

    function ExecutarAcaoCopiaEscala()
    {
        if (Squall.ValidateForm($("#frm_escala_mensal"))) {
            $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post('index_xml.php?app_modulo=escala_mensal&app_comando=adicionar_copia_escala_mensal&app_codigo',
                $("#frm_escala_mensal").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=escala_mensal&app_comando=listar_escala_mensal",'600');

                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_salvar").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>