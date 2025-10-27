<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_tipo_dispensa").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=tipo_dispensa&app_comando=atualizar_tipo_dispensa&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=tipo_dispensa&app_comando=adicionar_tipo_dispensa&app_codigo";
        }

        ExecutarAcao(url);
    });
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_tipo_dispensa"))) {
    $("#bt_modal_salvar_tipo_dispensa").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_tipo_dispensa").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_tipo_dispensa').modal('hide');
                        $('#frm_tipo_dispensa').each (function(){
                            this.reset();
                        });
                AtualizarGridTipoDispensa();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_tipo_dispensa").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
