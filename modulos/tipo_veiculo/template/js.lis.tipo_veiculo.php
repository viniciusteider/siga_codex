<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroTipoVeiculo").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_tipo_veiculo&app_modulo=tipo_veiculo";
        //ModalTipoVeiculo();
	});
	$("#ExcluirRegistroTipoVeiculo").click(function()
	{
		var checked = $("input[name='lista_TipoVeiculo[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_TipoVeiculo[]']:checked"), function() {
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
                        ExcluirRegistrosTipoVeiculo(values);
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
            AtualizarGridTipoVeiculo(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarTipoVeiculo(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_tipo_veiculo&app_modulo=tipo_veiculo&app_codigo="+id;
        //ModalTipoVeiculo(id);
}
function ModalTipoVeiculo(id){
    $("#modal_modulo_tipo_veiculo").modal("show");
    $("#div_modal_tipo_veiculo").load("index_xml.php?app_comando=frm_modal_tipo_veiculo&app_modulo=tipo_veiculo&app_codigo="+id);
}

function ExcluirRegistrosTipoVeiculo(dados)
{
	$.post("index_xml.php?app_modulo=tipo_veiculo&app_comando=deletar_tipo_veiculo",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridTipoVeiculo();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
