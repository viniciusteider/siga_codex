<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroOcorrenciasRecursos").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_ocorrencias_recursos&app_modulo=ocorrencias_recursos";
        //ModalOcorrenciasRecursos();
	});
	$("#ExcluirRegistroOcorrenciasRecursos").click(function()
	{
		var checked = $("input[name='lista_OcorrenciasRecursos[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_OcorrenciasRecursos[]']:checked"), function() {
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
                        ExcluirRegistrosOcorrenciasRecursos(values);
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
            AtualizarGridOcorrenciasRecursos(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarOcorrenciasRecursos(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_ocorrencias_recursos&app_modulo=ocorrencias_recursos&app_codigo="+id;
        //ModalOcorrenciasRecursos(id);
}
function ModalOcorrenciasRecursos(id){
    $("#modal_modulo_ocorrencias_recursos").modal("show");
    $("#div_modal_ocorrencias_recursos").load("index_xml.php?app_comando=frm_modal_ocorrencias_recursos&app_modulo=ocorrencias_recursos&app_codigo="+id);
}

function ExcluirRegistrosOcorrenciasRecursos(dados)
{
	$.post("index_xml.php?app_modulo=ocorrencias_recursos&app_comando=deletar_ocorrencias_recursos",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridOcorrenciasRecursos();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
