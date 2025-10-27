<script>
    $(document).ready(function () {
        $('#id_evento,#id_subevento').select2();
        // Dialer container element
        var dialerElement1 = document.querySelector("#contador_usa");
        var dialerObject1 = new KTDialer(dialerElement1, {
            min: 0,
            max: 10,
            step: 1,
        });

        var dialerElement2 = document.querySelector("#contador_usb");
        var dialerObject2 = new KTDialer(dialerElement2, {
            min: 0,
            max: 10,
            step: 1,
            decimals: 0
        })

        var dialerElement3 = document.querySelector("#contador_siate");
        var dialerObject3 = new KTDialer(dialerElement3, {
            min: 0,
            max: 10,
            step: 1,
            decimals: 0
        })

        var dialerElement4 = document.querySelector("#contador_vir");
        var dialerObject4 = new KTDialer(dialerElement4, {
            min: 0,
            max: 10,
            step: 1,
            decimals: 0
        })
        AtualizarHistorico();

    });
    function FinalizarOcorrenica()
    {
        swal.fire({
            title: "Confirme Por favor",
            text: "Você realmente gostaria de finalizar esta Ocorrência?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim",
            cancelButtonText: "Não, cancelar!",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then((isConfirm) =>{
            if (isConfirm.value) {
                $('#cancelar').val('1');
                $('#descricao').removeClass('validar-obrigatorio');
                ExecutarAcaoDespachoOcorrencias();
                $('#descricao').addClass('validar-obrigatorio');
                swal.fire("Finalizado!", "A ocorrência foi finalizada com sucesso.", "success");
            } else {
                swal.fire("Cancelado", "Finalização cancelada!!!", "error");
            }
        });
    }
    function AtualizarHistorico(id)
    {
        $("#div_historico_ocorrencia").load("index_xml.php?app_modulo=ocorrencias&app_comando=listar_ocorrencias_historico",$('#frm_despacho_ocorrencia').serializeArray());
    }

    function ExecutarAcaoDespachoOcorrencias()
    {
        if (Squall.ValidateForm($("#frm_despacho_ocorrencia"))) {
            $("#bt_salvar_despacho").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> AGUARDE...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post("index_xml.php?app_modulo=ocorrencias&app_comando=despachar_ocorrencia&app_codigo",
                $("#frm_despacho_ocorrencia").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"]);
                        drawer.hide();
                        UpdateListagens();
                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_salvar_despacho").prop("disabled",false).html("<i class=\"fa fa-check\"></i> SALVAR").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }

</script>