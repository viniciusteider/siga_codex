<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroClassificacaoLigacao").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_classificacao_ligacao&app_modulo=classificacao_ligacao";
        //ModalClassificacaoLigacao();
	});
	$("#ExcluirRegistroClassificacaoLigacao").click(function()
	{
		var checked = $("input[name='lista_ClassificacaoLigacao[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_ClassificacaoLigacao[]']:checked"), function() {
				values.push($(this).val());
			});
            //Parameter
                swal.fire({
                    title: "Confirme Por favor",
                    text: "Você realmente gostaria de Remover estes registros ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sim, continue!",
                    cancelButtonText: "Não, cancelar!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then((isConfirm) =>{
                    if (isConfirm.value) {
                        ExcluirRegistrosClassificacaoLigacao(values);
                         swal.fire("Removido!", "O(s) Registro(s) Foram removidos com sucesso.", "success");
                    } else {
                        swal.fire("Cancelado", "Remoção cancelada pelo usuário", "error");
                    }
                });

		}
		else
		{
            Squall.ToastMsg('warning','Selecione pelo menos 1 registro');
		}
	});
	$('[data-toggle="tooltip"]').tooltip();
	$("#busca").keypress(function (e) {
		if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            AtualizarGridClassificacaoLigacao(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarClassificacaoLigacao(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_classificacao_ligacao&app_modulo=classificacao_ligacao&app_codigo="+id;
        //ModalClassificacaoLigacao(id);
}
function ModalClassificacaoLigacao(id){
    $("#modal_modulo_classificacao_ligacao").modal("show");
    $("#div_modal_classificacao_ligacao").load("index_xml.php?app_comando=frm_modal_classificacao_ligacao&app_modulo=classificacao_ligacao&app_codigo="+id);
}

function ExcluirRegistrosClassificacaoLigacao(dados)
{
	$.post("index_xml.php?app_modulo=classificacao_ligacao&app_comando=deletar_classificacao_ligacao",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridClassificacaoLigacao();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
