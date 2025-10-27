<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroAlmoxarifadoEntradasItens").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_almoxarifado_entradas_itens&app_modulo=almoxarifado_entradas_itens";
        //ModalAlmoxarifadoEntradasItens();
	});
	$("#ExcluirRegistroAlmoxarifadoEntradasItens").click(function()
	{
		var checked = $("input[name='lista_AlmoxarifadoEntradasItens[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_AlmoxarifadoEntradasItens[]']:checked"), function() {
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
                        ExcluirRegistrosAlmoxarifadoEntradasItens(values);
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


function ModificarAlmoxarifadoEntradasItens(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_almoxarifado_entradas_itens&app_modulo=almoxarifado_entradas_itens&app_codigo="+id;
        //ModalAlmoxarifadoEntradasItens(id);
}
function ModalAlmoxarifadoEntradasItens(id){
    $("#modal_modulo_almoxarifado_entradas_itens").modal("show");
    $("#div_modal_almoxarifado_entradas_itens").load("index_xml.php?app_comando=frm_modal_almoxarifado_entradas_itens&app_modulo=almoxarifado_entradas_itens&app_codigo="+id);
}

function ExcluirRegistrosAlmoxarifadoEntradasItens(dados)
{
	$.post("index_xml.php?app_modulo=almoxarifado_entradas_itens&app_comando=deletar_almoxarifado_entradas_itens",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridAlmoxarifadoEntradasItens();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
