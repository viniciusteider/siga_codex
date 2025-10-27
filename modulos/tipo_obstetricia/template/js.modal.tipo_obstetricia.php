<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_tipo_obstetricia").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=tipo_obstetricia&app_comando=atualizar_tipo_obstetricia&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=tipo_obstetricia&app_comando=adicionar_tipo_obstetricia&app_codigo";
        }

        ExecutarAcao(url);
    });
       Mascaras();
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_tipo_obstetricia"))) {
    $("#bt_modal_salvar_tipo_obstetricia").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_tipo_obstetricia").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_tipo_obstetricia').modal('hide');
                        $('#frm_tipo_obstetricia').each (function(){
                            this.reset();
                        });
                AtualizarGridTipoObstetricia();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_tipo_obstetricia").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
