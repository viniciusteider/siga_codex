<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroAlmoxarifado").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_almoxarifado&app_modulo=almoxarifado";
        //ModalAlmoxarifado();
	});
	$("#ExcluirRegistroAlmoxarifado").click(function()
	{
		var checked = $("input[name='lista_Almoxarifado[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Almoxarifado[]']:checked"), function() {
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
                        ExcluirRegistrosAlmoxarifado(values);
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


function ModificarAlmoxarifado(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_almoxarifado&app_modulo=almoxarifado&app_codigo="+id;
        //ModalAlmoxarifado(id);
}
function ModalAlmoxarifado(id){
    $("#modal_modulo_almoxarifado").modal("show");
    $("#div_modal_almoxarifado").load("index_xml.php?app_comando=frm_modal_almoxarifado&app_modulo=almoxarifado&app_codigo="+id);
}

function ExcluirRegistrosAlmoxarifado(dados)
{
	$.post("index_xml.php?app_modulo=almoxarifado&app_comando=deletar_almoxarifado",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridAlmoxarifado();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
