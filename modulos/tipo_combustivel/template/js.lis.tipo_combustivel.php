<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroTipoCombustivel").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_tipo_combustivel&app_modulo=tipo_combustivel";
        //ModalTipoCombustivel();
	});
	$("#ExcluirRegistroTipoCombustivel").click(function()
	{
		var checked = $("input[name='lista_TipoCombustivel[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_TipoCombustivel[]']:checked"), function() {
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
                        ExcluirRegistrosTipoCombustivel(values);
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
            AtualizarGridTipoCombustivel(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarTipoCombustivel(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_tipo_combustivel&app_modulo=tipo_combustivel&app_codigo="+id;
        //ModalTipoCombustivel(id);
}
function ModalTipoCombustivel(id){
    $("#modal_modulo_tipo_combustivel").modal("show");
    $("#div_modal_tipo_combustivel").load("index_xml.php?app_comando=frm_modal_tipo_combustivel&app_modulo=tipo_combustivel&app_codigo="+id);
}

function ExcluirRegistrosTipoCombustivel(dados)
{
	$.post("index_xml.php?app_modulo=tipo_combustivel&app_comando=deletar_tipo_combustivel",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridTipoCombustivel();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
