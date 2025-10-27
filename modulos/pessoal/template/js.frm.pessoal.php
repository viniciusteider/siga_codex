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
            url = "index_xml.php?app_modulo=pessoal&app_comando=atualizar_pessoal&app_codigo";
            tipo = 2;
        }
        else
        {
            url = "index_xml.php?app_modulo=pessoal&app_comando=adicionar_pessoal&app_codigo";
        }

        ExecutarAcao(url);
    });
});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_pessoal"))) {
    $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> AGUARDE...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_pessoal").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=pessoal&app_comando=listar_pessoal",'600');

                        // $("#frm_pessoal").each (function(){
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
