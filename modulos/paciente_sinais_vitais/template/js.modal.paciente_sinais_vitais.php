<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_paciente_sinais_vitais").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=paciente_sinais_vitais&app_comando=atualizar_paciente_sinais_vitais&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=paciente_sinais_vitais&app_comando=adicionar_paciente_sinais_vitais&app_codigo";
        }

        ExecutarAcao(url);
    });
       Mascaras();
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_paciente_sinais_vitais"))) {
    $("#bt_modal_salvar_paciente_sinais_vitais").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_paciente_sinais_vitais").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_paciente_sinais_vitais').modal('hide');
                        $('#frm_paciente_sinais_vitais').each (function(){
                            this.reset();
                        });
                AtualizarGridPacienteSinaisVitais();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_paciente_sinais_vitais").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
