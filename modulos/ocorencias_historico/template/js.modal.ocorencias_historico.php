<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_ocorencias_historico").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=ocorencias_historico&app_comando=atualizar_ocorencias_historico&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=ocorencias_historico&app_comando=adicionar_ocorencias_historico&app_codigo";
        }

        ExecutarAcao(url);
    });
       Mascaras();
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_ocorencias_historico"))) {
    $("#bt_modal_salvar_ocorencias_historico").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_ocorencias_historico").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_ocorencias_historico').modal('hide');
                        $('#frm_ocorencias_historico').each (function(){
                            this.reset();
                        });
                AtualizarGridOcorenciasHistorico();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_ocorencias_historico").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
