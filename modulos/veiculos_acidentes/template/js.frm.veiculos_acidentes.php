<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_salvar").click(function () {
         var id = $('#id').val();
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=veiculos_acidentes&app_comando=atualizar_veiculos_acidentes&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=veiculos_acidentes&app_comando=adicionar_veiculos_acidentes&app_codigo";
        }

        ExecutarAcao(url);
    });
       Mascaras();
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_veiculos_acidentes"))) {
    $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_veiculos_acidentes").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=veiculos_acidentes&app_comando=listar_veiculos_acidentes",'600');

				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_salvar").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
