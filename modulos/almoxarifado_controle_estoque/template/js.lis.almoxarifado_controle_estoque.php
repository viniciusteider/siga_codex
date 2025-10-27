<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroAlmoxarifadoControleEstoque").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_almoxarifado_controle_estoque&app_modulo=almoxarifado_controle_estoque";
        //ModalAlmoxarifadoControleEstoque();
	});
	$("#ExcluirRegistroAlmoxarifadoControleEstoque").click(function()
	{
		var checked = $("input[name='lista_AlmoxarifadoControleEstoque[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_AlmoxarifadoControleEstoque[]']:checked"), function() {
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
                        ExcluirRegistrosAlmoxarifadoControleEstoque(values);
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


function ModificarAlmoxarifadoControleEstoque(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_almoxarifado_controle_estoque&app_modulo=almoxarifado_controle_estoque&app_codigo="+id;
        //ModalAlmoxarifadoControleEstoque(id);
}
function ModalAlmoxarifadoControleEstoque(id){
    $("#modal_modulo_almoxarifado_controle_estoque").modal("show");
    $("#div_modal_almoxarifado_controle_estoque").load("index_xml.php?app_comando=frm_modal_almoxarifado_controle_estoque&app_modulo=almoxarifado_controle_estoque&app_codigo="+id);
}

function ExcluirRegistrosAlmoxarifadoControleEstoque(dados)
{
	$.post("index_xml.php?app_modulo=almoxarifado_controle_estoque&app_comando=deletar_almoxarifado_controle_estoque",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridAlmoxarifadoControleEstoque();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
