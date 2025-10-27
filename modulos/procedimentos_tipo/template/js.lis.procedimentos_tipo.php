<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistro").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_procedimentos_tipo&app_modulo=procedimentos_tipo";
        //ModalProcedimentosTipo();
	});
	$("#ExcluirRegistro").click(function()
	{
		var checked = $("input[name='lista[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista[]']:checked"), function() {
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
                        ExcluirRegistros(values);
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
            AtualizarGridProcedimentosTipo(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarProcedimentosTipo(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_procedimentos_tipo&app_modulo=procedimentos_tipo&app_codigo="+id;
        //ModalProcedimentosTipo(id);
}
function ModalProcedimentosTipo(id){
    $("#modal_modulo_procedimentos_tipo").modal("show");
    $("#div_modal_procedimentos_tipo").load("index_xml.php?app_comando=frm_modal_procedimentos_tipo&app_modulo=procedimentos_tipo&app_codigo="+id);
}

function ExcluirRegistros(dados)
{
	$.post("index_xml.php?app_modulo=procedimentos_tipo&app_comando=deletar_procedimentos_tipo",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridProcedimentosTipo();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
