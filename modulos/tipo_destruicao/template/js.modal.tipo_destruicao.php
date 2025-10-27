<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_tipo_destruicao").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=tipo_destruicao&app_comando=atualizar_tipo_destruicao&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=tipo_destruicao&app_comando=adicionar_tipo_destruicao&app_codigo";
        }

        ExecutarAcao(url);
    });
       Mascaras();
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_tipo_destruicao"))) {
    $("#bt_modal_salvar_tipo_destruicao").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_tipo_destruicao").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_tipo_destruicao').modal('hide');
                        $('#frm_tipo_destruicao').each (function(){
                            this.reset();
                        });
                AtualizarGridTipoDestruicao();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_tipo_destruicao").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
