<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroVias").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_vias&app_modulo=vias";
        //ModalVias();
	});
	$("#ExcluirRegistroVias").click(function()
	{
		var checked = $("input[name='lista_Vias[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Vias[]']:checked"), function() {
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
                        ExcluirRegistrosVias(values);
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
            AtualizarGridVias(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarVias(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_vias&app_modulo=vias&app_codigo="+id;
        //ModalVias(id);
}
function ModalVias(id){
    $("#modal_modulo_vias").modal("show");
    $("#div_modal_vias").load("index_xml.php?app_comando=frm_modal_vias&app_modulo=vias&app_codigo="+id);
}

function ExcluirRegistrosVias(dados)
{
	$.post("index_xml.php?app_modulo=vias&app_comando=deletar_vias",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridVias();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
