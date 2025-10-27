<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {

        $('#id_peca,#id_tamanho').select2({dropdownParent: $('#modal_modulo_pessoal_uniforme')});
    });
    function ClickSalvarUniformes()
    {
          var id = $('#id_uniforme').val();
            if(id != "")
                url = "index_xml.php?app_modulo=pessoal_uniforme&app_comando=atualizar_pessoal_uniforme&app_codigo";
            else
                url = "index_xml.php?app_modulo=pessoal_uniforme&app_comando=adicionar_pessoal_uniforme&app_codigo";

            ExecutarAcaoUniformes(url);

    }
    function ExecutarAcaoUniformes(url)
    {
        if (Squall.ValidateForm($("#frm_pessoal_uniforme"))) {
            $("#bt_modal_salvar_pessoal_uniforme").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_pessoal_uniforme").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"]);
                        $('#modal_modulo_pessoal_uniforme').modal('hide');
                        $('#frm_pessoal_uniforme').each (function(){
                            this.reset();
                        });
                        AtualizarGridPessoalUniforme();

                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_modal_salvar_pessoal_uniforme").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>
