<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroPupilasSintomas").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_pupilas_sintomas&app_modulo=pupilas_sintomas";
        //ModalPupilasSintomas();
	});
	$("#ExcluirRegistroPupilasSintomas").click(function()
	{
		var checked = $("input[name='lista_PupilasSintomas[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_PupilasSintomas[]']:checked"), function() {
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
                        ExcluirRegistrosPupilasSintomas(values);
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
            AtualizarGridPupilasSintomas(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarPupilasSintomas(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_pupilas_sintomas&app_modulo=pupilas_sintomas&app_codigo="+id;
        //ModalPupilasSintomas(id);
}
function ModalPupilasSintomas(id){
    $("#modal_modulo_pupilas_sintomas").modal("show");
    $("#div_modal_pupilas_sintomas").load("index_xml.php?app_comando=frm_modal_pupilas_sintomas&app_modulo=pupilas_sintomas&app_codigo="+id);
}

function ExcluirRegistrosPupilasSintomas(dados)
{
	$.post("index_xml.php?app_modulo=pupilas_sintomas&app_comando=deletar_pupilas_sintomas",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridPupilasSintomas();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
