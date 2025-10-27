<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_modal_salvar_produtos_revestimento").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=produtos_revestimento&app_comando=atualizar_produtos_revestimento&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=produtos_revestimento&app_comando=adicionar_produtos_revestimento&app_codigo";
        }

        ExecutarAcao(url);
    });
       Squall.GerarMascaras();
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_produtos_revestimento"))) {
    $("#bt_modal_salvar_produtos_revestimento").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_produtos_revestimento").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"]);
       $('#modal_modulo_produtos_revestimento').modal('hide');
                        $('#frm_produtos_revestimento').each (function(){
                            this.reset();
                        });
                AtualizarGridProdutosRevestimento();

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_modal_salvar_produtos_revestimento").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
