<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroTipoSolicitante").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_tipo_solicitante&app_modulo=tipo_solicitante";
        //ModalTipoSolicitante();
	});
	$("#ExcluirRegistroTipoSolicitante").click(function()
	{
		var checked = $("input[name='lista_TipoSolicitante[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_TipoSolicitante[]']:checked"), function() {
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
                        ExcluirRegistrosTipoSolicitante(values);
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
            AtualizarGridTipoSolicitante(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarTipoSolicitante(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_tipo_solicitante&app_modulo=tipo_solicitante&app_codigo="+id;
        //ModalTipoSolicitante(id);
}
function ModalTipoSolicitante(id){
    $("#modal_modulo_tipo_solicitante").modal("show");
    $("#div_modal_tipo_solicitante").load("index_xml.php?app_comando=frm_modal_tipo_solicitante&app_modulo=tipo_solicitante&app_codigo="+id);
}

function ExcluirRegistrosTipoSolicitante(dados)
{
	$.post("index_xml.php?app_modulo=tipo_solicitante&app_comando=deletar_tipo_solicitante",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridTipoSolicitante();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
