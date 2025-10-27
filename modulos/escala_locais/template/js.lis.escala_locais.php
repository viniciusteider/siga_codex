<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroEscalaLocais").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_escala_locais&app_modulo=escala_locais";
        //ModalEscalaLocais();
	});
	$("#ExcluirRegistroEscalaLocais").click(function()
	{
		var checked = $("input[name='lista_EscalaLocais[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_EscalaLocais[]']:checked"), function() {
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
                        ExcluirRegistrosEscalaLocais(values);
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
            AtualizarGridEscalaLocais(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarEscalaLocais(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_escala_locais&app_modulo=escala_locais&app_codigo="+id;
        //ModalEscalaLocais(id);
}
function ModalEscalaLocais(id){
    $("#modal_modulo_escala_locais").modal("show");
    $("#div_modal_escala_locais").load("index_xml.php?app_comando=frm_modal_escala_locais&app_modulo=escala_locais&app_codigo="+id);
}

function ExcluirRegistrosEscalaLocais(dados)
{
	$.post("index_xml.php?app_modulo=escala_locais&app_comando=deletar_escala_locais",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridEscalaLocais();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
