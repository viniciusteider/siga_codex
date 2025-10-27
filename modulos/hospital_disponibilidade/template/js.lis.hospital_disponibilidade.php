<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroHospitalDisponibilidade").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_hospital_disponibilidade&app_modulo=hospital_disponibilidade";
        //ModalHospitalDisponibilidade();
	});
	$("#ExcluirRegistroHospitalDisponibilidade").click(function()
	{
		var checked = $("input[name='lista_HospitalDisponibilidade[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_HospitalDisponibilidade[]']:checked"), function() {
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
                        ExcluirRegistrosHospitalDisponibilidade(values);
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
	$('[data-bs-toggle="tooltip"]').tooltip();
});


function ModificarHospitalDisponibilidade(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_hospital_disponibilidade&app_modulo=hospital_disponibilidade&app_codigo="+id;
        //ModalHospitalDisponibilidade(id);
}
function ModalHospitalDisponibilidade(id){
    $("#modal_modulo_hospital_disponibilidade").modal("show");
    $("#div_modal_hospital_disponibilidade").load("index_xml.php?app_comando=frm_modal_hospital_disponibilidade&app_modulo=hospital_disponibilidade&app_codigo="+id);
}

function ExcluirRegistrosHospitalDisponibilidade(dados)
{
	$.post("index_xml.php?app_modulo=hospital_disponibilidade&app_comando=deletar_hospital_disponibilidade",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridHospitalDisponibilidade();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
