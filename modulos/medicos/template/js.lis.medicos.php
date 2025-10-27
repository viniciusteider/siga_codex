<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroMedicos").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_medicos&app_modulo=medicos";
        //ModalMedicos();
	});
	$("#ExcluirRegistroMedicos").click(function()
	{
		var checked = $("input[name='lista_Medicos[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Medicos[]']:checked"), function() {
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
                        ExcluirRegistrosMedicos(values);
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
            AtualizarGridMedicos(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarMedicos(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_medicos&app_modulo=medicos&app_codigo="+id;
        //ModalMedicos(id);
}
function ModalMedicos(id){
    $("#modal_modulo_medicos").modal("show");
    $("#div_modal_medicos").load("index_xml.php?app_comando=frm_modal_medicos&app_modulo=medicos&app_codigo="+id);
}

function ExcluirRegistrosMedicos(dados)
{
	$.post("index_xml.php?app_modulo=medicos&app_comando=deletar_medicos",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridMedicos();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
