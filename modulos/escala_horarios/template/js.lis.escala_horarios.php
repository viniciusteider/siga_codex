<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroEscalaHorarios").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_escala_horarios&app_modulo=escala_horarios";
        //ModalEscalaHorarios();
	});
	$("#ExcluirRegistroEscalaHorarios").click(function()
	{
		var checked = $("input[name='lista_EscalaHorarios[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_EscalaHorarios[]']:checked"), function() {
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
                        ExcluirRegistrosEscalaHorarios(values);
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
            AtualizarGridEscalaHorarios(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarEscalaHorarios(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_escala_horarios&app_modulo=escala_horarios&app_codigo="+id;
        //ModalEscalaHorarios(id);
}
function ModalEscalaHorarios(id){
    $("#modal_modulo_escala_horarios").modal("show");
    $("#div_modal_escala_horarios").load("index_xml.php?app_comando=frm_modal_escala_horarios&app_modulo=escala_horarios&app_codigo="+id);
}

function ExcluirRegistrosEscalaHorarios(dados)
{
	$.post("index_xml.php?app_modulo=escala_horarios&app_comando=deletar_escala_horarios",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridEscalaHorarios();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
