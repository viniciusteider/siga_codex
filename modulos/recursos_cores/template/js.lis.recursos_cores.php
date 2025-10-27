<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroRecursosCores").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_recursos_cores&app_modulo=recursos_cores";
        //ModalRecursosCores();
	});
	$("#ExcluirRegistroRecursosCores").click(function()
	{
		var checked = $("input[name='lista_RecursosCores[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_RecursosCores[]']:checked"), function() {
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
                        ExcluirRegistrosRecursosCores(values);
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
            AtualizarGridRecursosCores(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarRecursosCores(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_recursos_cores&app_modulo=recursos_cores&app_codigo="+id;
        //ModalRecursosCores(id);
}
function ModalRecursosCores(id){
    $("#modal_modulo_recursos_cores").modal("show");
    $("#div_modal_recursos_cores").load("index_xml.php?app_comando=frm_modal_recursos_cores&app_modulo=recursos_cores&app_codigo="+id);
}

function ExcluirRegistrosRecursosCores(dados)
{
	$.post("index_xml.php?app_modulo=recursos_cores&app_comando=deletar_recursos_cores",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridRecursosCores();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
