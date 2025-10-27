<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroDisponibilidade").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_disponibilidade&app_modulo=disponibilidade";
        //ModalDisponibilidade();
	});
	$("#ExcluirRegistroDisponibilidade").click(function()
	{
		var checked = $("input[name='lista_Disponibilidade[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Disponibilidade[]']:checked"), function() {
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
                        ExcluirRegistrosDisponibilidade(values);
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
            AtualizarGridDisponibilidade(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarDisponibilidade(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_disponibilidade&app_modulo=disponibilidade&app_codigo="+id;
        //ModalDisponibilidade(id);
}
function ModalDisponibilidade(id){
    $("#modal_modulo_disponibilidade").modal("show");
    $("#div_modal_disponibilidade").load("index_xml.php?app_comando=frm_modal_disponibilidade&app_modulo=disponibilidade&app_codigo="+id);
}

function ExcluirRegistrosDisponibilidade(dados)
{
	$.post("index_xml.php?app_modulo=disponibilidade&app_comando=deletar_disponibilidade",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridDisponibilidade();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
