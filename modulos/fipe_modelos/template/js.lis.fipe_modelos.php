<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroFipeModelos").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_fipe_modelos&app_modulo=fipe_modelos";
        //ModalFipeModelos();
	});
	$("#ExcluirRegistroFipeModelos").click(function()
	{
		var checked = $("input[name='lista_FipeModelos[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_FipeModelos[]']:checked"), function() {
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
                        ExcluirRegistrosFipeModelos(values);
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
            AtualizarGridFipeModelos(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarFipeModelos(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_fipe_modelos&app_modulo=fipe_modelos&app_codigo="+id;
        //ModalFipeModelos(id);
}
function ModalFipeModelos(id){
    $("#modal_modulo_fipe_modelos").modal("show");
    $("#div_modal_fipe_modelos").load("index_xml.php?app_comando=frm_modal_fipe_modelos&app_modulo=fipe_modelos&app_codigo="+id);
}

function ExcluirRegistrosFipeModelos(dados)
{
	$.post("index_xml.php?app_modulo=fipe_modelos&app_comando=deletar_fipe_modelos",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridFipeModelos();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
