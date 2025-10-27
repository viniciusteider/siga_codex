<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroFipeAnos").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_fipe_anos&app_modulo=fipe_anos";
        //ModalFipeAnos();
	});
	$("#ExcluirRegistroFipeAnos").click(function()
	{
		var checked = $("input[name='lista_FipeAnos[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_FipeAnos[]']:checked"), function() {
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
                        ExcluirRegistrosFipeAnos(values);
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
            AtualizarGridFipeAnos(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarFipeAnos(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_fipe_anos&app_modulo=fipe_anos&app_codigo="+id;
        //ModalFipeAnos(id);
}
function ModalFipeAnos(id){
    $("#modal_modulo_fipe_anos").modal("show");
    $("#div_modal_fipe_anos").load("index_xml.php?app_comando=frm_modal_fipe_anos&app_modulo=fipe_anos&app_codigo="+id);
}

function ExcluirRegistrosFipeAnos(dados)
{
	$.post("index_xml.php?app_modulo=fipe_anos&app_comando=deletar_fipe_anos",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridFipeAnos();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
