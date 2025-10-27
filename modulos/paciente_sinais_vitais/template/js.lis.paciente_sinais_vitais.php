<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroPacienteSinaisVitais").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_paciente_sinais_vitais&app_modulo=paciente_sinais_vitais";
        //ModalPacienteSinaisVitais();
	});
	$("#ExcluirRegistroPacienteSinaisVitais").click(function()
	{
		var checked = $("input[name='lista_PacienteSinaisVitais[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_PacienteSinaisVitais[]']:checked"), function() {
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
                        ExcluirRegistrosPacienteSinaisVitais(values);
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
            AtualizarGridPacienteSinaisVitais(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarPacienteSinaisVitais(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_paciente_sinais_vitais&app_modulo=paciente_sinais_vitais&app_codigo="+id;
        //ModalPacienteSinaisVitais(id);
}
function ModalPacienteSinaisVitais(id){
    $("#modal_modulo_paciente_sinais_vitais").modal("show");
    $("#div_modal_paciente_sinais_vitais").load("index_xml.php?app_comando=frm_modal_paciente_sinais_vitais&app_modulo=paciente_sinais_vitais&app_codigo="+id);
}

function ExcluirRegistrosPacienteSinaisVitais(dados)
{
	$.post("index_xml.php?app_modulo=paciente_sinais_vitais&app_comando=deletar_paciente_sinais_vitais",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridPacienteSinaisVitais();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
