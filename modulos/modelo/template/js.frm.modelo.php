<script type="text/javascript">

/*
 * Executa o post do formulário
 * */
$(document).ready(function () {
    $("#bt_salvar").click(function () {
        var id = "<?=$app_codigo?>";
        var tipo = 1;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=modelo&app_comando=atualizar_modelo&app_codigo";
            tipo = 2;
        }
        else
        {
            url = "index_xml.php?app_modulo=modelo&app_comando=adicionar_modelo&app_codigo";
        }

        ExecutarAcao(url);
    });
    $('#id_marca').select2({language: "pt-BR"});
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_modelo"))) {
    $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> AGUARDE...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_modelo").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=modelo&app_comando=listar_modelo",'600');

                        // $("#frm_modelo").each (function(){
                        //     this.reset();
                        // });


				} else {
                    Squall.ToastMsg('warning',response["mensagem"]);
				}
            $("#bt_salvar").prop("disabled",false).html("<i class=\"fa fa-check\"></i> SALVAR").removeClass("btn-warning");
			}
			, "json" // definindo retorno para o formato json
		);
	}
}
</script>
