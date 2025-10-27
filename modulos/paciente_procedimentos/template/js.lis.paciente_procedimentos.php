<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroPacienteProcedimentos").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_paciente_procedimentos&app_modulo=paciente_procedimentos";
        //ModalPacienteProcedimentos();
	});
	$("#ExcluirRegistroPacienteProcedimentos").click(function()
	{
		var checked = $("input[name='lista_PacienteProcedimentos[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_PacienteProcedimentos[]']:checked"), function() {
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
                        ExcluirRegistrosPacienteProcedimentos(values);
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
            AtualizarGridPacienteProcedimentos(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarPacienteProcedimentos(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_paciente_procedimentos&app_modulo=paciente_procedimentos&app_codigo="+id;
        //ModalPacienteProcedimentos(id);
}
function ModalPacienteProcedimentos(id){
    $("#modal_modulo_paciente_procedimentos").modal("show");
    $("#div_modal_paciente_procedimentos").load("index_xml.php?app_comando=frm_modal_paciente_procedimentos&app_modulo=paciente_procedimentos&app_codigo="+id);
}

function ExcluirRegistrosPacienteProcedimentos(dados)
{
	$.post("index_xml.php?app_modulo=paciente_procedimentos&app_comando=deletar_paciente_procedimentos",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridPacienteProcedimentos();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
