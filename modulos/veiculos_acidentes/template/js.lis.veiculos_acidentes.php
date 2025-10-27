<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroVeiculosAcidentes").click(function()
	{
        // window.location = "#index_xml.php?app_comando=frm_adicionar_veiculos_acidentes&app_modulo=veiculos_acidentes";
        var id_ocorrencia = $('#id_ocorrencia').val();
        ModalVeiculosAcidentes(id_ocorrencia);
	});
	$("#ExcluirRegistroVeiculosAcidentes").click(function()
	{
		var checked = $("input[name='lista_VeiculosAcidentes[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_VeiculosAcidentes[]']:checked"), function() {
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
                        ExcluirRegistrosVeiculosAcidentes(values);
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
            AtualizarGridVeiculosAcidentes(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarVeiculosAcidentes(id){
    // window.location = "#index_xml.php?app_comando=frm_atualizar_veiculos_acidentes&app_modulo=veiculos_acidentes&app_codigo="+id;
    var id_ocorrencia = $('#id_ocorrencia').val();
        ModalVeiculosAcidentes(id_ocorrencia,id);
}
function ModalVeiculosAcidentes(id_ocorrencia,id){
    $("#modal_modulo_veiculos_acidentes").modal("show");
    $("#div_modal_veiculos_acidentes").load("index_xml.php?app_comando=frm_modal_veiculos_acidentes&app_modulo=veiculos_acidentes&id_ocorrencia="+id_ocorrencia+"&app_codigo="+id);
}

function ExcluirRegistrosVeiculosAcidentes(dados)
{
	$.post("index_xml.php?app_modulo=veiculos_acidentes&app_comando=deletar_veiculos_acidentes",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridVeiculosAcidentes();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
