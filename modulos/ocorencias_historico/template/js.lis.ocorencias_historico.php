<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroOcorenciasHistorico").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_ocorencias_historico&app_modulo=ocorencias_historico";
        //ModalOcorenciasHistorico();
	});
	$("#ExcluirRegistroOcorenciasHistorico").click(function()
	{
		var checked = $("input[name='lista_OcorenciasHistorico[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_OcorenciasHistorico[]']:checked"), function() {
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
                        ExcluirRegistrosOcorenciasHistorico(values);
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
            AtualizarGridOcorenciasHistorico(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarOcorenciasHistorico(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_ocorencias_historico&app_modulo=ocorencias_historico&app_codigo="+id;
        //ModalOcorenciasHistorico(id);
}
function ModalOcorenciasHistorico(id){
    $("#modal_modulo_ocorencias_historico").modal("show");
    $("#div_modal_ocorencias_historico").load("index_xml.php?app_comando=frm_modal_ocorencias_historico&app_modulo=ocorencias_historico&app_codigo="+id);
}

function ExcluirRegistrosOcorenciasHistorico(dados)
{
	$.post("index_xml.php?app_modulo=ocorencias_historico&app_comando=deletar_ocorencias_historico",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridOcorenciasHistorico();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
