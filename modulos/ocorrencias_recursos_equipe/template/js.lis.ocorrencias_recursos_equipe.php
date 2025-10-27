<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroOcorrenciasRecursosEquipe").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_ocorrencias_recursos_equipe&app_modulo=ocorrencias_recursos_equipe";
        //ModalOcorrenciasRecursosEquipe();
	});
	$("#ExcluirRegistroOcorrenciasRecursosEquipe").click(function()
	{
		var checked = $("input[name='lista_OcorrenciasRecursosEquipe[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_OcorrenciasRecursosEquipe[]']:checked"), function() {
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
                        ExcluirRegistrosOcorrenciasRecursosEquipe(values);
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
            AtualizarGridOcorrenciasRecursosEquipe(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarOcorrenciasRecursosEquipe(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_ocorrencias_recursos_equipe&app_modulo=ocorrencias_recursos_equipe&app_codigo="+id;
        //ModalOcorrenciasRecursosEquipe(id);
}
function ModalOcorrenciasRecursosEquipe(id){
    $("#modal_modulo_ocorrencias_recursos_equipe").modal("show");
    $("#div_modal_ocorrencias_recursos_equipe").load("index_xml.php?app_comando=frm_modal_ocorrencias_recursos_equipe&app_modulo=ocorrencias_recursos_equipe&app_codigo="+id);
}

function ExcluirRegistrosOcorrenciasRecursosEquipe(dados)
{
	$.post("index_xml.php?app_modulo=ocorrencias_recursos_equipe&app_comando=deletar_ocorrencias_recursos_equipe",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridOcorrenciasRecursosEquipe();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
