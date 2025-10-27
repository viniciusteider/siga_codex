<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroOcorrenciasMateriaisItens").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_ocorrencias_materiais_itens&app_modulo=ocorrencias_materiais_itens";
        //ModalOcorrenciasMateriaisItens();
	});
	$("#ExcluirRegistroOcorrenciasMateriaisItens").click(function()
	{
		var checked = $("input[name='lista_OcorrenciasMateriaisItens[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_OcorrenciasMateriaisItens[]']:checked"), function() {
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
                        ExcluirRegistrosOcorrenciasMateriaisItens(values);
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
	$('[data-bs-toggle="tooltip"]').tooltip();
});


function ModificarOcorrenciasMateriaisItens(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_ocorrencias_materiais_itens&app_modulo=ocorrencias_materiais_itens&app_codigo="+id;
        //ModalOcorrenciasMateriaisItens(id);
}
function ModalOcorrenciasMateriaisItens(id){
    $("#modal_modulo_ocorrencias_materiais_itens").modal("show");
    $("#div_modal_ocorrencias_materiais_itens").load("index_xml.php?app_comando=frm_modal_ocorrencias_materiais_itens&app_modulo=ocorrencias_materiais_itens&app_codigo="+id);
}

function ExcluirRegistrosOcorrenciasMateriaisItens(dados)
{
	$.post("index_xml.php?app_modulo=ocorrencias_materiais_itens&app_comando=deletar_ocorrencias_materiais_itens",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridOcorrenciasMateriaisItens();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
