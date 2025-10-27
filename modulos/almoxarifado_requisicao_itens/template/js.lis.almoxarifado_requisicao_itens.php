<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroAlmoxarifadoRequisicaoItens").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_almoxarifado_requisicao_itens&app_modulo=almoxarifado_requisicao_itens";
        //ModalAlmoxarifadoRequisicaoItens();
	});
	$("#ExcluirRegistroAlmoxarifadoRequisicaoItens").click(function()
	{
		var checked = $("input[name='lista_AlmoxarifadoRequisicaoItens[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_AlmoxarifadoRequisicaoItens[]']:checked"), function() {
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
                        ExcluirRegistrosAlmoxarifadoRequisicaoItens(values);
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


function ModificarAlmoxarifadoRequisicaoItens(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_almoxarifado_requisicao_itens&app_modulo=almoxarifado_requisicao_itens&app_codigo="+id;
        //ModalAlmoxarifadoRequisicaoItens(id);
}
function ModalAlmoxarifadoRequisicaoItens(id){
    $("#modal_modulo_almoxarifado_requisicao_itens").modal("show");
    $("#div_modal_almoxarifado_requisicao_itens").load("index_xml.php?app_comando=frm_modal_almoxarifado_requisicao_itens&app_modulo=almoxarifado_requisicao_itens&app_codigo="+id);
}

function ExcluirRegistrosAlmoxarifadoRequisicaoItens(dados)
{
	$.post("index_xml.php?app_modulo=almoxarifado_requisicao_itens&app_comando=deletar_almoxarifado_requisicao_itens",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridAlmoxarifadoRequisicaoItens();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
