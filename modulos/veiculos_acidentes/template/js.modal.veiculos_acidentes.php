<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        Mascaras();
        $('#id_tipo_veiculo,#id_tipo_destruicao').select2({dropdownParent: $('#modal_modulo_veiculos_acidentes')});
        Squall.autoCompleteModal('#id_marca', 'index_xml.php?app_modulo=fipe_marcas&app_comando=listar_fipe_marcas_autocomplete','#id_tipo_veiculo',null,$('#modal_modulo_veiculos_acidentes'));
        Squall.autoCompleteModal('#id_modelo', 'index_xml.php?app_modulo=fipe_modelos&app_comando=listar_fipe_modelos_autocomplete','#id_marca',null,$('#modal_modulo_veiculos_acidentes'));
        Squall.autoCompleteModal('#id_ano', 'index_xml.php?app_modulo=fipe_anos&app_comando=listar_fipe_anos_autocomplete','#id_modelo',null,$('#modal_modulo_veiculos_acidentes'));
    });
    function ClickBotaoSalvarAcidente() {
        var id = $('#id_veiculo_acidentes').val();
        if(id != "")
            url = "index_xml.php?app_modulo=veiculos_acidentes&app_comando=atualizar_veiculos_acidentes&app_codigo";
        else
            url = "index_xml.php?app_modulo=veiculos_acidentes&app_comando=adicionar_veiculos_acidentes&app_codigo";
        ExecutarAcao(url);
    }
    function ExecutarAcao(url)
    {
        if (Squall.ValidateForm($("#frm_veiculos_acidentes"))) {
            $("#bt_modal_salvar_veiculos_acidentes").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_veiculos_acidentes").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"]);
                        $('#modal_modulo_veiculos_acidentes').modal('hide');
                        $('#frm_veiculos_acidentes').each (function(){
                            this.reset();
                        });
                        AtualizarGridVeiculosAcidentes();

                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_modal_salvar_veiculos_acidentes").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>
