<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_unidade_medida").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=unidade_medida&app_comando=atualizar_unidade_medida&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=unidade_medida&app_comando=adicionar_unidade_medida&app_codigo";
        }

        ExecutarAcao(url);
    });
       Squall.GerarMascaras();
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_unidade_medida"))) {
    $("#bt_modal_salvar_unidade_medida").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_unidade_medida").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_unidade_medida').modal('hide');
                        $('#frm_unidade_medida').each (function(){
                            this.reset();
                        });
                AtualizarGridUnidadeMedida();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_unidade_medida").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
