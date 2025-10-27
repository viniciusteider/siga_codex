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
            url = "index_xml.php?app_modulo=instituicao_ensino&app_comando=atualizar_instituicao_ensino&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=instituicao_ensino&app_comando=adicionar_instituicao_ensino&app_codigo";
        }

        ExecutarAcao(url);
    });
       Mascaras();
    $('#id_estado,#id_cidade').select2({language: "pt-BR"});
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_instituicao_ensino"))) {
    $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_instituicao_ensino").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=instituicao_ensino&app_comando=listar_instituicao_ensino",'600');

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
