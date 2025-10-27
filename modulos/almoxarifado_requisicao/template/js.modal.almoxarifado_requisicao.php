<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_almoxarifado_requisicao").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=almoxarifado_requisicao&app_comando=atualizar_almoxarifado_requisicao&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=almoxarifado_requisicao&app_comando=adicionar_almoxarifado_requisicao&app_codigo";
        }

        ExecutarAcao(url);
    });
       Mascaras();
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_almoxarifado_requisicao"))) {
    $("#bt_modal_salvar_almoxarifado_requisicao").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_almoxarifado_requisicao").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_almoxarifado_requisicao').modal('hide');
                        $('#frm_almoxarifado_requisicao').each (function(){
                            this.reset();
                        });
                AtualizarGridAlmoxarifadoRequisicao();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_almoxarifado_requisicao").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
