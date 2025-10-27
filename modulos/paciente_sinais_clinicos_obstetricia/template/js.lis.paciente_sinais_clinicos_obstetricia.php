<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroPacienteSinaisClinicosObstetricia").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_paciente_sinais_clinicos_obstetricia&app_modulo=paciente_sinais_clinicos_obstetricia";
        //ModalPacienteSinaisClinicosObstetricia();
	});
	$("#ExcluirRegistroPacienteSinaisClinicosObstetricia").click(function()
	{
		var checked = $("input[name='lista_PacienteSinaisClinicosObstetricia[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_PacienteSinaisClinicosObstetricia[]']:checked"), function() {
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
                        ExcluirRegistrosPacienteSinaisClinicosObstetricia(values);
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
            AtualizarGridPacienteSinaisClinicosObstetricia(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarPacienteSinaisClinicosObstetricia(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_paciente_sinais_clinicos_obstetricia&app_modulo=paciente_sinais_clinicos_obstetricia&app_codigo="+id;
        //ModalPacienteSinaisClinicosObstetricia(id);
}
function ModalPacienteSinaisClinicosObstetricia(id){
    $("#modal_modulo_paciente_sinais_clinicos_obstetricia").modal("show");
    $("#div_modal_paciente_sinais_clinicos_obstetricia").load("index_xml.php?app_comando=frm_modal_paciente_sinais_clinicos_obstetricia&app_modulo=paciente_sinais_clinicos_obstetricia&app_codigo="+id);
}

function ExcluirRegistrosPacienteSinaisClinicosObstetricia(dados)
{
	$.post("index_xml.php?app_modulo=paciente_sinais_clinicos_obstetricia&app_comando=deletar_paciente_sinais_clinicos_obstetricia",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridPacienteSinaisClinicosObstetricia();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
