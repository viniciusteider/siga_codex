<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroRespiracao").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_respiracao&app_modulo=respiracao";
        //ModalRespiracao();
	});
	$("#ExcluirRegistroRespiracao").click(function()
	{
		var checked = $("input[name='lista_Respiracao[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Respiracao[]']:checked"), function() {
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
                        ExcluirRegistrosRespiracao(values);
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
            AtualizarGridRespiracao(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarRespiracao(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_respiracao&app_modulo=respiracao&app_codigo="+id;
        //ModalRespiracao(id);
}
function ModalRespiracao(id){
    $("#modal_modulo_respiracao").modal("show");
    $("#div_modal_respiracao").load("index_xml.php?app_comando=frm_modal_respiracao&app_modulo=respiracao&app_codigo="+id);
}

function ExcluirRegistrosRespiracao(dados)
{
	$.post("index_xml.php?app_modulo=respiracao&app_comando=deletar_respiracao",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridRespiracao();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
