<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroTipoDestruicao").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_tipo_destruicao&app_modulo=tipo_destruicao";
        //ModalTipoDestruicao();
	});
	$("#ExcluirRegistroTipoDestruicao").click(function()
	{
		var checked = $("input[name='lista_TipoDestruicao[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_TipoDestruicao[]']:checked"), function() {
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
                        ExcluirRegistrosTipoDestruicao(values);
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
            AtualizarGridTipoDestruicao(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarTipoDestruicao(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_tipo_destruicao&app_modulo=tipo_destruicao&app_codigo="+id;
        //ModalTipoDestruicao(id);
}
function ModalTipoDestruicao(id){
    $("#modal_modulo_tipo_destruicao").modal("show");
    $("#div_modal_tipo_destruicao").load("index_xml.php?app_comando=frm_modal_tipo_destruicao&app_modulo=tipo_destruicao&app_codigo="+id);
}

function ExcluirRegistrosTipoDestruicao(dados)
{
	$.post("index_xml.php?app_modulo=tipo_destruicao&app_comando=deletar_tipo_destruicao",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridTipoDestruicao();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
