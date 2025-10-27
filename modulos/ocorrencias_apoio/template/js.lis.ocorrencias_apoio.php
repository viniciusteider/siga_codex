<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroOcorrenciasApoio").click(function()
	{
        // window.location = "#index_xml.php?app_comando=frm_adicionar_ocorrencias_apoio&app_modulo=ocorrencias_apoio";
        var id_ocorrencia = $('#id_ocorrencia').val();
        ModalOcorrenciasApoio(id_ocorrencia,'');
	});
	$("#ExcluirRegistroOcorrenciasApoio").click(function()
	{
		var checked = $("input[name='lista_OcorrenciasApoio[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_OcorrenciasApoio[]']:checked"), function() {
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
                        ExcluirRegistrosOcorrenciasApoio(values);
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
            AtualizarGridOcorrenciasApoio(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarOcorrenciasApoio(id){
    // window.location = "#index_xml.php?app_comando=frm_atualizar_ocorrencias_apoio&app_modulo=ocorrencias_apoio&app_codigo="+id;
        var id_ocorrencia = $('#id_ocorrencia').val();
        ModalOcorrenciasApoio(id_ocorrencia,id);
}
function ModalOcorrenciasApoio(id_ocorrencia,id){
    $("#modal_modulo_ocorrencias_apoio").modal("show");
    $("#div_modal_ocorrencias_apoio").load("index_xml.php?app_comando=frm_modal_ocorrencias_apoio&app_modulo=ocorrencias_apoio&id_ocorrencia="+id_ocorrencia+"&app_codigo="+id);
}

function ExcluirRegistrosOcorrenciasApoio(dados)
{
	$.post("index_xml.php?app_modulo=ocorrencias_apoio&app_comando=deletar_ocorrencias_apoio",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridOcorrenciasApoio();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
