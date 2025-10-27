<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroMedicamentos").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_medicamentos&app_modulo=medicamentos";
        //ModalMedicamentos();
	});
	$("#ExcluirRegistroMedicamentos").click(function()
	{
		var checked = $("input[name='lista_Medicamentos[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Medicamentos[]']:checked"), function() {
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
                        ExcluirRegistrosMedicamentos(values);
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
            AtualizarGridMedicamentos(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarMedicamentos(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_medicamentos&app_modulo=medicamentos&app_codigo="+id;
        //ModalMedicamentos(id);
}
function ModalMedicamentos(id){
    $("#modal_modulo_medicamentos").modal("show");
    $("#div_modal_medicamentos").load("index_xml.php?app_comando=frm_modal_medicamentos&app_modulo=medicamentos&app_codigo="+id);
}

function ExcluirRegistrosMedicamentos(dados)
{
	$.post("index_xml.php?app_modulo=medicamentos&app_comando=deletar_medicamentos",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridMedicamentos();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
