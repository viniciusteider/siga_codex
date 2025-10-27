<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroEscala").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_escala&app_modulo=escala";
        //ModalEscala();
	});
	$("#ExcluirRegistroEscala").click(function()
	{
		var checked = $("input[name='lista_Escala[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Escala[]']:checked"), function() {
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
                        ExcluirRegistrosEscala(values);
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
            AtualizarGridEscala(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarEscala(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_escala&app_modulo=escala&app_codigo="+id;
        //ModalEscala(id);
}
function ModalEscala(id){
    $("#modal_modulo_escala").modal("show");
    $("#div_modal_escala").load("index_xml.php?app_comando=frm_modal_escala&app_modulo=escala&app_codigo="+id);
}
function CopiarEscala(id){
    $("#modal_copiar_escala").modal("show");
    $("#div_copiar_escala").load("index_xml.php?app_comando=frm_copiar_escala&app_modulo=escala&app_codigo="+id);
}

function ExcluirRegistrosEscala(dados)
{
	$.post("index_xml.php?app_modulo=escala&app_comando=deletar_escala",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridEscala();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
