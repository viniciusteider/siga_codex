<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroAlmoxarifadoTransferenciaEstoque").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_almoxarifado_transferencia_estoque&app_modulo=almoxarifado_transferencia_estoque";
        //ModalAlmoxarifadoTransferenciaEstoque();
	});
	$("#ExcluirRegistroAlmoxarifadoTransferenciaEstoque").click(function()
	{
		var checked = $("input[name='lista_AlmoxarifadoTransferenciaEstoque[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_AlmoxarifadoTransferenciaEstoque[]']:checked"), function() {
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
                        ExcluirRegistrosAlmoxarifadoTransferenciaEstoque(values);
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


function ModificarAlmoxarifadoTransferenciaEstoque(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_almoxarifado_transferencia_estoque&app_modulo=almoxarifado_transferencia_estoque&app_codigo="+id;
        //ModalAlmoxarifadoTransferenciaEstoque(id);
}
function ModalAlmoxarifadoTransferenciaEstoque(id){
    $("#modal_modulo_almoxarifado_transferencia_estoque").modal("show");
    $("#div_modal_almoxarifado_transferencia_estoque").load("index_xml.php?app_comando=frm_modal_almoxarifado_transferencia_estoque&app_modulo=almoxarifado_transferencia_estoque&app_codigo="+id);
}

function ExcluirRegistrosAlmoxarifadoTransferenciaEstoque(dados)
{
	$.post("index_xml.php?app_modulo=almoxarifado_transferencia_estoque&app_comando=deletar_almoxarifado_transferencia_estoque",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridAlmoxarifadoTransferenciaEstoque();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
