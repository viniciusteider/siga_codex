<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_procedimentos_tipo").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=procedimentos_tipo&app_comando=atualizar_procedimentos_tipo&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=procedimentos_tipo&app_comando=adicionar_procedimentos_tipo&app_codigo";
        }

        ExecutarAcao(url);
    });
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_procedimentos_tipo"))) {
    $("#bt_modal_salvar_procedimentos_tipo").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_procedimentos_tipo").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_procedimentos_tipo').modal('hide');
                        $('#frm_procedimentos_tipo').each (function(){
                            this.reset();
                        });
                AtualizarGridProcedimentosTipo();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_procedimentos_tipo").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
