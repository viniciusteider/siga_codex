<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroEscalaCategoria").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_escala_categoria&app_modulo=escala_categoria";
        //ModalEscalaCategoria();
	});
	$("#ExcluirRegistroEscalaCategoria").click(function()
	{
		var checked = $("input[name='lista_EscalaCategoria[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_EscalaCategoria[]']:checked"), function() {
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
                        ExcluirRegistrosEscalaCategoria(values);
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
            AtualizarGridEscalaCategoria(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarEscalaCategoria(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_escala_categoria&app_modulo=escala_categoria&app_codigo="+id;
        //ModalEscalaCategoria(id);
}
function ModalEscalaCategoria(id){
    $("#modal_modulo_escala_categoria").modal("show");
    $("#div_modal_escala_categoria").load("index_xml.php?app_comando=frm_modal_escala_categoria&app_modulo=escala_categoria&app_codigo="+id);
}

function ExcluirRegistrosEscalaCategoria(dados)
{
	$.post("index_xml.php?app_modulo=escala_categoria&app_comando=deletar_escala_categoria",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridEscalaCategoria();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
