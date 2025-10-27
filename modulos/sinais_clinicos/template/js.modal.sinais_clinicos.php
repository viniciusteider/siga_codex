<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_sinais_clinicos").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=sinais_clinicos&app_comando=atualizar_sinais_clinicos&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=sinais_clinicos&app_comando=adicionar_sinais_clinicos&app_codigo";
        }

        ExecutarAcao(url);
    });
       Squall.GerarMascaras();
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_sinais_clinicos"))) {
    $("#bt_modal_salvar_sinais_clinicos").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_sinais_clinicos").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_sinais_clinicos').modal('hide');
                        $('#frm_sinais_clinicos').each (function(){
                            this.reset();
                        });
                AtualizarGridSinaisClinicos();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_sinais_clinicos").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
