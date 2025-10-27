<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_pupilas_sintomas").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=pupilas_sintomas&app_comando=atualizar_pupilas_sintomas&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=pupilas_sintomas&app_comando=adicionar_pupilas_sintomas&app_codigo";
        }

        ExecutarAcao(url);
    });
       Mascaras();
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_pupilas_sintomas"))) {
    $("#bt_modal_salvar_pupilas_sintomas").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_pupilas_sintomas").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_pupilas_sintomas').modal('hide');
                        $('#frm_pupilas_sintomas').each (function(){
                            this.reset();
                        });
                AtualizarGridPupilasSintomas();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_pupilas_sintomas").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
