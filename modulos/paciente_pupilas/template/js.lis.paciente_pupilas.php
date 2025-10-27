<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroPacientePupilas").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_paciente_pupilas&app_modulo=paciente_pupilas";
        //ModalPacientePupilas();
	});
	$("#ExcluirRegistroPacientePupilas").click(function()
	{
		var checked = $("input[name='lista_PacientePupilas[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_PacientePupilas[]']:checked"), function() {
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
                        ExcluirRegistrosPacientePupilas(values);
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
            AtualizarGridPacientePupilas(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarPacientePupilas(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_paciente_pupilas&app_modulo=paciente_pupilas&app_codigo="+id;
        //ModalPacientePupilas(id);
}
function ModalPacientePupilas(id){
    $("#modal_modulo_paciente_pupilas").modal("show");
    $("#div_modal_paciente_pupilas").load("index_xml.php?app_comando=frm_modal_paciente_pupilas&app_modulo=paciente_pupilas&app_codigo="+id);
}

function ExcluirRegistrosPacientePupilas(dados)
{
	$.post("index_xml.php?app_modulo=paciente_pupilas&app_comando=deletar_paciente_pupilas",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridPacientePupilas();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
