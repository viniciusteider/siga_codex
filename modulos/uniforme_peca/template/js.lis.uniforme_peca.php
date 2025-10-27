<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroUniformePeca").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_uniforme_peca&app_modulo=uniforme_peca";
        //ModalUniformePeca();
	});
	$("#ExcluirRegistroUniformePeca").click(function()
	{
		var checked = $("input[name='lista_UniformePeca[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_UniformePeca[]']:checked"), function() {
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
                        ExcluirRegistrosUniformePeca(values);
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
            AtualizarGridUniformePeca(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarUniformePeca(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_uniforme_peca&app_modulo=uniforme_peca&app_codigo="+id;
        //ModalUniformePeca(id);
}
function ModalUniformePeca(id){
    $("#modal_modulo_uniforme_peca").modal("show");
    $("#div_modal_uniforme_peca").load("index_xml.php?app_comando=frm_modal_uniforme_peca&app_modulo=uniforme_peca&app_codigo="+id);
}

function ExcluirRegistrosUniformePeca(dados)
{
	$.post("index_xml.php?app_modulo=uniforme_peca&app_comando=deletar_uniforme_peca",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridUniformePeca();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
