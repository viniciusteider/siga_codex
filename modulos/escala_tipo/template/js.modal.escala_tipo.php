<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_escala_tipo").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=escala_tipo&app_comando=atualizar_escala_tipo&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=escala_tipo&app_comando=adicionar_escala_tipo&app_codigo";
        }

        ExecutarAcao(url);
    });
       Mascaras();
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_escala_tipo"))) {
    $("#bt_modal_salvar_escala_tipo").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_escala_tipo").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_escala_tipo').modal('hide');
                        $('#frm_escala_tipo').each (function(){
                            this.reset();
                        });
                AtualizarGridEscalaTipo();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_escala_tipo").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
