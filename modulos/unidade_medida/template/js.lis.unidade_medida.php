<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroUnidadeMedida").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_unidade_medida&app_modulo=unidade_medida";
        //ModalUnidadeMedida();
	});
	$("#ExcluirRegistroUnidadeMedida").click(function()
	{
		var checked = $("input[name='lista_UnidadeMedida[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_UnidadeMedida[]']:checked"), function() {
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
                        ExcluirRegistrosUnidadeMedida(values);
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
	$("#busca").keypress(function (e) {
		if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            AtualizarGridUnidadeMedida(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarUnidadeMedida(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_unidade_medida&app_modulo=unidade_medida&app_codigo="+id;
        //ModalUnidadeMedida(id);
}
function ModalUnidadeMedida(id){
    $("#modal_modulo_unidade_medida").modal("show");
    $("#div_modal_unidade_medida").load("index_xml.php?app_comando=frm_modal_unidade_medida&app_modulo=unidade_medida&app_codigo="+id);
}

function ExcluirRegistrosUnidadeMedida(dados)
{
	$.post("index_xml.php?app_modulo=unidade_medida&app_comando=deletar_unidade_medida",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridUnidadeMedida({});			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
