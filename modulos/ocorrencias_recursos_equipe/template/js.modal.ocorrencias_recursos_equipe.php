<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_ocorrencias_recursos_equipe").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=ocorrencias_recursos_equipe&app_comando=atualizar_ocorrencias_recursos_equipe&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=ocorrencias_recursos_equipe&app_comando=adicionar_ocorrencias_recursos_equipe&app_codigo";
        }

        ExecutarAcao(url);
    });
       Mascaras();
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_ocorrencias_recursos_equipe"))) {
    $("#bt_modal_salvar_ocorrencias_recursos_equipe").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_ocorrencias_recursos_equipe").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_ocorrencias_recursos_equipe').modal('hide');
                        $('#frm_ocorrencias_recursos_equipe').each (function(){
                            this.reset();
                        });
                AtualizarGridOcorrenciasRecursosEquipe();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_ocorrencias_recursos_equipe").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
