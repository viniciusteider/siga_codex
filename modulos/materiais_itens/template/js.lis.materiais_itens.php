<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroMateriaisItens").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_materiais_itens&app_modulo=materiais_itens";
        //ModalMateriaisItens();
	});
	$("#ExcluirRegistroMateriaisItens").click(function()
	{
		var checked = $("input[name='lista_MateriaisItens[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_MateriaisItens[]']:checked"), function() {
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
                        ExcluirRegistrosMateriaisItens(values);
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


function ModificarMateriaisItens(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_materiais_itens&app_modulo=materiais_itens&app_codigo="+id;
        //ModalMateriaisItens(id);
}
function ModalMateriaisItens(id){
    $("#modal_modulo_materiais_itens").modal("show");
    $("#div_modal_materiais_itens").load("index_xml.php?app_comando=frm_modal_materiais_itens&app_modulo=materiais_itens&app_codigo="+id);
}

function ExcluirRegistrosMateriaisItens(dados)
{
	$.post("index_xml.php?app_modulo=materiais_itens&app_comando=deletar_materiais_itens",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridMateriaisItens();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
